<?php

namespace App\Models;

use App\Helpers\HasAdvancedFilter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'title' ,
        'type' ,
        'description' ,
    ];

    protected $with = [
        'meta'
    ];

    public function meta(){
        return $this->hasMany(EventLogMeta::class , 'event_log_id' , 'id')->with('actor');
    }
}
