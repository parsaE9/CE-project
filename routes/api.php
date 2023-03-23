<?php

use App\Http\Controllers\V1\Admin\UserController;
use App\Http\Controllers\V1\Auth\UserAuthController;
use App\Http\Controllers\V1\Resume\ResumeController;
use App\Http\Controllers\V1\Resume\ResumeShowController;
use App\Http\Controllers\V1\TicketController;
use App\Http\Middleware\UserCompletionCheck;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/**
 * Route Without need authentication
 */
Route::withoutMiddleware(['auth:api' , UserCompletionCheck::class])->group(function(){

    /**
     * login and register
     */
    Route::middleware('guest')->post('/register', [UserAuthController::class , "register"]);
    Route::middleware('guest')->post('/login', [UserAuthController::class , "login"]);
    Route::middleware('guest')->post('/login/refresh', [UserAuthController::class , "refreshToken"]);

    /**
     * resume show
     */
    Route::get('resume/show/{resume}' , [ResumeShowController::class , 'index']);

    /**
     * page get data
     */
    Route::get('page/{user}' , [\App\Http\Controllers\V1\PageController::class , 'show']);

    /**
     * City & Province
     */
    Route::apiResource('province' , \App\Http\Controllers\V1\ProvinceController::class)->only(['index',  'show']);
    Route::apiResource('cities' , \App\Http\Controllers\V1\CityController::class)->only(['index' , 'show' , 'store']);
});

/**
 *
 * user Auth
 */
Route::withoutMiddleware(UserCompletionCheck::class)->group(function (){
    Route::apiResource('user' , \App\Http\Controllers\V1\UserController::class)->only('index');
    Route::apiResource('userCompletion' , \App\Http\Controllers\V1\UserCompletion::class)->only('store');
    Route::apiResource('skill' , \App\Http\Controllers\V1\SkillsController::class);
    Route::apiResource('category' , \App\Http\Controllers\V1\CategoryController::class);
    Route::apiResource('ticket' , TicketController::class);
    Route::post("conversation", [TicketController::class, "message"])->name('conversation.store');


    /**
     * user Login Permissions
     */
    Route::get('permissions' , function (){
        /** @var \App\Models\User $user */

       $user = \Illuminate\Support\Facades\Auth::user();

       return $user->allPermissions();
    });
});



/**
 * Resume
 */
Route::apiResource('resume' , ResumeController::class)->only('index' , 'store' , 'show' , 'destroy');
Route::post("resume/{resume}" , [ResumeController::class , 'update']);

/**
 * Pages
 */
Route::apiResource('page' , \App\Http\Controllers\V1\PageController::class)->only(['index' , 'store' , 'update']);

/**
 * Resume requests
 */
Route::apiResource('resumeRequest' , \App\Http\Controllers\V1\ResumeRequestController::class)->only(['index' , 'store' , 'destroy']);

/**
 * Recruitment Requests
 */
Route::apiResource('recruitmentRequest' , \App\Http\Controllers\V1\RecruitmentRequetsController::class)->only(['show' , 'store']);

/**
 * Recruitment List
 */
Route::put('recruitment/status/{recruitment}' , [\App\Http\Controllers\V1\RecruitmentController::class , 'updateStatus'] );
Route::resource('recruitment' , \App\Http\Controllers\V1\RecruitmentController::class )->withoutMiddleware(UserCompletionCheck::class)->names('recruitment');

/**
 * Admin Route Group
 */

Route::prefix('admin')->withoutMiddleware(UserCompletionCheck::class)->group(function () {
    Route::resource('users' , UserController::class )->names('admin.users');
    Route::apiResource('ticket' , \App\Http\Controllers\V1\Admin\TicketController::class);

});

Route::get('report' , function (){
   return [
       'companyCount' => \App\Models\User::query()->where('type' , 'company')->count(),
       'activeRecruitment' => \App\Models\Recruitment::query()->where('status' , \App\Models\Recruitment::STATUS_PUBLISH)->count()
   ];
});

Route::apiResource('companies' , \App\Http\Controllers\CompanyEmployerListController::class)->only('index');

Route::get('google/calendar/connect/save' , [\App\Http\Controllers\V1\Google\CalendarConnectController::class , 'store'])->name("google_calendar.save");
Route::get('google/calendar/connect' , [\App\Http\Controllers\V1\Google\CalendarConnectController::class , 'index'])->name("google_calendar.index");
Route::get('google/calendar/user/list' , [\App\Http\Controllers\V1\Google\CalendarConnectController::class , 'users']);
Route::get('google/calendar/isConnected/{id?}' , [\App\Http\Controllers\V1\Google\CalendarConnectController::class , 'show'])
    ->name("google_calendar.show")
    ->where(['id' => '[0-9]+']);
Route::get('google/calendar/disconnect/{id?}' , [\App\Http\Controllers\V1\Google\CalendarConnectController::class , 'destroy'])
    ->name("google_calendar.index")
    ->where(['id' => '[0-9]+']);

Route::get('google/calendar/user/events/{id?}' , [\App\Http\Controllers\V1\Google\CalendarEventController::class , 'index'])
    ->where(['id' => '[0-9]+']);

Route::get('google/calendar/user/events/show/{id}/{user_id?}' , [\App\Http\Controllers\V1\Google\CalendarEventController::class , 'show'])
    ->where(['user_id' => '[0-9]+']);

Route::delete('google/calendar/user/events/delete/{id}/{user_id?}' , [\App\Http\Controllers\V1\Google\CalendarEventController::class , 'destroy'])
    ->where(['user_id' => '[0-9]+']);

Route::post('google/calendar/user/events/update/{id}' , [\App\Http\Controllers\V1\Google\CalendarEventController::class , 'update']);

Route::post('google/calendar/user/events' , [\App\Http\Controllers\V1\Google\CalendarEventController::class , 'store']);