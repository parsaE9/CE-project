<?php

namespace App\Models;

use App\Helpers\HasAdvancedFilter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Resume extends Model
{
    use HasFactory , SoftDeletes , HasAdvancedFilter;

    const STATUS_DRAFT = "draft";
    const STATUS_PUBLISH = "publish";
    const STATUS_DISABLE = "disable";
    const STATUS_REDIRECT = "redirect";



    protected $fillable =[
        'id' ,
        'user_id' ,
        'name',
        'status',
        'data',
        'extras'
    ];

    protected $filterable =[
        'id' ,
        'user_id' ,
        'name',
        'status',
        'data',
        'extras'
    ];

    protected $orderable = [
        'id',
        'created_at',
        'updated_at',
    ];

    protected $casts = [
        'extras' => 'array',
        'data' => 'array'
    ];


    public function requests()
    {
        return $this->belongsToMany(Recruitment::class , 'resume_recruitment' , 'resume_id' , 'recruitment_id')->withPivot('status');
    }

    public function user()
    {
        return $this->hasOne(User::class , 'id' , 'user_id');
    }
}
