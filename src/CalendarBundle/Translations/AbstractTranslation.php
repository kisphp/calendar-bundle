<?php

namespace Kisphp\CalendarBundle\Translations;

abstract class AbstractTranslation
{
    protected $months = [];

    public function getMonthName($monthIndex)
    {
        return $this->months[$monthIndex];
    }
}
