<?php

namespace App\Services\Event;

use Carbon\Carbon;

class UserTimezoneService
{

    /**
     * Convert the given time to the user's timezone.
     *
     * @param Carbon $time The time to be converted.
     * @param string $userTimezone The user's timezone.
     * @return Carbon              The converted time.
     */
    public function convertToUserTimezone(Carbon $time, string $userTimezone): Carbon
    {
        return $time->setTimezone($userTimezone);
    }

    /**
     * Convert the given time to the event's timezone.
     *
     * @param Carbon $time The time to be converted.
     * @param string $eventTimezone The event's timezone.
     * @return Carbon                 The converted time.
     */
    public function convertToEventTimezone(Carbon $time, string $eventTimezone): Carbon
    {
        return $time->setTimezone($eventTimezone);
    }
}
