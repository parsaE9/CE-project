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
        Schema::create('google_calandar_tokens', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->text("access_token");
            $table->timestamp('expire_at')->nullable();
            $table->text('refresh_token');
            $table->string('scope')->nullable();
            $table->string('token_type')->nullable();
            $table->string('type')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('google_calandar_tokens');
    }
};
