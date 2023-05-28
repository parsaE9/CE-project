<?php

namespace App\Http\Controllers\V1\Google;

use App\Helpers\GoogleCalendar;
use App\Helpers\NotificationHelper;
use App\Helpers\PermissionHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\CalendarEvnetRequest;
use App\Http\Requests\CalendarUpdateEvnetRequest;
use App\Http\Resources\EventResource;
use App\Models\Event;
use App\Models\GoogleCalendarToken;
use App\Models\User;
use Carbon\Carbon;
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
        return EventResource::collection(Event::query()->where('owner_id' , $user->id)->get());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CalendarEvnetRequest $request)
    {
        if ($request->has('owner_id')){
            PermissionHelper::abort_if_unless_permission('createEventForOtherUser');
            $user = User::query()->findOrFail($request->get('user_id'));
        }else{
            PermissionHelper::abort_if_unless_permission('createEvent');
            $user = Auth::user();
        }
        $userReserve = User::query()->findOrFail($request->get('user_id'));
        $text = "{$userReserve->name} ({$userReserve->type_data['phone']})";
        $model = Event::create([
            'text'=>$text,
            'owner_id' => $user->id,
            ...$request->only(['user_id',"start","end",'resource'])
        ]);
        if ($model){
            $time = \Morilog\Jalali\Jalalian::forge($model->start)->format('H:i');
            $date = \Morilog\Jalali\Jalalian::forge($model->resource)->format('Y/m/d ');

            NotificationHelper::createNotificationWithEmail($userReserve, $request->get('user_id'), 'نوبتی برای شما ثبت شد', "{$user->name} یک نوبت برای شما در تاریخ {$date} {$time} ثبت کرد");
        }

        return $model;
    }

    public function other(Request $request)
    {
        abort_unless($request->has('national_code'), 404);
        PermissionHelper::abort_if_unless_permission('createEvent');

        return User::query()->where('type_data->nationalCode', $request->get('national_code'))->select(['id','name', 'type_data->phone as phone'])->firstOrFail();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id , $user_id = false)
    {
//        if ($user_id){
//            PermissionHelper::abort_if_unless_permission('showEvent');
//            $user = User::query()->findOrFail($user_id);
//        }else{
//            PermissionHelper::abort_if_unless_permission('showEventForOtherUser');
//            $user = Auth::user();
//        }
//        $calendar_id = $user->tokens()->where('type' , GoogleCalendarToken::TYPE_CALENDAR)->firstOrFail()->calendar_id;
//        try {
//            return response()->json(GoogleCalendar::getEvent($calendar_id , $id));
//        }catch (\Exception $e){
//            abort(404);
//        }
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
        if ($request->has('owner_id')){
            PermissionHelper::abort_if_unless_permission('updateEvent');
            $user = User::query()->findOrFail($request->get('owner_id'));
        }else{
            PermissionHelper::abort_if_unless_permission('updateEventForOtherUser');
            $user = Auth::user();
        }
        $event = Event::query()->where('owner_id', $user->id)->where('id' , $id)->firstOrFail();

        $model =$event->fill($request->only(["start","end",'resource']))->save();
        $event->refresh();
        if ($model){
            $time = \Morilog\Jalali\Jalalian::forge($event->start)->format('H:i');
            $date = \Morilog\Jalali\Jalalian::forge($event->resource)->format('Y/m/d ');
            NotificationHelper::createNotificationWithEmail($event->user_id, $event->user_id, 'نوبت  شما ویرایش شد', "{$user->name} نوبت  شما را  به تاریخ {$date} {$time} انتقال داد.");
        }
        return $model;
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
            PermissionHelper::abort_if_unless_permission('showEventForOtherUser');
            $user = User::query()->findOrFail($user_id);
        }else{
            PermissionHelper::abort_if_unless_permission('showEvent');
            $user = Auth::user();
        }
        $event = Event::query()->where('owner_id', $user->id)->where('id', $id)->firstOrFail();
        $model =  $event->delete();
        if ($model){
            NotificationHelper::createNotificationWithEmail($event->user_id, $event->user_id, 'نوبت  شما حذف شد', "{$user->name} نوبت شما را حذف کرد.");
        }
        return $model;
    }
}
