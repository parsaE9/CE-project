<?php

namespace App\Http\Controllers\V1\Auth;

use App\Helpers\EventLogHelper;
use App\Helpers\PermissionHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RefreshTokenRequest;
use App\Http\Requests\UserRegisterRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Services\AuthTokenService;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Laravel\Passport\ApiTokenCookieFactory;
use function MongoDB\BSON\toJSON;

class UserAuthController extends Controller
{

    /**
     * Store a newly created resource in storage.
     * @OA\Post (
     *      description="user register with email and password",
     *      summary="user register",
     *      path="api/v1/register",
     *      @OA\Response(response=200 , description="some description"),
     *  )
     */
    public function register(UserRegisterRequest $request)
    {
        /** @var User $user */
        $user = User::create($request->only(['email' , 'password' , 'name']));
        $user->attachRole(PermissionHelper::get_role('basic'));

        EventLogHelper::addEventLog('register' , 'ثبت نام کابر شماره ' . $user->name , '', [
            EventLogHelper::createMeta($user , 'کاربر ثبت نام شده'),
        ]);

        return array_merge(AuthTokenService::getInstance()->grantToken($request->get('email') , $request->get('password')) , [
            'user' => new UserResource($user)
        ]);
    }

    public function login(LoginRequest $request){
        $res = AuthTokenService::getInstance()->grantToken($request->get('email') , $request->get('password'));

        if (isset($res['error'])){
            EventLogHelper::addEventLog('login' , 'ورود ناموفق ' . $request->get('email') , '');
            throw ValidationException::withMessages([
                'email' => 'نام کاربری یا رمز عبور اشتباه است'
            ]);
        }

        EventLogHelper::addEventLog('login' , 'ورود  ' . $request->get('email') , '');

        return $res;
    }

    public function refreshToken(RefreshTokenRequest $request){
        $res = AuthTokenService::getInstance()->refreshAccessToken($request->get("refresh_token"));

        if (isset($res['error'])){
            throw ValidationException::withMessages([
                'refresh_token' => 'Invalid refresh token'
            ]);
        }
        return $res;
    }

}
