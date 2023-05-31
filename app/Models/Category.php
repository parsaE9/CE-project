<?php

namespace App\Models;

use App\Helpers\HasAdvancedFilter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory , HasAdvancedFilter;

    protected  $filterable = [
        'id',
        'name'
    ];

    protected  $orderable = [
        'id',
        'name'
    ];

    protected $fillable =[
        'name'
    ];
}
