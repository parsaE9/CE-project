<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventLogMeta extends Model
{
    use HasFactory;

    protected $fillable = [
        'event_log_id',
        'title',
        'actor_id',
        'actor_type',
        'extra',
    ];

    public function actor(){
        return $this->morphTo('actor');
    }
}
