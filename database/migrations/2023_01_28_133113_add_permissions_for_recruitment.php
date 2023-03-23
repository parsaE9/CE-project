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
        $recruitment_create = \App\Helpers\PermissionHelper::create_permission('recruitment_create', 'ایجاد کردن یک اگهی' , '');
        $recruitment_update_own = \App\Helpers\PermissionHelper::create_permission('recruitment_update_own', 'به روز رسانی اطلاعات اگهی خود' , '');
        $recruitment_update = \App\Helpers\PermissionHelper::create_permission('recruitment_update', 'قابلبت به روز رسانی اگهی دیگران' , '');
        $recruitment_change_status = \App\Helpers\PermissionHelper::create_permission('recruitment_change_status', 'به روز رسانی وضعیت ها به منتشر شده' , '');
        $recruitment_delete_own = \App\Helpers\PermissionHelper::create_permission('recruitment_delete_own', 'حذف اطلاعات اگهی خود' , '');
        $recruitment_delete = \App\Helpers\PermissionHelper::create_permission('recruitment_delete', 'قابلبت حذف اگهی دیگران' , '');

        \App\Helpers\PermissionHelper::get_role_or_create('employer')->attachPermissions([
            $recruitment_create,
            $recruitment_update_own,
            $recruitment_delete_own
        ]);

        \App\Helpers\PermissionHelper::get_role_or_create('company')->attachPermissions([
            $recruitment_create,
            $recruitment_update_own,
            $recruitment_delete_own
        ]);

        \App\Helpers\PermissionHelper::get_role_or_create('admin')->attachPermissions([
            $recruitment_create,
            $recruitment_update_own,
            $recruitment_delete_own,
            $recruitment_update,
            $recruitment_change_status,
            $recruitment_delete
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
