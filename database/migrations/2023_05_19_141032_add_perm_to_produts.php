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
        $product_create = \App\Helpers\PermissionHelper::create_permission('product_create' , 'ساخت محصول');
        $product_edit = \App\Helpers\PermissionHelper::create_permission('product_edit' , 'ویرایش محصول');
        $product_edit_own = \App\Helpers\PermissionHelper::create_permission('product_edit_own' , 'ویرایش محصول خود');
        $product_update = \App\Helpers\PermissionHelper::create_permission('product_update' , 'به روز رسانی محصول');
        $product_update_own = \App\Helpers\PermissionHelper::create_permission('product_update_own' , 'به روز رسانی خود');
        $product_delete = \App\Helpers\PermissionHelper::create_permission('product_delete' , 'حذف محصول');
        $product_delete_own = \App\Helpers\PermissionHelper::create_permission('product_delete_own' , 'حذف محصول خود');


        $product_update_status = \App\Helpers\PermissionHelper::create_permission('product_update_status' , 'گرفتن لیست رویداد های خود');
        $product_update_status_own = \App\Helpers\PermissionHelper::create_permission('product_update_status_own' , 'گرفتن لیست رویداد های خود');


        \App\Helpers\PermissionHelper::get_role_or_create('company')->attachPermissions([
            $product_create,
            $product_delete_own,
            $product_edit_own,
            $product_update_own,
            $product_update_status_own
        ]);

        \App\Helpers\PermissionHelper::get_role_or_create('admin')->attachPermissions([
            $product_create,
            $product_delete_own,
            $product_delete,
            $product_edit_own,
            $product_edit,
            $product_update_own,
            $product_update,
            $product_update_status_own,
            $product_update_status
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

    }
};
