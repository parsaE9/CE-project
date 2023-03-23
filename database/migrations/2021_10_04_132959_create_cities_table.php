<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cities', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('province_id')->index('fk_provinceid_idx');
            $table->string('name', 200);
        });

        Schema::table('cities', function (Blueprint $table) {
            $table->foreign(['province_id'], 'fk_provinceid')->references(['id'])->on('provinces');
        });


        \Illuminate\Support\Facades\DB::table('cities')->insert(array (
            0 =>
                array (
                    'id' => 1,
                    'province_id' => 1,
                    'name' => 'تبريز',
                ),
            1 =>
                array (
                    'id' => 2,
                    'province_id' => 1,
                    'name' => 'كندوان',
                ),
            2 =>
                array (
                    'id' => 3,
                    'province_id' => 1,
                    'name' => 'بندر شرفخانه',
                ),
            3 =>
                array (
                    'id' => 4,
                    'province_id' => 1,
                    'name' => 'مراغه',
                ),
            4 =>
                array (
                    'id' => 5,
                    'province_id' => 1,
                    'name' => 'ميانه',
                ),
            5 =>
                array (
                    'id' => 6,
                    'province_id' => 1,
                    'name' => 'شبستر',
                ),
            6 =>
                array (
                    'id' => 7,
                    'province_id' => 1,
                    'name' => 'مرند',
                ),
            7 =>
                array (
                    'id' => 8,
                    'province_id' => 1,
                    'name' => 'جلفا',
                ),
            8 =>
                array (
                    'id' => 9,
                    'province_id' => 1,
                    'name' => 'سراب',
                ),
            9 =>
                array (
                    'id' => 10,
                    'province_id' => 1,
                    'name' => 'هاديشهر',
                ),
            10 =>
                array (
                    'id' => 11,
                    'province_id' => 1,
                    'name' => 'بناب',
                ),
            11 =>
                array (
                    'id' => 12,
                    'province_id' => 1,
                    'name' => 'كليبر',
                ),
            12 =>
                array (
                    'id' => 13,
                    'province_id' => 1,
                    'name' => 'تسوج',
                ),
            13 =>
                array (
                    'id' => 14,
                    'province_id' => 1,
                    'name' => 'اهر',
                ),
            14 =>
                array (
                    'id' => 15,
                    'province_id' => 1,
                    'name' => 'هريس',
                ),
            15 =>
                array (
                    'id' => 16,
                    'province_id' => 1,
                    'name' => 'عجبشير',
                ),
            16 =>
                array (
                    'id' => 17,
                    'province_id' => 1,
                    'name' => 'هشترود',
                ),
            17 =>
                array (
                    'id' => 18,
                    'province_id' => 1,
                    'name' => 'ملكان',
                ),
            18 =>
                array (
                    'id' => 19,
                    'province_id' => 1,
                    'name' => 'بستان آباد',
                ),
            19 =>
                array (
                    'id' => 20,
                    'province_id' => 1,
                    'name' => 'ورزقان',
                ),
            20 =>
                array (
                    'id' => 21,
                    'province_id' => 1,
                    'name' => 'اسكو',
                ),
            21 =>
                array (
                    'id' => 22,
                    'province_id' => 1,
                    'name' => 'آذر شهر',
                ),
            22 =>
                array (
                    'id' => 23,
                    'province_id' => 1,
                    'name' => 'قره آغاج',
                ),
            23 =>
                array (
                    'id' => 24,
                    'province_id' => 1,
                    'name' => 'ممقان',
                ),
            24 =>
                array (
                    'id' => 25,
                    'province_id' => 1,
                    'name' => 'صوفیان',
                ),
            25 =>
                array (
                    'id' => 26,
                    'province_id' => 1,
                    'name' => 'ایلخچی',
                ),
            26 =>
                array (
                    'id' => 27,
                    'province_id' => 1,
                    'name' => 'خسروشهر',
                ),
            27 =>
                array (
                    'id' => 28,
                    'province_id' => 1,
                    'name' => 'باسمنج',
                ),
            28 =>
                array (
                    'id' => 29,
                    'province_id' => 1,
                    'name' => 'سهند',
                ),
            29 =>
                array (
                    'id' => 30,
                    'province_id' => 2,
                    'name' => 'اروميه',
                ),
            30 =>
                array (
                    'id' => 31,
                    'province_id' => 2,
                    'name' => 'نقده',
                ),
            31 =>
                array (
                    'id' => 32,
                    'province_id' => 2,
                    'name' => 'ماكو',
                ),
            32 =>
                array (
                    'id' => 33,
                    'province_id' => 2,
                    'name' => 'تكاب',
                ),
            33 =>
                array (
                    'id' => 34,
                    'province_id' => 2,
                    'name' => 'خوي',
                ),
            34 =>
                array (
                    'id' => 35,
                    'province_id' => 2,
                    'name' => 'مهاباد',
                ),
            35 =>
                array (
                    'id' => 36,
                    'province_id' => 2,
                    'name' => 'سر دشت',
                ),
            36 =>
                array (
                    'id' => 37,
                    'province_id' => 2,
                    'name' => 'چالدران',
                ),
            37 =>
                array (
                    'id' => 38,
                    'province_id' => 2,
                    'name' => 'بوكان',
                ),
            38 =>
                array (
                    'id' => 39,
                    'province_id' => 2,
                    'name' => 'مياندوآب',
                ),
            39 =>
                array (
                    'id' => 40,
                    'province_id' => 2,
                    'name' => 'سلماس',
                ),
            40 =>
                array (
                    'id' => 41,
                    'province_id' => 2,
                    'name' => 'شاهين دژ',
                ),
            41 =>
                array (
                    'id' => 42,
                    'province_id' => 2,
                    'name' => 'پيرانشهر',
                ),
            42 =>
                array (
                    'id' => 43,
                    'province_id' => 2,
                    'name' => 'سيه چشمه',
                ),
            43 =>
                array (
                    'id' => 44,
                    'province_id' => 2,
                    'name' => 'اشنويه',
                ),
            44 =>
                array (
                    'id' => 45,
                    'province_id' => 2,
                    'name' => 'چایپاره',
                ),
            45 =>
                array (
                    'id' => 46,
                    'province_id' => 2,
                    'name' => 'پلدشت',
                ),
            46 =>
                array (
                    'id' => 47,
                    'province_id' => 2,
                    'name' => 'شوط',
                ),
            47 =>
                array (
                    'id' => 48,
                    'province_id' => 3,
                    'name' => 'اردبيل',
                ),
            48 =>
                array (
                    'id' => 49,
                    'province_id' => 3,
                    'name' => 'سرعين',
                ),
            49 =>
                array (
                    'id' => 50,
                    'province_id' => 3,
                    'name' => 'بيله سوار',
                ),
            50 =>
                array (
                    'id' => 51,
                    'province_id' => 3,
                    'name' => 'پارس آباد',
                ),
            51 =>
                array (
                    'id' => 52,
                    'province_id' => 3,
                    'name' => 'خلخال',
                ),
            52 =>
                array (
                    'id' => 53,
                    'province_id' => 3,
                    'name' => 'مشگين شهر',
                ),
            53 =>
                array (
                    'id' => 54,
                    'province_id' => 3,
                    'name' => 'مغان',
                ),
            54 =>
                array (
                    'id' => 55,
                    'province_id' => 3,
                    'name' => 'نمين',
                ),
            55 =>
                array (
                    'id' => 56,
                    'province_id' => 3,
                    'name' => 'نير',
                ),
            56 =>
                array (
                    'id' => 57,
                    'province_id' => 3,
                    'name' => 'كوثر',
                ),
            57 =>
                array (
                    'id' => 58,
                    'province_id' => 3,
                    'name' => 'كيوي',
                ),
            58 =>
                array (
                    'id' => 59,
                    'province_id' => 3,
                    'name' => 'گرمي',
                ),
            59 =>
                array (
                    'id' => 60,
                    'province_id' => 4,
                    'name' => 'اصفهان',
                ),
            60 =>
                array (
                    'id' => 61,
                    'province_id' => 4,
                    'name' => 'فريدن',
                ),
            61 =>
                array (
                    'id' => 62,
                    'province_id' => 4,
                    'name' => 'فريدون شهر',
                ),
            62 =>
                array (
                    'id' => 63,
                    'province_id' => 4,
                    'name' => 'فلاورجان',
                ),
            63 =>
                array (
                    'id' => 64,
                    'province_id' => 4,
                    'name' => 'گلپايگان',
                ),
            64 =>
                array (
                    'id' => 65,
                    'province_id' => 4,
                    'name' => 'دهاقان',
                ),
            65 =>
                array (
                    'id' => 66,
                    'province_id' => 4,
                    'name' => 'نطنز',
                ),
            66 =>
                array (
                    'id' => 67,
                    'province_id' => 4,
                    'name' => 'نايين',
                ),
            67 =>
                array (
                    'id' => 68,
                    'province_id' => 4,
                    'name' => 'تيران',
                ),
            68 =>
                array (
                    'id' => 69,
                    'province_id' => 4,
                    'name' => 'كاشان',
                ),
            69 =>
                array (
                    'id' => 70,
                    'province_id' => 4,
                    'name' => 'فولاد شهر',
                ),
            70 =>
                array (
                    'id' => 71,
                    'province_id' => 4,
                    'name' => 'اردستان',
                ),
            71 =>
                array (
                    'id' => 72,
                    'province_id' => 4,
                    'name' => 'سميرم',
                ),
            72 =>
                array (
                    'id' => 73,
                    'province_id' => 4,
                    'name' => 'درچه',
                ),
            73 =>
                array (
                    'id' => 74,
                    'province_id' => 4,
                    'name' => 'کوهپایه',
                ),
            74 =>
                array (
                    'id' => 75,
                    'province_id' => 4,
                    'name' => 'مباركه',
                ),
            75 =>
                array (
                    'id' => 76,
                    'province_id' => 4,
                    'name' => 'شهرضا',
                ),
            76 =>
                array (
                    'id' => 77,
                    'province_id' => 4,
                    'name' => 'خميني شهر',
                ),
            77 =>
                array (
                    'id' => 78,
                    'province_id' => 4,
                    'name' => 'شاهين شهر',
                ),
            78 =>
                array (
                    'id' => 79,
                    'province_id' => 4,
                    'name' => 'نجف آباد',
                ),
            79 =>
                array (
                    'id' => 80,
                    'province_id' => 4,
                    'name' => 'دولت آباد',
                ),
            80 =>
                array (
                    'id' => 81,
                    'province_id' => 4,
                    'name' => 'زرين شهر',
                ),
            81 =>
                array (
                    'id' => 82,
                    'province_id' => 4,
                    'name' => 'آران و بيدگل',
                ),
            82 =>
                array (
                    'id' => 83,
                    'province_id' => 4,
                    'name' => 'باغ بهادران',
                ),
            83 =>
                array (
                    'id' => 84,
                    'province_id' => 4,
                    'name' => 'خوانسار',
                ),
            84 =>
                array (
                    'id' => 85,
                    'province_id' => 4,
                    'name' => 'مهردشت',
                ),
            85 =>
                array (
                    'id' => 86,
                    'province_id' => 4,
                    'name' => 'علويجه',
                ),
            86 =>
                array (
                    'id' => 87,
                    'province_id' => 4,
                    'name' => 'عسگران',
                ),
            87 =>
                array (
                    'id' => 88,
                    'province_id' => 4,
                    'name' => 'نهضت آباد',
                ),
            88 =>
                array (
                    'id' => 89,
                    'province_id' => 4,
                    'name' => 'حاجي آباد',
                ),
            89 =>
                array (
                    'id' => 90,
                    'province_id' => 4,
                    'name' => 'تودشک',
                ),
            90 =>
                array (
                    'id' => 91,
                    'province_id' => 4,
                    'name' => 'ورزنه',
                ),
            91 =>
                array (
                    'id' => 92,
                    'province_id' => 6,
                    'name' => 'ايلام',
                ),
            92 =>
                array (
                    'id' => 93,
                    'province_id' => 6,
                    'name' => 'مهران',
                ),
            93 =>
                array (
                    'id' => 94,
                    'province_id' => 6,
                    'name' => 'دهلران',
                ),
            94 =>
                array (
                    'id' => 95,
                    'province_id' => 6,
                    'name' => 'آبدانان',
                ),
            95 =>
                array (
                    'id' => 96,
                    'province_id' => 6,
                    'name' => 'شيروان چرداول',
                ),
            96 =>
                array (
                    'id' => 97,
                    'province_id' => 6,
                    'name' => 'دره شهر',
                ),
            97 =>
                array (
                    'id' => 98,
                    'province_id' => 6,
                    'name' => 'ايوان',
                ),
            98 =>
                array (
                    'id' => 99,
                    'province_id' => 6,
                    'name' => 'سرابله',
                ),
            99 =>
                array (
                    'id' => 100,
                    'province_id' => 7,
                    'name' => 'بوشهر',
                ),
            100 =>
                array (
                    'id' => 101,
                    'province_id' => 7,
                    'name' => 'تنگستان',
                ),
            101 =>
                array (
                    'id' => 102,
                    'province_id' => 7,
                    'name' => 'دشتستان',
                ),
            102 =>
                array (
                    'id' => 103,
                    'province_id' => 7,
                    'name' => 'دير',
                ),
            103 =>
                array (
                    'id' => 104,
                    'province_id' => 7,
                    'name' => 'ديلم',
                ),
            104 =>
                array (
                    'id' => 105,
                    'province_id' => 7,
                    'name' => 'كنگان',
                ),
            105 =>
                array (
                    'id' => 106,
                    'province_id' => 7,
                    'name' => 'گناوه',
                ),
            106 =>
                array (
                    'id' => 107,
                    'province_id' => 7,
                    'name' => 'ريشهر',
                ),
            107 =>
                array (
                    'id' => 108,
                    'province_id' => 7,
                    'name' => 'دشتي',
                ),
            108 =>
                array (
                    'id' => 109,
                    'province_id' => 7,
                    'name' => 'خورموج',
                ),
            109 =>
                array (
                    'id' => 110,
                    'province_id' => 7,
                    'name' => 'اهرم',
                ),
            110 =>
                array (
                    'id' => 111,
                    'province_id' => 7,
                    'name' => 'برازجان',
                ),
            111 =>
                array (
                    'id' => 112,
                    'province_id' => 7,
                    'name' => 'خارك',
                ),
            112 =>
                array (
                    'id' => 113,
                    'province_id' => 7,
                    'name' => 'جم',
                ),
            113 =>
                array (
                    'id' => 114,
                    'province_id' => 7,
                    'name' => 'کاکی',
                ),
            114 =>
                array (
                    'id' => 115,
                    'province_id' => 7,
                    'name' => 'عسلویه',
                ),
            115 =>
                array (
                    'id' => 116,
                    'province_id' => 7,
                    'name' => 'بردخون',
                ),
            116 =>
                array (
                    'id' => 117,
                    'province_id' => 8,
                    'name' => 'تهران',
                ),
            117 =>
                array (
                    'id' => 118,
                    'province_id' => 8,
                    'name' => 'ورامين',
                ),
            118 =>
                array (
                    'id' => 119,
                    'province_id' => 8,
                    'name' => 'فيروزكوه',
                ),
            119 =>
                array (
                    'id' => 120,
                    'province_id' => 8,
                    'name' => 'ري',
                ),
            120 =>
                array (
                    'id' => 121,
                    'province_id' => 8,
                    'name' => 'دماوند',
                ),
            121 =>
                array (
                    'id' => 122,
                    'province_id' => 8,
                    'name' => 'اسلامشهر',
                ),
            122 =>
                array (
                    'id' => 123,
                    'province_id' => 8,
                    'name' => 'رودهن',
                ),
            123 =>
                array (
                    'id' => 124,
                    'province_id' => 8,
                    'name' => 'لواسان',
                ),
            124 =>
                array (
                    'id' => 125,
                    'province_id' => 8,
                    'name' => 'بومهن',
                ),
            125 =>
                array (
                    'id' => 126,
                    'province_id' => 8,
                    'name' => 'تجريش',
                ),
            126 =>
                array (
                    'id' => 127,
                    'province_id' => 8,
                    'name' => 'فشم',
                ),
            127 =>
                array (
                    'id' => 128,
                    'province_id' => 8,
                    'name' => 'كهريزك',
                ),
            128 =>
                array (
                    'id' => 129,
                    'province_id' => 8,
                    'name' => 'پاكدشت',
                ),
            129 =>
                array (
                    'id' => 130,
                    'province_id' => 8,
                    'name' => 'چهاردانگه',
                ),
            130 =>
                array (
                    'id' => 131,
                    'province_id' => 8,
                    'name' => 'شريف آباد',
                ),
            131 =>
                array (
                    'id' => 132,
                    'province_id' => 8,
                    'name' => 'قرچك',
                ),
            132 =>
                array (
                    'id' => 133,
                    'province_id' => 8,
                    'name' => 'باقرشهر',
                ),
            133 =>
                array (
                    'id' => 134,
                    'province_id' => 8,
                    'name' => 'شهريار',
                ),
            134 =>
                array (
                    'id' => 135,
                    'province_id' => 8,
                    'name' => 'رباط كريم',
                ),
            135 =>
                array (
                    'id' => 136,
                    'province_id' => 8,
                    'name' => 'قدس',
                ),
            136 =>
                array (
                    'id' => 137,
                    'province_id' => 8,
                    'name' => 'ملارد',
                ),
            137 =>
                array (
                    'id' => 138,
                    'province_id' => 9,
                    'name' => 'شهركرد',
                ),
            138 =>
                array (
                    'id' => 139,
                    'province_id' => 9,
                    'name' => 'فارسان',
                ),
            139 =>
                array (
                    'id' => 140,
                    'province_id' => 9,
                    'name' => 'بروجن',
                ),
            140 =>
                array (
                    'id' => 141,
                    'province_id' => 9,
                    'name' => 'چلگرد',
                ),
            141 =>
                array (
                    'id' => 142,
                    'province_id' => 9,
                    'name' => 'اردل',
                ),
            142 =>
                array (
                    'id' => 143,
                    'province_id' => 9,
                    'name' => 'لردگان',
                ),
            143 =>
                array (
                    'id' => 144,
                    'province_id' => 9,
                    'name' => 'سامان',
                ),
            144 =>
                array (
                    'id' => 145,
                    'province_id' => 10,
                    'name' => 'قائن',
                ),
            145 =>
                array (
                    'id' => 146,
                    'province_id' => 10,
                    'name' => 'فردوس',
                ),
            146 =>
                array (
                    'id' => 147,
                    'province_id' => 10,
                    'name' => 'بيرجند',
                ),
            147 =>
                array (
                    'id' => 148,
                    'province_id' => 10,
                    'name' => 'نهبندان',
                ),
            148 =>
                array (
                    'id' => 149,
                    'province_id' => 10,
                    'name' => 'سربيشه',
                ),
            149 =>
                array (
                    'id' => 150,
                    'province_id' => 10,
                    'name' => 'طبس مسینا',
                ),
            150 =>
                array (
                    'id' => 151,
                    'province_id' => 10,
                    'name' => 'قهستان',
                ),
            151 =>
                array (
                    'id' => 152,
                    'province_id' => 10,
                    'name' => 'درمیان',
                ),
            152 =>
                array (
                    'id' => 153,
                    'province_id' => 11,
                    'name' => 'مشهد',
                ),
            153 =>
                array (
                    'id' => 154,
                    'province_id' => 11,
                    'name' => 'نيشابور',
                ),
            154 =>
                array (
                    'id' => 155,
                    'province_id' => 11,
                    'name' => 'سبزوار',
                ),
            155 =>
                array (
                    'id' => 156,
                    'province_id' => 11,
                    'name' => 'كاشمر',
                ),
            156 =>
                array (
                    'id' => 157,
                    'province_id' => 11,
                    'name' => 'گناباد',
                ),
            157 =>
                array (
                    'id' => 158,
                    'province_id' => 11,
                    'name' => 'طبس',
                ),
            158 =>
                array (
                    'id' => 159,
                    'province_id' => 11,
                    'name' => 'تربت حيدريه',
                ),
            159 =>
                array (
                    'id' => 160,
                    'province_id' => 11,
                    'name' => 'خواف',
                ),
            160 =>
                array (
                    'id' => 161,
                    'province_id' => 11,
                    'name' => 'تربت جام',
                ),
            161 =>
                array (
                    'id' => 162,
                    'province_id' => 11,
                    'name' => 'تايباد',
                ),
            162 =>
                array (
                    'id' => 163,
                    'province_id' => 11,
                    'name' => 'قوچان',
                ),
            163 =>
                array (
                    'id' => 164,
                    'province_id' => 11,
                    'name' => 'سرخس',
                ),
            164 =>
                array (
                    'id' => 165,
                    'province_id' => 11,
                    'name' => 'بردسكن',
                ),
            165 =>
                array (
                    'id' => 166,
                    'province_id' => 11,
                    'name' => 'فريمان',
                ),
            166 =>
                array (
                    'id' => 167,
                    'province_id' => 11,
                    'name' => 'چناران',
                ),
            167 =>
                array (
                    'id' => 168,
                    'province_id' => 11,
                    'name' => 'درگز',
                ),
            168 =>
                array (
                    'id' => 169,
                    'province_id' => 11,
                    'name' => 'كلات',
                ),
            169 =>
                array (
                    'id' => 170,
                    'province_id' => 11,
                    'name' => 'طرقبه',
                ),
            170 =>
                array (
                    'id' => 171,
                    'province_id' => 11,
                    'name' => 'سر ولایت',
                ),
            171 =>
                array (
                    'id' => 172,
                    'province_id' => 12,
                    'name' => 'بجنورد',
                ),
            172 =>
                array (
                    'id' => 173,
                    'province_id' => 12,
                    'name' => 'اسفراين',
                ),
            173 =>
                array (
                    'id' => 174,
                    'province_id' => 12,
                    'name' => 'جاجرم',
                ),
            174 =>
                array (
                    'id' => 175,
                    'province_id' => 12,
                    'name' => 'شيروان',
                ),
            175 =>
                array (
                    'id' => 176,
                    'province_id' => 12,
                    'name' => 'آشخانه',
                ),
            176 =>
                array (
                    'id' => 177,
                    'province_id' => 12,
                    'name' => 'گرمه',
                ),
            177 =>
                array (
                    'id' => 178,
                    'province_id' => 12,
                    'name' => 'ساروج',
                ),
            178 =>
                array (
                    'id' => 179,
                    'province_id' => 13,
                    'name' => 'اهواز',
                ),
            179 =>
                array (
                    'id' => 180,
                    'province_id' => 13,
                    'name' => 'ايرانشهر',
                ),
            180 =>
                array (
                    'id' => 181,
                    'province_id' => 13,
                    'name' => 'شوش',
                ),
            181 =>
                array (
                    'id' => 182,
                    'province_id' => 13,
                    'name' => 'آبادان',
                ),
            182 =>
                array (
                    'id' => 183,
                    'province_id' => 13,
                    'name' => 'خرمشهر',
                ),
            183 =>
                array (
                    'id' => 184,
                    'province_id' => 13,
                    'name' => 'مسجد سليمان',
                ),
            184 =>
                array (
                    'id' => 185,
                    'province_id' => 13,
                    'name' => 'ايذه',
                ),
            185 =>
                array (
                    'id' => 186,
                    'province_id' => 13,
                    'name' => 'شوشتر',
                ),
            186 =>
                array (
                    'id' => 187,
                    'province_id' => 13,
                    'name' => 'انديمشك',
                ),
            187 =>
                array (
                    'id' => 188,
                    'province_id' => 13,
                    'name' => 'سوسنگرد',
                ),
            188 =>
                array (
                    'id' => 189,
                    'province_id' => 13,
                    'name' => 'هويزه',
                ),
            189 =>
                array (
                    'id' => 190,
                    'province_id' => 13,
                    'name' => 'دزفول',
                ),
            190 =>
                array (
                    'id' => 191,
                    'province_id' => 13,
                    'name' => 'شادگان',
                ),
            191 =>
                array (
                    'id' => 192,
                    'province_id' => 13,
                    'name' => 'بندر ماهشهر',
                ),
            192 =>
                array (
                    'id' => 193,
                    'province_id' => 13,
                    'name' => 'بندر امام خميني',
                ),
            193 =>
                array (
                    'id' => 194,
                    'province_id' => 13,
                    'name' => 'اميديه',
                ),
            194 =>
                array (
                    'id' => 195,
                    'province_id' => 13,
                    'name' => 'بهبهان',
                ),
            195 =>
                array (
                    'id' => 196,
                    'province_id' => 13,
                    'name' => 'رامهرمز',
                ),
            196 =>
                array (
                    'id' => 197,
                    'province_id' => 13,
                    'name' => 'باغ ملك',
                ),
            197 =>
                array (
                    'id' => 198,
                    'province_id' => 13,
                    'name' => 'هنديجان',
                ),
            198 =>
                array (
                    'id' => 199,
                    'province_id' => 13,
                    'name' => 'لالي',
                ),
            199 =>
                array (
                    'id' => 200,
                    'province_id' => 13,
                    'name' => 'رامشیر',
                ),
            200 =>
                array (
                    'id' => 201,
                    'province_id' => 13,
                    'name' => 'حمیدیه',
                ),
            201 =>
                array (
                    'id' => 202,
                    'province_id' => 13,
                    'name' => 'دغاغله',
                ),
            202 =>
                array (
                    'id' => 203,
                    'province_id' => 13,
                    'name' => 'ملاثانی',
                ),
            203 =>
                array (
                    'id' => 204,
                    'province_id' => 13,
                    'name' => 'شادگان',
                ),
            204 =>
                array (
                    'id' => 205,
                    'province_id' => 13,
                    'name' => 'ویسی',
                ),
            205 =>
                array (
                    'id' => 206,
                    'province_id' => 14,
                    'name' => 'زنجان',
                ),
            206 =>
                array (
                    'id' => 207,
                    'province_id' => 14,
                    'name' => 'ابهر',
                ),
            207 =>
                array (
                    'id' => 208,
                    'province_id' => 14,
                    'name' => 'خدابنده',
                ),
            208 =>
                array (
                    'id' => 209,
                    'province_id' => 14,
                    'name' => 'طارم',
                ),
            209 =>
                array (
                    'id' => 210,
                    'province_id' => 14,
                    'name' => 'ماهنشان',
                ),
            210 =>
                array (
                    'id' => 211,
                    'province_id' => 14,
                    'name' => 'خرمدره',
                ),
            211 =>
                array (
                    'id' => 212,
                    'province_id' => 14,
                    'name' => 'ايجرود',
                ),
            212 =>
                array (
                    'id' => 213,
                    'province_id' => 14,
                    'name' => 'زرين آباد',
                ),
            213 =>
                array (
                    'id' => 214,
                    'province_id' => 14,
                    'name' => 'آب بر',
                ),
            214 =>
                array (
                    'id' => 215,
                    'province_id' => 14,
                    'name' => 'قيدار',
                ),
            215 =>
                array (
                    'id' => 216,
                    'province_id' => 15,
                    'name' => 'سمنان',
                ),
            216 =>
                array (
                    'id' => 217,
                    'province_id' => 15,
                    'name' => 'شاهرود',
                ),
            217 =>
                array (
                    'id' => 218,
                    'province_id' => 15,
                    'name' => 'گرمسار',
                ),
            218 =>
                array (
                    'id' => 219,
                    'province_id' => 15,
                    'name' => 'ايوانكي',
                ),
            219 =>
                array (
                    'id' => 220,
                    'province_id' => 15,
                    'name' => 'دامغان',
                ),
            220 =>
                array (
                    'id' => 221,
                    'province_id' => 15,
                    'name' => 'بسطام',
                ),
            221 =>
                array (
                    'id' => 222,
                    'province_id' => 16,
                    'name' => 'زاهدان',
                ),
            222 =>
                array (
                    'id' => 223,
                    'province_id' => 16,
                    'name' => 'چابهار',
                ),
            223 =>
                array (
                    'id' => 224,
                    'province_id' => 16,
                    'name' => 'خاش',
                ),
            224 =>
                array (
                    'id' => 225,
                    'province_id' => 16,
                    'name' => 'سراوان',
                ),
            225 =>
                array (
                    'id' => 226,
                    'province_id' => 16,
                    'name' => 'زابل',
                ),
            226 =>
                array (
                    'id' => 227,
                    'province_id' => 16,
                    'name' => 'سرباز',
                ),
            227 =>
                array (
                    'id' => 228,
                    'province_id' => 16,
                    'name' => 'نيكشهر',
                ),
            228 =>
                array (
                    'id' => 229,
                    'province_id' => 16,
                    'name' => 'ايرانشهر',
                ),
            229 =>
                array (
                    'id' => 230,
                    'province_id' => 16,
                    'name' => 'راسك',
                ),
            230 =>
                array (
                    'id' => 231,
                    'province_id' => 16,
                    'name' => 'ميرجاوه',
                ),
            231 =>
                array (
                    'id' => 232,
                    'province_id' => 17,
                    'name' => 'شيراز',
                ),
            232 =>
                array (
                    'id' => 233,
                    'province_id' => 17,
                    'name' => 'اقليد',
                ),
            233 =>
                array (
                    'id' => 234,
                    'province_id' => 17,
                    'name' => 'داراب',
                ),
            234 =>
                array (
                    'id' => 235,
                    'province_id' => 17,
                    'name' => 'فسا',
                ),
            235 =>
                array (
                    'id' => 236,
                    'province_id' => 17,
                    'name' => 'مرودشت',
                ),
            236 =>
                array (
                    'id' => 237,
                    'province_id' => 17,
                    'name' => 'خرم بيد',
                ),
            237 =>
                array (
                    'id' => 238,
                    'province_id' => 17,
                    'name' => 'آباده',
                ),
            238 =>
                array (
                    'id' => 239,
                    'province_id' => 17,
                    'name' => 'كازرون',
                ),
            239 =>
                array (
                    'id' => 240,
                    'province_id' => 17,
                    'name' => 'ممسني',
                ),
            240 =>
                array (
                    'id' => 241,
                    'province_id' => 17,
                    'name' => 'سپيدان',
                ),
            241 =>
                array (
                    'id' => 242,
                    'province_id' => 17,
                    'name' => 'لار',
                ),
            242 =>
                array (
                    'id' => 243,
                    'province_id' => 17,
                    'name' => 'فيروز آباد',
                ),
            243 =>
                array (
                    'id' => 244,
                    'province_id' => 17,
                    'name' => 'جهرم',
                ),
            244 =>
                array (
                    'id' => 245,
                    'province_id' => 17,
                    'name' => 'ني ريز',
                ),
            245 =>
                array (
                    'id' => 246,
                    'province_id' => 17,
                    'name' => 'استهبان',
                ),
            246 =>
                array (
                    'id' => 247,
                    'province_id' => 17,
                    'name' => 'لامرد',
                ),
            247 =>
                array (
                    'id' => 248,
                    'province_id' => 17,
                    'name' => 'مهر',
                ),
            248 =>
                array (
                    'id' => 249,
                    'province_id' => 17,
                    'name' => 'حاجي آباد',
                ),
            249 =>
                array (
                    'id' => 250,
                    'province_id' => 17,
                    'name' => 'نورآباد',
                ),
            250 =>
                array (
                    'id' => 251,
                    'province_id' => 17,
                    'name' => 'اردكان',
                ),
            251 =>
                array (
                    'id' => 252,
                    'province_id' => 17,
                    'name' => 'صفاشهر',
                ),
            252 =>
                array (
                    'id' => 253,
                    'province_id' => 17,
                    'name' => 'ارسنجان',
                ),
            253 =>
                array (
                    'id' => 254,
                    'province_id' => 17,
                    'name' => 'قيروكارزين',
                ),
            254 =>
                array (
                    'id' => 255,
                    'province_id' => 17,
                    'name' => 'سوريان',
                ),
            255 =>
                array (
                    'id' => 256,
                    'province_id' => 17,
                    'name' => 'فراشبند',
                ),
            256 =>
                array (
                    'id' => 257,
                    'province_id' => 17,
                    'name' => 'سروستان',
                ),
            257 =>
                array (
                    'id' => 258,
                    'province_id' => 17,
                    'name' => 'ارژن',
                ),
            258 =>
                array (
                    'id' => 259,
                    'province_id' => 17,
                    'name' => 'گويم',
                ),
            259 =>
                array (
                    'id' => 260,
                    'province_id' => 17,
                    'name' => 'داريون',
                ),
            260 =>
                array (
                    'id' => 261,
                    'province_id' => 17,
                    'name' => 'زرقان',
                ),
            261 =>
                array (
                    'id' => 262,
                    'province_id' => 17,
                    'name' => 'خان زنیان',
                ),
            262 =>
                array (
                    'id' => 263,
                    'province_id' => 17,
                    'name' => 'کوار',
                ),
            263 =>
                array (
                    'id' => 264,
                    'province_id' => 17,
                    'name' => 'ده بید',
                ),
            264 =>
                array (
                    'id' => 265,
                    'province_id' => 17,
                    'name' => 'باب انار/خفر',
                ),
            265 =>
                array (
                    'id' => 266,
                    'province_id' => 17,
                    'name' => 'بوانات',
                ),
            266 =>
                array (
                    'id' => 267,
                    'province_id' => 17,
                    'name' => 'خرامه',
                ),
            267 =>
                array (
                    'id' => 268,
                    'province_id' => 17,
                    'name' => 'خنج',
                ),
            268 =>
                array (
                    'id' => 269,
                    'province_id' => 17,
                    'name' => 'سیاخ دارنگون',
                ),
            269 =>
                array (
                    'id' => 270,
                    'province_id' => 18,
                    'name' => 'قزوين',
                ),
            270 =>
                array (
                    'id' => 271,
                    'province_id' => 18,
                    'name' => 'تاكستان',
                ),
            271 =>
                array (
                    'id' => 272,
                    'province_id' => 18,
                    'name' => 'آبيك',
                ),
            272 =>
                array (
                    'id' => 273,
                    'province_id' => 18,
                    'name' => 'بوئين زهرا',
                ),
            273 =>
                array (
                    'id' => 274,
                    'province_id' => 19,
                    'name' => 'قم',
                ),
            274 =>
                array (
                    'id' => 275,
                    'province_id' => 5,
                    'name' => 'طالقان',
                ),
            275 =>
                array (
                    'id' => 276,
                    'province_id' => 5,
                    'name' => 'نظرآباد',
                ),
            276 =>
                array (
                    'id' => 277,
                    'province_id' => 5,
                    'name' => 'اشتهارد',
                ),
            277 =>
                array (
                    'id' => 278,
                    'province_id' => 5,
                    'name' => 'هشتگرد',
                ),
            278 =>
                array (
                    'id' => 279,
                    'province_id' => 5,
                    'name' => 'كن',
                ),
            279 =>
                array (
                    'id' => 280,
                    'province_id' => 5,
                    'name' => 'آسارا',
                ),
            280 =>
                array (
                    'id' => 281,
                    'province_id' => 5,
                    'name' => 'شهرک گلستان',
                ),
            281 =>
                array (
                    'id' => 282,
                    'province_id' => 5,
                    'name' => 'اندیشه',
                ),
            282 =>
                array (
                    'id' => 283,
                    'province_id' => 5,
                    'name' => 'كرج',
                ),
            283 =>
                array (
                    'id' => 284,
                    'province_id' => 5,
                    'name' => 'نظر آباد',
                ),
            284 =>
                array (
                    'id' => 285,
                    'province_id' => 5,
                    'name' => 'گوهردشت',
                ),
            285 =>
                array (
                    'id' => 286,
                    'province_id' => 5,
                    'name' => 'ماهدشت',
                ),
            286 =>
                array (
                    'id' => 287,
                    'province_id' => 5,
                    'name' => 'مشکین دشت',
                ),
            287 =>
                array (
                    'id' => 288,
                    'province_id' => 20,
                    'name' => 'سنندج',
                ),
            288 =>
                array (
                    'id' => 289,
                    'province_id' => 20,
                    'name' => 'ديواندره',
                ),
            289 =>
                array (
                    'id' => 290,
                    'province_id' => 20,
                    'name' => 'بانه',
                ),
            290 =>
                array (
                    'id' => 291,
                    'province_id' => 20,
                    'name' => 'بيجار',
                ),
            291 =>
                array (
                    'id' => 292,
                    'province_id' => 20,
                    'name' => 'سقز',
                ),
            292 =>
                array (
                    'id' => 293,
                    'province_id' => 20,
                    'name' => 'كامياران',
                ),
            293 =>
                array (
                    'id' => 294,
                    'province_id' => 20,
                    'name' => 'قروه',
                ),
            294 =>
                array (
                    'id' => 295,
                    'province_id' => 20,
                    'name' => 'مريوان',
                ),
            295 =>
                array (
                    'id' => 296,
                    'province_id' => 20,
                    'name' => 'صلوات آباد',
                ),
            296 =>
                array (
                    'id' => 297,
                    'province_id' => 20,
                    'name' => 'حسن آباد',
                ),
            297 =>
                array (
                    'id' => 298,
                    'province_id' => 21,
                    'name' => 'كرمان',
                ),
            298 =>
                array (
                    'id' => 299,
                    'province_id' => 21,
                    'name' => 'راور',
                ),
            299 =>
                array (
                    'id' => 300,
                    'province_id' => 21,
                    'name' => 'بابك',
                ),
            300 =>
                array (
                    'id' => 301,
                    'province_id' => 21,
                    'name' => 'انار',
                ),
            301 =>
                array (
                    'id' => 302,
                    'province_id' => 21,
                    'name' => 'کوهبنان',
                ),
            302 =>
                array (
                    'id' => 303,
                    'province_id' => 21,
                    'name' => 'رفسنجان',
                ),
            303 =>
                array (
                    'id' => 304,
                    'province_id' => 21,
                    'name' => 'بافت',
                ),
            304 =>
                array (
                    'id' => 305,
                    'province_id' => 21,
                    'name' => 'سيرجان',
                ),
            305 =>
                array (
                    'id' => 306,
                    'province_id' => 21,
                    'name' => 'كهنوج',
                ),
            306 =>
                array (
                    'id' => 307,
                    'province_id' => 21,
                    'name' => 'زرند',
                ),
            307 =>
                array (
                    'id' => 308,
                    'province_id' => 21,
                    'name' => 'بم',
                ),
            308 =>
                array (
                    'id' => 309,
                    'province_id' => 21,
                    'name' => 'جيرفت',
                ),
            309 =>
                array (
                    'id' => 310,
                    'province_id' => 21,
                    'name' => 'بردسير',
                ),
            310 =>
                array (
                    'id' => 311,
                    'province_id' => 22,
                    'name' => 'كرمانشاه',
                ),
            311 =>
                array (
                    'id' => 312,
                    'province_id' => 22,
                    'name' => 'اسلام آباد غرب',
                ),
            312 =>
                array (
                    'id' => 313,
                    'province_id' => 22,
                    'name' => 'سر پل ذهاب',
                ),
            313 =>
                array (
                    'id' => 314,
                    'province_id' => 22,
                    'name' => 'كنگاور',
                ),
            314 =>
                array (
                    'id' => 315,
                    'province_id' => 22,
                    'name' => 'سنقر',
                ),
            315 =>
                array (
                    'id' => 316,
                    'province_id' => 22,
                    'name' => 'قصر شيرين',
                ),
            316 =>
                array (
                    'id' => 317,
                    'province_id' => 22,
                    'name' => 'گيلان غرب',
                ),
            317 =>
                array (
                    'id' => 318,
                    'province_id' => 22,
                    'name' => 'هرسين',
                ),
            318 =>
                array (
                    'id' => 319,
                    'province_id' => 22,
                    'name' => 'صحنه',
                ),
            319 =>
                array (
                    'id' => 320,
                    'province_id' => 22,
                    'name' => 'پاوه',
                ),
            320 =>
                array (
                    'id' => 321,
                    'province_id' => 22,
                    'name' => 'جوانرود',
                ),
            321 =>
                array (
                    'id' => 322,
                    'province_id' => 22,
                    'name' => 'شاهو',
                ),
            322 =>
                array (
                    'id' => 323,
                    'province_id' => 23,
                    'name' => 'ياسوج',
                ),
            323 =>
                array (
                    'id' => 324,
                    'province_id' => 23,
                    'name' => 'گچساران',
                ),
            324 =>
                array (
                    'id' => 325,
                    'province_id' => 23,
                    'name' => 'دنا',
                ),
            325 =>
                array (
                    'id' => 326,
                    'province_id' => 23,
                    'name' => 'دوگنبدان',
                ),
            326 =>
                array (
                    'id' => 327,
                    'province_id' => 23,
                    'name' => 'سي سخت',
                ),
            327 =>
                array (
                    'id' => 328,
                    'province_id' => 23,
                    'name' => 'دهدشت',
                ),
            328 =>
                array (
                    'id' => 329,
                    'province_id' => 23,
                    'name' => 'ليكك',
                ),
            329 =>
                array (
                    'id' => 330,
                    'province_id' => 24,
                    'name' => 'گرگان',
                ),
            330 =>
                array (
                    'id' => 331,
                    'province_id' => 24,
                    'name' => 'آق قلا',
                ),
            331 =>
                array (
                    'id' => 332,
                    'province_id' => 24,
                    'name' => 'گنبد كاووس',
                ),
            332 =>
                array (
                    'id' => 333,
                    'province_id' => 24,
                    'name' => 'علي آباد كتول',
                ),
            333 =>
                array (
                    'id' => 334,
                    'province_id' => 24,
                    'name' => 'مينو دشت',
                ),
            334 =>
                array (
                    'id' => 335,
                    'province_id' => 24,
                    'name' => 'تركمن',
                ),
            335 =>
                array (
                    'id' => 336,
                    'province_id' => 24,
                    'name' => 'كردكوي',
                ),
            336 =>
                array (
                    'id' => 337,
                    'province_id' => 24,
                    'name' => 'بندر گز',
                ),
            337 =>
                array (
                    'id' => 338,
                    'province_id' => 24,
                    'name' => 'كلاله',
                ),
            338 =>
                array (
                    'id' => 339,
                    'province_id' => 24,
                    'name' => 'آزاد شهر',
                ),
            339 =>
                array (
                    'id' => 340,
                    'province_id' => 24,
                    'name' => 'راميان',
                ),
            340 =>
                array (
                    'id' => 341,
                    'province_id' => 25,
                    'name' => 'رشت',
                ),
            341 =>
                array (
                    'id' => 342,
                    'province_id' => 25,
                    'name' => 'منجيل',
                ),
            342 =>
                array (
                    'id' => 343,
                    'province_id' => 25,
                    'name' => 'لنگرود',
                ),
            343 =>
                array (
                    'id' => 344,
                    'province_id' => 25,
                    'name' => 'رود سر',
                ),
            344 =>
                array (
                    'id' => 345,
                    'province_id' => 25,
                    'name' => 'تالش',
                ),
            345 =>
                array (
                    'id' => 346,
                    'province_id' => 25,
                    'name' => 'آستارا',
                ),
            346 =>
                array (
                    'id' => 347,
                    'province_id' => 25,
                    'name' => 'ماسوله',
                ),
            347 =>
                array (
                    'id' => 348,
                    'province_id' => 25,
                    'name' => 'آستانه اشرفيه',
                ),
            348 =>
                array (
                    'id' => 349,
                    'province_id' => 25,
                    'name' => 'رودبار',
                ),
            349 =>
                array (
                    'id' => 350,
                    'province_id' => 25,
                    'name' => 'فومن',
                ),
            350 =>
                array (
                    'id' => 351,
                    'province_id' => 25,
                    'name' => 'صومعه سرا',
                ),
            351 =>
                array (
                    'id' => 352,
                    'province_id' => 25,
                    'name' => 'بندرانزلي',
                ),
            352 =>
                array (
                    'id' => 353,
                    'province_id' => 25,
                    'name' => 'كلاچاي',
                ),
            353 =>
                array (
                    'id' => 354,
                    'province_id' => 25,
                    'name' => 'هشتپر',
                ),
            354 =>
                array (
                    'id' => 355,
                    'province_id' => 25,
                    'name' => 'رضوان شهر',
                ),
            355 =>
                array (
                    'id' => 356,
                    'province_id' => 25,
                    'name' => 'ماسال',
                ),
            356 =>
                array (
                    'id' => 357,
                    'province_id' => 25,
                    'name' => 'شفت',
                ),
            357 =>
                array (
                    'id' => 358,
                    'province_id' => 25,
                    'name' => 'سياهكل',
                ),
            358 =>
                array (
                    'id' => 359,
                    'province_id' => 25,
                    'name' => 'املش',
                ),
            359 =>
                array (
                    'id' => 360,
                    'province_id' => 25,
                    'name' => 'لاهیجان',
                ),
            360 =>
                array (
                    'id' => 361,
                    'province_id' => 25,
                    'name' => 'خشک بيجار',
                ),
            361 =>
                array (
                    'id' => 362,
                    'province_id' => 25,
                    'name' => 'خمام',
                ),
            362 =>
                array (
                    'id' => 363,
                    'province_id' => 25,
                    'name' => 'لشت نشا',
                ),
            363 =>
                array (
                    'id' => 364,
                    'province_id' => 25,
                    'name' => 'بندر کياشهر',
                ),
            364 =>
                array (
                    'id' => 365,
                    'province_id' => 26,
                    'name' => 'خرم آباد',
                ),
            365 =>
                array (
                    'id' => 366,
                    'province_id' => 26,
                    'name' => 'ماهشهر',
                ),
            366 =>
                array (
                    'id' => 367,
                    'province_id' => 26,
                    'name' => 'دزفول',
                ),
            367 =>
                array (
                    'id' => 368,
                    'province_id' => 26,
                    'name' => 'بروجرد',
                ),
            368 =>
                array (
                    'id' => 369,
                    'province_id' => 26,
                    'name' => 'دورود',
                ),
            369 =>
                array (
                    'id' => 370,
                    'province_id' => 26,
                    'name' => 'اليگودرز',
                ),
            370 =>
                array (
                    'id' => 371,
                    'province_id' => 26,
                    'name' => 'ازنا',
                ),
            371 =>
                array (
                    'id' => 372,
                    'province_id' => 26,
                    'name' => 'نور آباد',
                ),
            372 =>
                array (
                    'id' => 373,
                    'province_id' => 26,
                    'name' => 'كوهدشت',
                ),
            373 =>
                array (
                    'id' => 374,
                    'province_id' => 26,
                    'name' => 'الشتر',
                ),
            374 =>
                array (
                    'id' => 375,
                    'province_id' => 26,
                    'name' => 'پلدختر',
                ),
            375 =>
                array (
                    'id' => 376,
                    'province_id' => 27,
                    'name' => 'ساري',
                ),
            376 =>
                array (
                    'id' => 377,
                    'province_id' => 27,
                    'name' => 'آمل',
                ),
            377 =>
                array (
                    'id' => 378,
                    'province_id' => 27,
                    'name' => 'بابل',
                ),
            378 =>
                array (
                    'id' => 379,
                    'province_id' => 27,
                    'name' => 'بابلسر',
                ),
            379 =>
                array (
                    'id' => 380,
                    'province_id' => 27,
                    'name' => 'بهشهر',
                ),
            380 =>
                array (
                    'id' => 381,
                    'province_id' => 27,
                    'name' => 'تنكابن',
                ),
            381 =>
                array (
                    'id' => 382,
                    'province_id' => 27,
                    'name' => 'جويبار',
                ),
            382 =>
                array (
                    'id' => 383,
                    'province_id' => 27,
                    'name' => 'چالوس',
                ),
            383 =>
                array (
                    'id' => 384,
                    'province_id' => 27,
                    'name' => 'رامسر',
                ),
            384 =>
                array (
                    'id' => 385,
                    'province_id' => 27,
                    'name' => 'سواد كوه',
                ),
            385 =>
                array (
                    'id' => 386,
                    'province_id' => 27,
                    'name' => 'قائم شهر',
                ),
            386 =>
                array (
                    'id' => 387,
                    'province_id' => 27,
                    'name' => 'نكا',
                ),
            387 =>
                array (
                    'id' => 388,
                    'province_id' => 27,
                    'name' => 'نور',
                ),
            388 =>
                array (
                    'id' => 389,
                    'province_id' => 27,
                    'name' => 'بلده',
                ),
            389 =>
                array (
                    'id' => 390,
                    'province_id' => 27,
                    'name' => 'نوشهر',
                ),
            390 =>
                array (
                    'id' => 391,
                    'province_id' => 27,
                    'name' => 'پل سفيد',
                ),
            391 =>
                array (
                    'id' => 392,
                    'province_id' => 27,
                    'name' => 'محمود آباد',
                ),
            392 =>
                array (
                    'id' => 393,
                    'province_id' => 27,
                    'name' => 'فريدون كنار',
                ),
            393 =>
                array (
                    'id' => 394,
                    'province_id' => 28,
                    'name' => 'اراك',
                ),
            394 =>
                array (
                    'id' => 395,
                    'province_id' => 28,
                    'name' => 'آشتيان',
                ),
            395 =>
                array (
                    'id' => 396,
                    'province_id' => 28,
                    'name' => 'تفرش',
                ),
            396 =>
                array (
                    'id' => 397,
                    'province_id' => 28,
                    'name' => 'خمين',
                ),
            397 =>
                array (
                    'id' => 398,
                    'province_id' => 28,
                    'name' => 'دليجان',
                ),
            398 =>
                array (
                    'id' => 399,
                    'province_id' => 28,
                    'name' => 'ساوه',
                ),
            399 =>
                array (
                    'id' => 400,
                    'province_id' => 28,
                    'name' => 'سربند',
                ),
            400 =>
                array (
                    'id' => 401,
                    'province_id' => 28,
                    'name' => 'محلات',
                ),
            401 =>
                array (
                    'id' => 402,
                    'province_id' => 28,
                    'name' => 'شازند',
                ),
            402 =>
                array (
                    'id' => 403,
                    'province_id' => 29,
                    'name' => 'بندرعباس',
                ),
            403 =>
                array (
                    'id' => 404,
                    'province_id' => 29,
                    'name' => 'قشم',
                ),
            404 =>
                array (
                    'id' => 405,
                    'province_id' => 29,
                    'name' => 'كيش',
                ),
            405 =>
                array (
                    'id' => 406,
                    'province_id' => 29,
                    'name' => 'بندر لنگه',
                ),
            406 =>
                array (
                    'id' => 407,
                    'province_id' => 29,
                    'name' => 'بستك',
                ),
            407 =>
                array (
                    'id' => 408,
                    'province_id' => 29,
                    'name' => 'حاجي آباد',
                ),
            408 =>
                array (
                    'id' => 409,
                    'province_id' => 29,
                    'name' => 'دهبارز',
                ),
            409 =>
                array (
                    'id' => 410,
                    'province_id' => 29,
                    'name' => 'انگهران',
                ),
            410 =>
                array (
                    'id' => 411,
                    'province_id' => 29,
                    'name' => 'ميناب',
                ),
            411 =>
                array (
                    'id' => 412,
                    'province_id' => 29,
                    'name' => 'ابوموسي',
                ),
            412 =>
                array (
                    'id' => 413,
                    'province_id' => 29,
                    'name' => 'بندر جاسك',
                ),
            413 =>
                array (
                    'id' => 414,
                    'province_id' => 29,
                    'name' => 'تنب بزرگ',
                ),
            414 =>
                array (
                    'id' => 415,
                    'province_id' => 29,
                    'name' => 'بندر خمیر',
                ),
            415 =>
                array (
                    'id' => 416,
                    'province_id' => 29,
                    'name' => 'پارسیان',
                ),
            416 =>
                array (
                    'id' => 417,
                    'province_id' => 29,
                    'name' => 'قشم',
                ),
            417 =>
                array (
                    'id' => 418,
                    'province_id' => 30,
                    'name' => 'همدان',
                ),
            418 =>
                array (
                    'id' => 419,
                    'province_id' => 30,
                    'name' => 'ملاير',
                ),
            419 =>
                array (
                    'id' => 420,
                    'province_id' => 30,
                    'name' => 'تويسركان',
                ),
            420 =>
                array (
                    'id' => 421,
                    'province_id' => 30,
                    'name' => 'نهاوند',
                ),
            421 =>
                array (
                    'id' => 422,
                    'province_id' => 30,
                    'name' => 'كبودر اهنگ',
                ),
            422 =>
                array (
                    'id' => 423,
                    'province_id' => 30,
                    'name' => 'رزن',
                ),
            423 =>
                array (
                    'id' => 424,
                    'province_id' => 30,
                    'name' => 'اسدآباد',
                ),
            424 =>
                array (
                    'id' => 425,
                    'province_id' => 30,
                    'name' => 'بهار',
                ),
            425 =>
                array (
                    'id' => 426,
                    'province_id' => 31,
                    'name' => 'يزد',
                ),
            426 =>
                array (
                    'id' => 427,
                    'province_id' => 31,
                    'name' => 'تفت',
                ),
            427 =>
                array (
                    'id' => 428,
                    'province_id' => 31,
                    'name' => 'اردكان',
                ),
            428 =>
                array (
                    'id' => 429,
                    'province_id' => 31,
                    'name' => 'ابركوه',
                ),
            429 =>
                array (
                    'id' => 430,
                    'province_id' => 31,
                    'name' => 'ميبد',
                ),
            430 =>
                array (
                    'id' => 431,
                    'province_id' => 31,
                    'name' => 'طبس',
                ),
            431 =>
                array (
                    'id' => 432,
                    'province_id' => 31,
                    'name' => 'بافق',
                ),
            432 =>
                array (
                    'id' => 433,
                    'province_id' => 31,
                    'name' => 'مهريز',
                ),
            433 =>
                array (
                    'id' => 434,
                    'province_id' => 31,
                    'name' => 'اشكذر',
                ),
            434 =>
                array (
                    'id' => 435,
                    'province_id' => 31,
                    'name' => 'هرات',
                ),
            435 =>
                array (
                    'id' => 436,
                    'province_id' => 31,
                    'name' => 'خضرآباد',
                ),
            436 =>
                array (
                    'id' => 437,
                    'province_id' => 31,
                    'name' => 'شاهديه',
                ),
            437 =>
                array (
                    'id' => 438,
                    'province_id' => 31,
                    'name' => 'حمیدیه شهر',
                ),
            438 =>
                array (
                    'id' => 439,
                    'province_id' => 31,
                    'name' => 'سید میرزا',
                ),
            439 =>
                array (
                    'id' => 440,
                    'province_id' => 31,
                    'name' => 'زارچ',
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
        \Illuminate\Support\Facades\DB::table('cities')->delete();
        Schema::dropIfExists('cities');
    }
}
