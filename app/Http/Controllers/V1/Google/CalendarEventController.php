<?php

namespace App\Http\Controllers\V1\Google;

use App\Helpers\GoogleCalendar;
use App\Helpers\PermissionHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\CalendarEvnetRequest;
use App\Http\Requests\CalendarUpdateEvnetRequest;
use App\Models\GoogleCalendarToken;
use App\Models\User;
use Google\Service\AIPlatformNotebooks;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CalendarEventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return array
     */
    public function index($id = false)
    {
        if ($id){
            PermissionHelper::abort_if_unless_permission('getOtherUserEventList');
            $user = User::query()->findOrFail($id);
        }else{
            PermissionHelper::abort_if_unless_permission('getUserEventList');
            $user = Auth::user();
        }

        return GoogleCalendar::getEvents($user->tokens()->where('type', GoogleCalendarToken::TYPE_CALENDAR)->firstOrFail()->calendar_id);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CalendarEvnetRequest $request)
    {
        if ($request->has('user_id')){
            PermissionHelper::abort_if_unless_permission('createEvent');
            $user = User::query()->findOrFail($request->get('user_id'));
        }else{
            PermissionHelper::abort_if_unless_permission('createEventForOtherUser');
            $user = Auth::user();
        }
        $calendar_id = $user->tokens()->where('type' , GoogleCalendarToken::TYPE_CALENDAR)->firstOrFail()->calendar_id;

        return GoogleCalendar::createEvent($calendar_id , $request->only(['summary' , 'location' , 'description' , 'start.dateTime' , 'start.timeZone' , 'end.dateTime' , 'end.timeZone']));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id , $user_id = false)
    {
        if ($user_id){
            PermissionHelper::abort_if_unless_permission('showEvent');
            $user = User::query()->findOrFail($user_id);
        }else{
            PermissionHelper::abort_if_unless_permission('showEventForOtherUser');
            $user = Auth::user();
        }
        $calendar_id = $user->tokens()->where('type' , GoogleCalendarToken::TYPE_CALENDAR)->firstOrFail()->calendar_id;
        try {
            return response()->json(GoogleCalendar::getEvent($calendar_id , $id));
        }catch (\Exception $e){
            abort(404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(CalendarUpdateEvnetRequest $request, $id )
    {
        if ($request->has('user_id')){
            PermissionHelper::abort_if_unless_permission('updateEvent');
            $user = User::query()->findOrFail($request->get('user_id'));
        }else{
            PermissionHelper::abort_if_unless_permission('updateEventForOtherUser');
            $user = Auth::user();
        }
        $calendar_id = $user->tokens()->where('type' , GoogleCalendarToken::TYPE_CALENDAR)->firstOrFail()->calendar_id;
        try {
            $params = $request->only(['summary' , 'location' , 'description' , 'start.dateTime' , 'start.timeZone' , 'end.dateTime' , 'end.timeZone']);
            return response()->json(GoogleCalendar::updateEvent($calendar_id , $id , $params ));
        }catch (\Exception $e){
            abort(404);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id , $user_id = false)
    {
        if ($user_id){
            PermissionHelper::abort_if_unless_permission('showEvent');
            $user = User::query()->findOrFail($user_id);
        }else{
            PermissionHelper::abort_if_unless_permission('showEventForOtherUser');
            $user = Auth::user();
        }
        $calendar_id = $user->tokens()->where('type' , GoogleCalendarToken::TYPE_CALENDAR)->firstOrFail()->calendar_id;
        try {
            return response()->json(GoogleCalendar::deleteEvent($calendar_id , $id));
        }catch (\Exception $e){
            abort(404);
        }

    }
}
