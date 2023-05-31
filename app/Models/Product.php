<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    const STATUS_PUBLISH = "publish";
    const STATUS_DISABLE = "disable";
    const STATUS_DRAFT = "draft";


    protected $fillable = [
        'user_id',
        'name',
        'data',
        'status'
    ];

    protected $casts=[
      'data' => 'array'
    ];
}
