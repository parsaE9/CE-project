<?php

namespace App\Models;

use App\Helpers\GoogleClient;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class GoogleCalendarToken extends Model
{
    use HasFactory , SoftDeletes;

    const TYPE_CALENDAR = "calendar";

    protected $table = "google_calandar_tokens";

    protected $fillable = [
        'user_id',
        'type',
        'access_token',
        'expire_at',
        'refresh_token',
        'scope',
        'token_type',
        'calendar_id'
    ];


    protected $casts =[
      'expire_at' => 'datetime'
    ];

    public function fillWithArray($array)
    {
        $this->access_token = $array['access_token'];
        $this->refresh_token = $array['refresh_token'];
        $this->scope = $array['scope'];
        $this->token_type = $array['token_type'];
        $this->expire_at = (new Carbon($array['created']))->addSeconds($array['expires_in']);
    }

    public function isExpireToken(){
        return $this->expire_at->subMinute()->isPast();
    }

    public function token(){
        if ($this->isExpireToken()){
            $client = GoogleClient::CalendarClient();
            $token = $client->fetchAccessTokenWithRefreshToken($this->refresh_token);
            if ($token && !isset($token['error'])){
                $this->fillWithArray($token);
                $this->save();
            }else{
                return null;
            }
        }
        return $this->access_token;
    }
}
