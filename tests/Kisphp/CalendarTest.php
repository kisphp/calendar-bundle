<?php

namespace tests\Kisphp;

use Kisphp\CalendarBundle\Services\Calendar;
use Kisphp\CalendarBundle\Translations\English;
use PHPUnit\Framework\TestCase;

class CalendarTest extends TestCase
{
    public function test_juli_2017()
    {
        $calendar = $this->createCalendar();

        $calendar->generateData(2017, 07, 21);

        $days = $calendar->getDays();

        self::assertSame([
            'value' => 26,
            'class' => '',
            'out' => true,
        ], $days[0]);

        self::assertSame([
            'value' => 27,
            'class' => '',
            'out' => true,
        ], $days[1]);

        self::assertSame([
            'value' => 6,
            'class' => '',
            'out' => true,
        ], end($days));
    }

    public function test_may_2017()
    {
        $calendar = $this->createCalendar();

        $calendar->generateData(2017, 05, 21);

        $days = $calendar->getDays();

        self::assertSame([
            'value' => 1,
            'class' => '',
            'out' => false,
        ], $days[0]);

        self::assertSame([
            'value' => 2,
            'class' => '',
            'out' => false,
        ], $days[1]);

        self::assertSame([
            'value' => 4,
            'class' => '',
            'out' => true,
        ], end($days));
    }

    public function test_april_2017()
    {
        $calendar = $this->createCalendar();

        $calendar->generateData(2017, 04, 21);

        $days = $calendar->getDays();

        self::assertSame([
            'value' => 27,
            'class' => '',
            'out' => true,
        ], $days[0]);

        self::assertSame([
            'value' => 28,
            'class' => '',
            'out' => true,
        ], $days[1]);

        self::assertSame([
            'value' => 30,
            'class' => '',
            'out' => false,
        ], end($days));
    }

    public function test_februar_2017()
    {
        $calendar = $this->createCalendar();

        $calendar->generateData(2017, 02, 21);

        $days = $calendar->getDays();

        self::assertSame([
            'value' => 30,
            'class' => '',
            'out' => true,
        ], $days[0]);

        self::assertSame([
            'value' => 31,
            'class' => '',
            'out' => true,
        ], $days[1]);

        self::assertSame([
            'value' => 5,
            'class' => '',
            'out' => true,
        ], end($days));
    }

    public function test_februar_2016()
    {
        $calendar = $this->createCalendar();

        $calendar->generateData(2016, 02, 21);

        $days = $calendar->getDays();

        self::assertSame([
            'value' => 1,
            'class' => '',
            'out' => false,
        ], $days[0]);

        self::assertSame([
            'value' => 2,
            'class' => '',
            'out' => false,
        ], $days[1]);

        self::assertSame([
            'value' => 6,
            'class' => '',
            'out' => true,
        ], end($days));
    }

    public function test_march_2016()
    {
        $calendar = $this->createCalendar();

        $calendar->generateData(2016, 03, 21);

        $days = $calendar->getDays();

        self::assertSame([
            'value' => 29,
            'class' => '',
            'out' => true,
        ], $days[0]);

        self::assertSame([
            'value' => 1,
            'class' => '',
            'out' => false,
        ], $days[1]);

        self::assertSame([
            'value' => 3,
            'class' => '',
            'out' => true,
        ], end($days));
    }

    /**
     * @return Calendar
     */
    protected function createCalendar(): Calendar
    {
        $lang = new English();

        return new Calendar($lang);
    }
}
