<?php

namespace App\Models;

use App\Helpers\HasAdvancedFilter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Recruitment extends Model
{
    use HasFactory, SoftDeletes, HasAdvancedFilter;

    const STATUS_CLOSE = 'closed';
    const STATUS_DRAFT = 'draft';
    const STATUS_PENDING = 'pending';
    const STATUS_PUBLISH = 'publish';
    const STATUS_DISABLE = 'disable';

    protected $fillable = [
        'user_id',
        'title',
        'description',
        'position',
        'skills',
        'picture',
        'salary',
        'status',
        'categories',
        'province',
        'contract',
        'experience'
    ];
//These columns will be searched through advancedFilter trait
    protected $filterable = [
        'title',
        'skills',
        'categories',
        'experience'
    ];
//These columns will be ordered through advancedFilter trait
    protected $orderable = [
        'id',
        'created_at',
        'updated_at',
    ];

    protected $casts = [
        'skills' => 'array',
        'categories' => 'array',
        'province' => 'array'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function requests()
    {
        return $this->belongsToMany(Resume::class, 'resume_recruitment', 'recruitment_id', 'resume_id')->withPivot('status');
    }
}
