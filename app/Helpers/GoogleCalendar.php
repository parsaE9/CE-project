<?php

namespace App\Helpers;

use App\Models\GoogleCalendarToken;
use Google_Service_Calendar_Calendar;
use Google_Service_Calendar_CalendarListEntry;
use Google_Service_Calendar_Event;
use Illuminate\Support\Facades\Auth;

class GoogleCalendar
{
    public const DEFAULT_CALENDAR = 'karyab_calendar';

    public static function client()
    {
        $client = GoogleClient::CalendarClient();
        $client->setAccessToken(Auth::user()->tokens()->where('type' , GoogleCalendarToken::TYPE_CALENDAR)->firstOrFail()->token());
        return $client;
    }

    public static function getEvents($calendar_id)
    {
        $service = new \Google_Service_Calendar(self::client());
        $events = $service->events->listEvents($calendar_id);

        $ret = [];
        while(true) {
            foreach ($events->getItems() as $event) {
                $ret[] =  $event;
            }
            $pageToken = $events->getNextPageToken();
            if ($pageToken) {
                $optParams = array('pageToken' => $pageToken);
                $events = $service->events->listEvents($calendar_id, $optParams);
            } else {
                break;
            }
        }

        return $ret;
    }

    /**
     * @param \Google_Service_Calendar $service
     * @param $calendar_id
     * @return false
     */
    public static function createCalendar($calendar_name , $service = null )
    {
        if (! $service){
            $service = new \Google_Service_Calendar(self::client());
        }
        try {
            $calendar = new Google_Service_Calendar_Calendar();
            $calendar->setSummary($calendar_name);
            $calendar->setTimeZone(now()->getTimezone());
            $createdCalendar = $service->calendars->insert($calendar);

            return $createdCalendar->getId();
        }catch (\Exception $e){
            throw $e;
            return false;
        }
    }


    public static function createEvent($calendar_id , $params)
    {
        $service = new \Google_Service_Calendar(self::client());

        $event = new Google_Service_Calendar_Event($params);
        return response()->json($service->events->insert($calendar_id, $event));
    }

    public static function getEvent($calendar_id , $event_id)
    {
        $service = new \Google_Service_Calendar(self::client());

        return $service->events->get($calendar_id, $event_id);
    }

    public static function deleteEvent($calendar_id , $event_id)
    {
        $service = new \Google_Service_Calendar(self::client());

        return $service->events->delete($calendar_id, $event_id);
    }

    public static function updateEvent($calendar_id , $event_id , $params)
    {
        $service = new \Google_Service_Calendar(self::client());

        $event = new Google_Service_Calendar_Event($params);
        return $service->events->patch($calendar_id, $event_id , $event);
    }
}