<?php

namespace App\Http\Controllers\V1;

use App\Helpers\FileHelper;
use App\Helpers\PermissionHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserCompletionRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserCompletion extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserCompletionRequest $request)
    {
        /** @var User $user */
        $user = Auth::user();
        if ($request->has('user_id')){
            PermissionHelper::abort_if_unless_permission('user_completion_change_other_user');
            $user = User::query()->findOrFail($request->get('user_id'));
        }

        PermissionHelper::abort_if_unless_permission($user->type_data ? 'user_completion_update' : 'user_completion_store');

        FileHelper::UploadAllowFields($request , ['avatar', 'licence_document']);

        if ($user->status == "draft"){
            $user->status = match ($request->get('type')){
                'user' => User::STATUS_ACTIVE,
//                default => User::STATUS_PENDING
                default => User::STATUS_ACTIVE
            };
        }else if ($user->status != "user"){
//            $user->status = User::STATUS_PENDING;
            $user->status = User::STATUS_ACTIVE;
        }

        if ($request->has('status') || $user->status == User::STATUS_ACTIVE){
//            $user->status = $request->get('status');
            $user->status = User::STATUS_ACTIVE;
            $user->roles()->detach();
            $user->attachRole(PermissionHelper::get_role('basic'));

            if ($user->status == User::STATUS_ACTIVE){

                switch ($request->get('type')){
                    case "employer":
                        $user->attachRole(PermissionHelper::get_role('employer'));
                        break;
                    case "company":
                        $user->attachRole(PermissionHelper::get_role('company'));
                        break;
                    case "user":
                        $user->attachRole(PermissionHelper::get_role('user'));
                        break;
                }
            }
        }

        $user->type = $request->get('type');
        $user->type_data = $request->only(array_filter(array_keys($request->rules()), function ($k) {
            return !str_contains($k , "*");
        }
        ));
        $user->save();

        return $user;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
