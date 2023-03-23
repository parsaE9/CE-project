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
        $connect_to_calendar = \App\Helpers\PermissionHelper::create_permission('connectToCalendar' , 'اتصال به تقویم');
        $connect_to_calendar_other_user = \App\Helpers\PermissionHelper::create_permission('connectToCalendarOtherUser' , 'اتصال دیگر کاربران به تقویم');
        $disconnect_to_calendar = \App\Helpers\PermissionHelper::create_permission('disconnectToCalendar' , 'قطع اتصال به تفویم');
        $disconnect_other_to_calendar = \App\Helpers\PermissionHelper::create_permission('disconnectOtherUserFromCalendar' , 'قطع کاربران دیگر اتصال به تفویم');
        $user_connected_list = \App\Helpers\PermissionHelper::create_permission('userConnectedList' , 'دریافت لیست کابران متصل به تقویم');

        \App\Helpers\PermissionHelper::get_role_or_create('employer')->attachPermissions([
            $connect_to_calendar,
            $disconnect_to_calendar
        ]);

        \App\Helpers\PermissionHelper::get_role_or_create('company')->attachPermissions([
            $connect_to_calendar,
            $disconnect_to_calendar
        ]);

        \App\Helpers\PermissionHelper::get_role_or_create('admin')->attachPermissions([
            $connect_to_calendar,
            $disconnect_to_calendar,
            $disconnect_other_to_calendar,
            $connect_to_calendar_other_user,
            $user_connected_list
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
