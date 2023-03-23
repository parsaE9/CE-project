<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProvincesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('provinces', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 100);
        });


        \Illuminate\Support\Facades\DB::table('provinces')->insert(array (
            0 =>
                array (
                    'id' => 1,
                    'name' => 'آذربايجان شرقي',
                ),
            1 =>
                array (
                    'id' => 2,
                    'name' => 'آذربايجان غربي',
                ),
            2 =>
                array (
                    'id' => 3,
                    'name' => 'اردبيل',
                ),
            3 =>
                array (
                    'id' => 4,
                    'name' => 'اصفهان',
                ),
            4 =>
                array (
                    'id' => 5,
                    'name' => 'البرز',
                ),
            5 =>
                array (
                    'id' => 6,
                    'name' => 'ايلام',
                ),
            6 =>
                array (
                    'id' => 7,
                    'name' => 'بوشهر',
                ),
            7 =>
                array (
                    'id' => 8,
                    'name' => 'تهران',
                ),
            8 =>
                array (
                    'id' => 9,
                    'name' => 'چهارمحال بختياري',
                ),
            9 =>
                array (
                    'id' => 10,
                    'name' => 'خراسان جنوبي',
                ),
            10 =>
                array (
                    'id' => 11,
                    'name' => 'خراسان رضوي',
                ),
            11 =>
                array (
                    'id' => 12,
                    'name' => 'خراسان شمالي',
                ),
            12 =>
                array (
                    'id' => 13,
                    'name' => 'خوزستان',
                ),
            13 =>
                array (
                    'id' => 14,
                    'name' => 'زنجان',
                ),
            14 =>
                array (
                    'id' => 15,
                    'name' => 'سمنان',
                ),
            15 =>
                array (
                    'id' => 16,
                    'name' => 'سيستان و بلوچستان',
                ),
            16 =>
                array (
                    'id' => 17,
                    'name' => 'فارس',
                ),
            17 =>
                array (
                    'id' => 18,
                    'name' => 'قزوين',
                ),
            18 =>
                array (
                    'id' => 19,
                    'name' => 'قم',
                ),
            19 =>
                array (
                    'id' => 20,
                    'name' => 'كردستان',
                ),
            20 =>
                array (
                    'id' => 21,
                    'name' => 'كرمان',
                ),
            21 =>
                array (
                    'id' => 22,
                    'name' => 'كرمانشاه',
                ),
            22 =>
                array (
                    'id' => 23,
                    'name' => 'كهكيلويه و بويراحمد',
                ),
            23 =>
                array (
                    'id' => 24,
                    'name' => 'گلستان',
                ),
            24 =>
                array (
                    'id' => 25,
                    'name' => 'گيلان',
                ),
            25 =>
                array (
                    'id' => 26,
                    'name' => 'لرستان',
                ),
            26 =>
                array (
                    'id' => 27,
                    'name' => 'مازندران',
                ),
            27 =>
                array (
                    'id' => 28,
                    'name' => 'مركزي',
                ),
            28 =>
                array (
                    'id' => 29,
                    'name' => 'هرمزگان',
                ),
            29 =>
                array (
                    'id' => 30,
                    'name' => 'همدان',
                ),
            30 =>
                array (
                    'id' => 31,
                    'name' => 'يزد',
                ),
        ));

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        \Illuminate\Support\Facades\DB::table('provinces')->delete();
        Schema::dropIfExists('provinces');
    }
}
