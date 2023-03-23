<?php

namespace App\Http\Controllers\V1\Admin;

use App\Helpers\PermissionHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Http\Requests\UserCreateRequest;
use App\Http\Resources\UserResource;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use phpseclib3\Crypt\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function index()
    {
        PermissionHelper::abort_if_unless_permission('user_list');
        return User::advancedFilter();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return UserResource
     */
    public function store(UserCreateRequest $request)
    {
        PermissionHelper::abort_if_unless_permission('user_create');
        $user = User::create($request->only(['name', 'email', 'password']));
        $request->has('role') ? $user->attachRole(PermissionHelper::get_role($request->input('role'))) :
            $user->attachRole(PermissionHelper::get_role('basic'));
        return new UserResource($user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     */
    public function update(UserCreateRequest $request, User $user)
    {
        PermissionHelper::abort_if_unless_permission('user_update');
        $user->fill($request->only(['name', 'email', 'password','status']))->save();
        $request->has('role') ? $user->attachRole(PermissionHelper::get_role($request->input('role'))) :
            $user->attachRole(PermissionHelper::get_role('basic'));
        return new UserResource($user);
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function show(User $user)
    {
        return $user;
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return bool
     */
    public function destroy(User $user)
    {
        PermissionHelper::abort_if_unless_permission('user_delete');
        return $user->delete();
    }
}
