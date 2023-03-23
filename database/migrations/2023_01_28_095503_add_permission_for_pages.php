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
        $page_store_own = \App\Helpers\PermissionHelper::create_permission('page_store_own' , 'ساخت و ویرایش صفحه خودش', '');
        $page_store = \App\Helpers\PermissionHelper::create_permission('page_store' , 'ساخت و ویرایش صفحه', '');
        $page_list = \App\Helpers\PermissionHelper::create_permission('page_list' , 'دریافت لیت تمامی صفخه ها', '');
        $page_show = \App\Helpers\PermissionHelper::create_permission('page_show' , 'دریافت اطلاعات صفحه به صورت تکی', '');

        \App\Helpers\PermissionHelper::get_role_or_create('basic')->attachPermissions([
           $page_show
        ]);

        \App\Helpers\PermissionHelper::get_role_or_create('employer')->attachPermissions([
            $page_store_own,
        ]);

        \App\Helpers\PermissionHelper::get_role_or_create('admin')->attachPermissions([
           $page_store_own,
           $page_store,
           $page_list,
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
