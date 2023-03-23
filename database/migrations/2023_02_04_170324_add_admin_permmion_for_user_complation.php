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
        \App\Helpers\PermissionHelper::get_role('admin')->attachPermission(
            \App\Helpers\PermissionHelper::create_permission('user_completion_change_other_user', 'تغیر وضعیت دیگر کاربران')
        );
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
