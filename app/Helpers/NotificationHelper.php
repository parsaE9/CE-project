<?php

namespace App\Helpers;

use App\Mail\ResumeMail;
use App\Models\EventLog;
use App\Models\Notif;
use Illuminate\Support\Facades\Mail;

class NotificationHelper
{
    public static function createNotification($userId, $title = null, $body = null){
        return  Notif::create([
            'user_id' => $userId,
            'title' => $title,
            'text' => $body,

        ]);
    }

    public static function createNotificationWithEmail($email,$userId, $title = null, $body = null){
        try {
            Mail::to($email)->send(new ResumeMail($title,$body));
        }catch (\Exception $e){}
        return  Notif::create([
            'user_id' => $userId,
            'title' => $title,
            'text' => $body,

        ]);
    }
}