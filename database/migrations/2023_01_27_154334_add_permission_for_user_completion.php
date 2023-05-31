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
        $user_completion_change_status = \App\Helpers\PermissionHelper::create_permission('user_completion_change_status' , 'تغیر وضعیت اطلاعات کابر' , '');
        $user_completion_update = \App\Helpers\PermissionHelper::create_permission('user_completion_update' , 'تغیر وضعیت اطلاعات کابر' , '');
        $user_completion_store = \App\Helpers\PermissionHelper::create_permission('user_completion_store' , 'تغیر وضعیت اطلاعات کابر' , '');

        \App\Helpers\PermissionHelper::get_role_or_create('basic')->attachPermissions([
            $user_completion_store,
            $user_completion_update
        ]);

        \App\Helpers\PermissionHelper::get_role_or_create('admin')->attachPermissions([
            $user_completion_change_status,
            $user_completion_store,
            $user_completion_update
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
