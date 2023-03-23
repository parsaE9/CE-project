<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Casts\HashCast;
use App\Helpers\HasAdvancedFilter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Laratrust\Traits\LaratrustUserTrait;

class User extends Authenticatable
{
    use LaratrustUserTrait;
    use HasApiTokens, HasFactory, Notifiable, HasAdvancedFilter,SoftDeletes;

    const STATUS_DRAFT = "draft";
    const STATUS_PENDING = "pending";
    const STATUS_ACTIVE = "active";
    const STATUS_DISABLE = "disable";

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'type',
        'data_type',
        'status',
        'type_data'
    ];

    //These columns will be searched through advancedFilter trait
    protected $filterable = [
        'id',
        'name',
        'email',
        'type',
    ];
//These columns will be ordered through advancedFilter trait
    protected $orderable = [
        'id',
        'created_at',
        'updated_at',
    ];


    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => HashCast::class,
        'type_data' => 'array',
        'data_type' => 'array',
    ];


    public function page()
    {
        return $this->belongsTo(Page::class, 'user_id', 'id');
    }

    public function resumes()
    {
        return $this->hasMany(Resume::class);
    }

    public function requests(){
       return $this->belongsToMany(Recruitment::class , 'resume_recruitment' , 'user_id' , 'recruitment_id')->withPivot(['status as request_status' , 'resume_id' , 'created_at as requested_at']);
    }

    public function tokens()
    {
        return $this->hasMany(GoogleCalendarToken::class , 'user_id' , 'id');
    }
}
