<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property string $name
 */
class Province extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'name'
    ];
}
