<?php

namespace Kisphp\CalendarBundle\Services;

use Kisphp\CalendarBundle\Translations\AbstractTranslation;
use Kisphp\CalendarBundle\Translations\LangRo;

class Calendar
{
    const NEXT_LINE = '<br>';

    /**
     * @var AbstractTranslation
     */
    protected $trans;

    /**
     * @var array
     */
    protected $days = [];

    public function __construct()
    {
        $this->trans = new LangRo();
    }

    /**
     * @param $year
     * @param $month
     * @param $day
     *
     * @return $this
     */
    public function generateData($year, $month, $day)
    {
        $selectedDate = \DateTime::createFromFormat(
            'Y-m-d',
            sprintf(
                '%d-%d-%d',
                $year,
                $month,
                $day
            )
        );

        $currentMonth = clone $selectedDate;
        $currentMonth->modify('last day of this month');

        $previousMonthDate = (clone $selectedDate)->sub(new \DateInterval('P1M'));
        $previousMonthDate->modify('last day of this month');

        $nextMonthDate = (clone $selectedDate)->add(new \DateInterval('P1M'));
        $nextMonthDate->modify('first day of this month');

        $lastDayPreviusMonthEnd = (int) $previousMonthDate->format('N');
        $firstDayNextMonthStart = 7 - (int) $nextMonthDate->format('N');
        $lastDayCurrentMonth = (int) $currentMonth->format('d');

        $totalDaysToShow = $lastDayPreviusMonthEnd + $lastDayCurrentMonth + $firstDayNextMonthStart;

        $numberOfColumns = ceil($totalDaysToShow / 7);

        $dayNumber = 1;
        $dayNumberNextMonth = 1;

        $this->days = [];

        for ($rowNumber = 1; $rowNumber <= $numberOfColumns; $rowNumber++) {
            for ($columnNumber = 1; $columnNumber <= 7; $columnNumber++) {
                if ($rowNumber === 1 && $columnNumber <= $lastDayPreviusMonthEnd) {
                    $this->days[] = [
                        'value' => (int) $previousMonthDate->format('d') - $lastDayPreviusMonthEnd + $columnNumber,
                        'class' => null,
                        'out' => true,
                    ];
                    continue;
                }

                if ($dayNumber <= $lastDayCurrentMonth) {
                    $this->days[] = [
                        'value' => $dayNumber,
                        'class' => ($dayNumber === (int) $selectedDate->format('d')) ? 'active' : '',
                        'out' => false,
                    ];
                    $dayNumber++;
                    continue;
                }

                $this->days[] = [
                    'value' => $dayNumberNextMonth,
                    'class' => null,
                    'out' => true,
                ];
                $dayNumberNextMonth++;
            }
        }

        return $this;
    }

    /**
     * @return array
     */
    public function getDays()
    {
        return $this->days;
    }

    /**
     * @return array
     */
    public function createTableHeader()
    {
        $columns = [];
        for ($i = 1; $i <= 7; $i++) {
            $columns[] = $this->trans->getDayShort($i);
        }

        return $columns;
    }
}