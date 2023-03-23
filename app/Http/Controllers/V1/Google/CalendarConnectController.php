<?php

namespace App\Http\Controllers\V1\Google;

use App\Helpers\GoogleCalendar;
use App\Helpers\GoogleClient;
use App\Helpers\PermissionHelper;
use App\Http\Controllers\Controller;
use App\Models\GoogleCalendarToken;
use App\Models\User;
use Carbon\Carbon;
use Google\Service\Calendar;
use Google_Service_Calendar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CalendarConnectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        PermissionHelper::abort_if_unless_permission('connectToCalendar');

        $client = GoogleClient::CalendarClient();

        if ($request->header('Accept') == 'application/json'){
            return response()->json([
                'redirect_to' => $client->createAuthUrl()
            ]);
        }

        return redirect($client->createAuthUrl());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        PermissionHelper::abort_if_unless_permission('connectToCalendar');

        abort_if(($request->has('error') &&  $request->get('error') == 'access_denied') || ! $request->has('code') , 403 , 'invalid data');

        $client = GoogleClient::CalendarClient();

        $token = $client->fetchAccessTokenWithAuthCode($request->get('code'));

        abort_if($token && isset($token['error']) , 403 , 'invalid data');

        /** @var GoogleCalendarToken $tokenRow */
        $tokenRow = GoogleCalendarToken::query()->firstOrNew([
            'user_id' => Auth::id()
        ],[
            'type' => GoogleCalendarToken::TYPE_CALENDAR
        ]);

        $tokenRow->fillWithArray($token);
        $tokenRow->calendar_id = GoogleCalendar::createCalendar(GoogleCalendar::DEFAULT_CALENDAR);
        $tokenRow->save();

        return redirect('/');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {

        if ($id){
            PermissionHelper::abort_if_unless_permission('connectToCalendarOtherUser');
            $user = User::findOrFail($id);
        }else{
            PermissionHelper::abort_if_unless_permission('connectToCalendar');
            $user = Auth::user();
        }

        return response()->json([
            'status' => $user->tokens()->where('type' , GoogleCalendarToken::TYPE_CALENDAR)->exists()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function users(Request $request)
    {
        PermissionHelper::abort_if_unless_permission('userConnectedList');
        return User::query()->whereIn('id' , GoogleCalendarToken::query()->pluck('user_id'))->advancedFilter($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse|int
     */
    public function destroy($id = false)
    {

        if ($id){
            PermissionHelper::abort_if_unless_permission('disconnectOtherUserFromCalendar');
            $user = User::findOrFail($id);
        }else{
            PermissionHelper::abort_if_unless_permission('disconnectToCalendar');
            $user = Auth::user();
        }

        return response()->json([
            'status' => !!$user->tokens()->where('type' , GoogleCalendarToken::TYPE_CALENDAR)->delete()
        ]);
    }
}
