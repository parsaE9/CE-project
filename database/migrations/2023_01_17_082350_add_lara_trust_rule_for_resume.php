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
        /** @var \App\Models\Role $basicRule */
        $basicRule = \App\Models\Role::create([
            'name' => 'basic',
            'display_name' => 'Basic permissions',
            'description' => 'Basic permission for users not complete his profile',
        ]);

        $basicRule->attachPermission(\App\Models\Permission::create([
            'name' => 'resume_own_list',
            'display_name' => 'Show menu list in front',
            'description' => 'edit existing users',
        ]));

        $basicRule->attachPermission(\App\Models\Permission::create([
            'name' => 'resume_own_show',
            'display_name' => 'Show menu list in front',
            'description' => 'edit existing users',
        ]));

        $basicRule->attachPermission(\App\Models\Permission::create([
            'name' => 'resume_own_create',
            'display_name' => 'Show menu list in front',
            'description' => 'edit existing users',
        ]));

        $basicRule->attachPermission(\App\Models\Permission::create([
            'name' => 'resume_own_edit',
            'display_name' => 'Show menu list in front',
            'description' => 'edit existing users',
        ]));

        $basicRule->attachPermission(\App\Models\Permission::create([
            'name' => 'resume_own_delete',
            'display_name' => 'Show menu list in front',
            'description' => 'edit existing users',
        ]));

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
