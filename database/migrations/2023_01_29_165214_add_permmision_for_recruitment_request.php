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
        $recruitment_request_list_own = \App\Helpers\PermissionHelper::create_permission('recruitment_request_list_own' , 'نمایش درخواست های ارسال شده به اگهی خود');
        $recruitment_request_list = \App\Helpers\PermissionHelper::create_permission('recruitment_request_list' , 'نمایش درخواست های ارسال شده به اگهی ها');

        $recruitment_request_change_status = \App\Helpers\PermissionHelper::create_permission('recruitment_request_change_status' , 'تغیر وضعیت ریکوست ها');
        $recruitment_request_change_status_own = \App\Helpers\PermissionHelper::create_permission('recruitment_request_change_status_own' , 'تغیر وضعیت ریکوست ها خود');


        \App\Helpers\PermissionHelper::get_role_or_create('employer')->attachPermissions([
            $recruitment_request_list_own,
            $recruitment_request_change_status_own
        ]);

        \App\Helpers\PermissionHelper::get_role_or_create('company')->attachPermissions([
            $recruitment_request_list_own,
            $recruitment_request_change_status_own
        ]);

        \App\Helpers\PermissionHelper::get_role_or_create('admin')->attachPermissions([
            $recruitment_request_list,
            $recruitment_request_change_status
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
