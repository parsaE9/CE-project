<?php

namespace App\Models;

use App\Helpers\HasAdvancedFilter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Department extends Model
{
    use SoftDeletes,HasAdvancedFilter;

    const  TITLE = "title",USER_ID="user_id";

    protected $fillable = [
        self::TITLE,
        self::USER_ID
    ];
    protected $filterable = [
        self::TITLE,
    ];

    protected $orderable = [
        'id',
        'created_at',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
