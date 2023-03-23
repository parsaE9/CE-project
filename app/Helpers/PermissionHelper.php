<?php

namespace App\Helpers;

use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class PermissionHelper
{
    public static function check_permission($permission) : bool
    {
        if (env('APP_DEBUG'))
            return true;

        /** @var User $user */
        $user = Auth::user();
        if (! $user) return false;

        return $user->hasPermission($permission);
    }


    public static function abort_if_unless_permission($permission, $code=403, $message='' , $headers=[])
    {
        if (!self::check_permission($permission)) abort($code , $message , $headers);
    }

    public static function check_permission_with_own_model($permission , $model , $id = 'user_id')
    {
        if (self::check_permission($permission)){
            return $model->$id == Auth::id();
        }
        return false;
    }

    public static function check_admin_or_permmition_with_own_model($admin_perm , $perm, $model , $id = 'user_id')
    {
        return Auth::user()->hasPermission($admin_perm) || self::check_permission_with_own_model($perm , $model , $id);
    }

    public static function abort_if_unless_admin_or_permmition_with_own_model($admin_perm , $perm, $model , $id = 'user_id', $code=403, $message='' , $headers=[])
    {
        if (!self::check_admin_or_permmition_with_own_model($admin_perm , $perm, $model , $id))  abort($code , $message , $headers);
    }

    public static function abort_if_unless_permission_with_own_model($permission , $model , $id = 'user_id' , $code=403, $message='' , $headers=[])
    {
        if (!self::check_permission_with_own_model($permission , $model , $id))  abort($code , $message , $headers);
    }

    public static function create_role($name , $display_name = null , $description = null) : Role
    {
        return Role::create([
            'name' => $name,
            'display_name' => $display_name,
            'description' => $description
        ]);
    }
    public static function get_role($name) : Role|null
    {
        return Role::query()->where('name' , $name)->first();
    }
    public static function get_role_or_create($name , $display_name = null , $description = null)
    {
        $role = self::get_role($name);

        if (! $role){
            $role = self::create_role($name ,$display_name , $description);
        }

        return $role;
    }

    public static function create_permission($name , $display_name = null , $description = null) : Permission
    {
        return Permission::create([
            'name' => $name,
            'display_name' => $display_name,
            'description' => $description
        ]);
    }

    public static function get_permmision($name)
    {
        return Permission::query()->where('name' , $name)->first();
    }
}