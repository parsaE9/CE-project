<?php

namespace App\Helpers;

use App\Models\EventLog;
use PhpParser\Node\Expr\Array_;

class EventLogHelper
{
    public static function addEventLog($type , $title , $description, $metas = null)
    {
        /** @var EventLog $event */
        $event = EventLog::create(
            [
                'type' => $type,
                'title' => $title,
                'description' => $description,
            ]
        );

        if ($metas){
            if (! is_array($metas[0])) $metas = [$metas];
            $event->meta()->createMany($metas);
        }

        return $event;
    }

    public static function createMeta($object , $title = null, $idAttribute = 'id'){
        return [
            'actor_type' => \get_class($object),
            'actor_id' => $object->$idAttribute,
            'title' => $title
        ];
    }
}