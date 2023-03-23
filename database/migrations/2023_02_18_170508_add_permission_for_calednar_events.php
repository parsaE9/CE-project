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
        $get_event_list = \App\Helpers\PermissionHelper::create_permission('getUserEventList' , 'گرفتن لیست رویداد های خود');
        $create_event = \App\Helpers\PermissionHelper::create_permission('createEvent' , 'ساخت رویداد برای خود');
        $update_event = \App\Helpers\PermissionHelper::create_permission('updateEvent' , 'به روز رسانی رویداد برای خود');
        $delete_event = \App\Helpers\PermissionHelper::create_permission('deleteEvent' , 'حذف رویداد برای خود');
        $create_event_for_other_user = \App\Helpers\PermissionHelper::create_permission('createEventForOtherUser' , 'ساخت رویداد برای دیگران');
        $update_event_for_other_user = \App\Helpers\PermissionHelper::create_permission('updateEventForOtherUser' , 'به روز رسانی رویداد برای دیگران');
        $delete_event_for_other_user = \App\Helpers\PermissionHelper::create_permission('deleteEventForOtherUser' , 'حذف رویداد برای دیگران');
        $show_event = \App\Helpers\PermissionHelper::create_permission('showEvent' , 'نمایش رویداد های خود');
        $show_event_for_other_user = \App\Helpers\PermissionHelper::create_permission('showEventForOtherUser' , 'نمایش رویداد های دیگران');
        $get_other_user_event_list = \App\Helpers\PermissionHelper::create_permission('getOtherUserEventList' , 'دریافت لیست رویداد های دیگر کاربران');

        \App\Helpers\PermissionHelper::get_role_or_create('employer')->attachPermissions([
            $get_event_list,
            $create_event,
            $show_event,
            $update_event,
            $delete_event
        ]);

        \App\Helpers\PermissionHelper::get_role_or_create('company')->attachPermissions([
            $get_event_list,
            $create_event,
            $show_event,
            $update_event,
            $delete_event
        ]);

        \App\Helpers\PermissionHelper::get_role_or_create('admin')->attachPermissions([
            $get_event_list,
            $get_other_user_event_list,
            $create_event,
            $create_event_for_other_user,
            $show_event,
            $show_event_for_other_user,
            $update_event,
            $update_event_for_other_user,
            $delete_event,
            $delete_event_for_other_user,
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
