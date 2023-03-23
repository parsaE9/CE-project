<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        $skill_create = \App\Helpers\PermissionHelper::create_permission(
            'skill_create',
            'ساخت مهارت',
            'با این دسترسی کاربر قادر به ساخت مهارت ها میباشد.'
        );

        $skill_show = \App\Helpers\PermissionHelper::create_permission(
            'skill_show',
            'نمایش یک مهارت',
            'با این دسترسی کاربر قادر به دریافت یک مهارت با استفاده از ای دی میباشد.'
        );

        $skill_list = \App\Helpers\PermissionHelper::create_permission(
            'skill_list',
             'لیست مهارت',
            'با این دسترسی کاربر قادر به دریافت لیست مهارت ها میباشد.'

        );

        $skill_update = \App\Helpers\PermissionHelper::create_permission(
             'skill_update',
           'به روز رسانی مهارت',
             'با این دسترسی کاربر قادر به به روز رسانی اطلاعات یک  مهارت ها موجود میباشد.'
        );

        $skill_delete = \App\Helpers\PermissionHelper::create_permission(
            'skill_delete',
            'حذف مهارت',
        'با این دسترسی کاربر قادر به حذف مهارت ها میباشد.'
        );


        \App\Helpers\PermissionHelper::get_role_or_create('basic')->attachPermissions([
            $skill_list,
            $skill_show,
        ]);

        \App\Helpers\PermissionHelper::get_role_or_create('admin')->attachPermissions([
            $skill_create,
            $skill_update,
            $skill_delete,
            $skill_show,
            $skill_list
        ]);

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
};
