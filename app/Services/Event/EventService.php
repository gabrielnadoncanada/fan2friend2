<?php

namespace App\Services\Event;

use Carbon\Carbon;

class EventService
{

    public function getAvailableSlotsForDateRange(Carbon $startDate, Carbon $endDate)
    {
        // This method would ideally interact with your database to fetch all available slots
        // within the given date range.
        $slots = []; // Fetch from your database or other data source
        $availableSlots = [];

        foreach ($slots as $slot) {
            if ($slot->date >= $startDate && $slot->date <= $endDate && $slot->isAvailable) {
                $availableSlots[] = $slot;
            }
        }

        return $availableSlots;
    }

    public function checkAndBookSlot(Carbon $date, Carbon $time)
    {
        // Check if the given slot is available. If it is, book it.
        $slot = $this->findSlotByDateTime($date, $time);

        if ($slot && $slot->isAvailable) {
            $slot->isAvailable = false;
            // Save the slot as booked in the database or other data source.
            return true;
        }

        return false;
    }

    public function setBufferTimes(Carbon $time, int $bufferBefore, int $bufferAfter)
    {
        // Adjust the given time by adding buffer times before and after it.
        $startTime = $time->copy()->subMinutes($bufferBefore);
        $endTime = $time->copy()->addMinutes($bufferAfter);

        return ['start' => $startTime, 'end' => $endTime];
    }

    public function getIncrementedTimeSlots(Carbon $startTime, int $incrementMinutes, int $numberOfSlots)
    {
        $slots = [];

        for ($i = 0; $i < $numberOfSlots; $i++) {
            $slots[] = $startTime->copy()->addMinutes($i * $incrementMinutes);
        }

        return $slots;
    }

    public function isBookingWithinNoticePeriod(Carbon $date, Carbon $time, int $noticePeriodHours)
    {
        // Check if the booking time is within the required notice period.
        $bookingDateTime = $date->copy()->setTimeFrom($time);

        return Carbon::now()->addHours($noticePeriodHours)->greaterThanOrEqualTo($bookingDateTime);
    }

    public function getMaxBookingsForDate(Carbon $date)
    {
        // Fetch the number of bookings for a specific date.
        // This would ideally interact with your database to fetch this count.
        $bookings = []; // Fetch from your database or other data source
        $count = 0;

        foreach ($bookings as $booking) {
            if ($booking->date->isSameDay($date)) {
                $count++;
            }
        }

        return $count;
    }

    protected function findSlotByDateTime(Carbon $date, Carbon $time)
    {
        // This method would ideally interact with your database to fetch a specific slot
        // based on the given date and time.
        // The following is a placeholder and should be replaced with the actual logic to
        // fetch the slot from your database or other data source.

        $slots = []; // Fetch from your database or other data source

        foreach ($slots as $slot) {
            if ($slot->date->isSameDay($date) && $slot->time->eq($time)) {
                return $slot;
            }
        }

        return null; // Return null if no matching slot found
    }
}
