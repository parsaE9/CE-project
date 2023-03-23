<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


/**
 * @property integer $id
 * @property integer $province_id
 * @property string $name
 */
class City extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'province_id',
        'name'
    ];
}
