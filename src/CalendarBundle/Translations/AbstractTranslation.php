<?php

namespace Kisphp\CalendarBundle\Translations;

abstract class AbstractTranslation
{
    protected $days = [
        1 => 'Mon',
        'Tue',
        'Wed',
        'Thu',
        'Fri',
        'Sat',
        'Sun',
    ];
    protected $months = [];

    public function getMonthName($monthIndex)
    {
        return $this->months[$monthIndex];
    }

    public function getDayShort($dayNumber)
    {
        if ($dayNumber < 1 || $dayNumber > 7) {
            $dayNumber = 1;
        }
        return $this->days[$dayNumber];
    }
}
