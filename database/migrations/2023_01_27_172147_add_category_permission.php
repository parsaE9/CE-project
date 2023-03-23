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
        $category_create = \App\Helpers\PermissionHelper::create_permission(
            'category_create',
            'ساخت دسته بندی',
            'با این دسترسی کاربر قادر به ساخت دسته بندی ها میباشد.'
        );

        $category_show = \App\Helpers\PermissionHelper::create_permission(
            'category_show',
            'نمایش یک دسته بندی',
            'با این دسترسی کاربر قادر به دریافت یک دسته بندی با استفاده از ای دی میباشد.'
        );

        $category_list = \App\Helpers\PermissionHelper::create_permission(
            'category_list',
            'لیست دسته بندی',
            'با این دسترسی کاربر قادر به دریافت لیست دسته بندی ها میباشد.'

        );

        $category_update = \App\Helpers\PermissionHelper::create_permission(
            'category_update',
            'به روز رسانی دسته بندی',
            'با این دسترسی کاربر قادر به به روز رسانی اطلاعات یک  دسته بندی ها موجود میباشد.'
        );

        $category_delete = \App\Helpers\PermissionHelper::create_permission(
            'category_delete',
            'حذف دسته بندی',
            'با این دسترسی کاربر قادر به حذف دسته بندی ها میباشد.'
        );


        \App\Helpers\PermissionHelper::get_role_or_create('basic')->attachPermissions([
            $category_list,
            $category_show,
        ]);

        \App\Helpers\PermissionHelper::get_role_or_create('admin')->attachPermissions([
            $category_create,
            $category_update,
            $category_delete,
            $category_show,
            $category_list
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
