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
        $resume_request_request = \App\Helpers\PermissionHelper::create_permission('resume_request_request', 'ارسال رزومه ها به اگهی ها');
        $resume_request_request_own = \App\Helpers\PermissionHelper::create_permission('resume_request_request_own', 'ارسال رزومه های خود به اگهی ها');

        $resume_request_delete_request = \App\Helpers\PermissionHelper::create_permission('resume_request_delete_request', 'حذف ارسال رزومه ها به اگهی ها');
        $resume_request_delete_request_own = \App\Helpers\PermissionHelper::create_permission('resume_request_delete_request_own', 'حذف ارسال رزومه های خود به اگهی ها');

        $resume_request_list = \App\Helpers\PermissionHelper::create_permission('resume_request_list', 'دریافت لیست رزومه های ارسالی تمامی کاربران');

        \App\Helpers\PermissionHelper::get_role_or_create('user')->attachPermissions([
            $resume_request_request_own,
            $resume_request_delete_request_own
        ]);

        \App\Helpers\PermissionHelper::get_role_or_create('admin')->attachPermissions([
            $resume_request_request,
            $resume_request_delete_request,
            $resume_request_list
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
