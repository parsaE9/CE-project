<?php

namespace App\Models;

use App\Helpers\HasAdvancedFilter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    use HasFactory, HasAdvancedFilter;

    protected $fillable = [
        'name',
        'description'
    ];

    protected $filterable = [
        'id',
        'name',
        'description'
    ];

    protected $orderable = [
        'id',
        'name',
        'description'
    ];
}
