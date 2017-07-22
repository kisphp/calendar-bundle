<?php

namespace Kisphp\CalendarBundle\Translations;

abstract class AbstractTranslation
{
    /**
     * @var array
     */
    protected $days = [];

    /**
     * @var array
     */
    protected $months = [];

    /**
     * @param int $monthIndex
     *
     * @return mixed
     */
    public function getMonthName($monthIndex)
    {
        return $this->months[$monthIndex];
    }

    /**
     * @param int $dayNumber
     *
     * @return string
     */
    public function getDayShort($dayNumber)
    {
        if ($dayNumber < 1 || $dayNumber > 7) {
            $dayNumber = 1;
        }

        return $this->days[$dayNumber];
    }
}
