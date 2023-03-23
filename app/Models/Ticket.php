<?php

namespace App\Models;

use App\Helpers\HasAdvancedFilter;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Notifications\Notifiable;

class Ticket extends Model
{
    use Notifiable,HasAdvancedFilter;



    const
        ID = 'id',
        USER_ID = "user_id",
        DEPARTMENT_ID = "department_id",
        IMPORTANCE = "importance",
        FEEDBACK = "feedback",
        STATUS = "status",
        TITLE = "title";


    protected $fillable = [
        self::USER_ID,
        self::DEPARTMENT_ID,
        self::IMPORTANCE,
        self::STATUS,
        self::TITLE,
        self::FEEDBACK,
    ];

    protected $filterable = [
        self::TITLE,
    ];

    protected $orderable = [
        self::DEPARTMENT_ID,
        self::ID,
    ];

    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class);
    }

    public function comments(): HasMany
    {
        return $this->hasMany(TicketMessage::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function addMessage($description, $attach)
    {
        $this->comments()->create([
            "user_id" => \Auth::id(),
            "description" => $description,
            "attach" => $attach
        ]);
    }
    public function addMessageAdmin($description, $attach)
    {
        $this->comments()->create([
            "user_id" => \Auth::id(),
            "description" => $description,
            "supporter_flag" => 'admin',
            "attach" => $attach
        ]);
    }
}
