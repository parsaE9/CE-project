<?php

namespace App\Helpers;

use Google_Service_Calendar;

class GoogleClient
{
    public static function CalendarClient(){
        $client = new \Google_Client();

        $client->setApplicationName('کاریابی پروژه');
        $client->setAuthConfig(storage_path('google_app.json'));
        $client->setAccessType("offline");
        $client->setIncludeGrantedScopes(true);
        $client->setApprovalPrompt('force');
        $client->addScope(Google_Service_Calendar::CALENDAR);
        $client->setRedirectUri(route('google_calendar.save'));

        return $client;
    }
}