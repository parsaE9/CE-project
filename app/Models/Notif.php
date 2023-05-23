<?php

namespace App\Models;

use App\Helpers\HasAdvancedFilter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notif extends Model
{
    use HasFactory , HasAdvancedFilter;

    protected  $filterable = [
        'id',
        'title'
    ];

    protected  $orderable = [
        'id',
    ];

    protected $fillable =[
        'user_id',
        'title',
        'text',
    ];
}
