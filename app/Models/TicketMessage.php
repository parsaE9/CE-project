<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TicketMessage extends Model
{
    use HasFactory;
    const USER_ID = "user_id",
        TICKET_ID = "ticket_id",
        SUPPORTER_FLAG = "supporter_flag",
        DESCRIPTION = "description",
        ATTACH = "attach";

    protected $fillable = [
        self::USER_ID,
        self::TICKET_ID,
        self::SUPPORTER_FLAG,
        self::DESCRIPTION,
        self::ATTACH
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
