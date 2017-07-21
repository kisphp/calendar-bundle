<?php

namespace Kisphp\CalendarBundle\Services;

use Kisphp\CalendarBundle\Translations\AbstractTranslation;
use Kisphp\CalendarBundle\Translations\LangRo;

class Calendar
{
    /**
     * @var AbstractTranslation
     */
    protected $trans;

    /**
     * @var array
     */
    protected $days = [];

    /**
     * @var \DateTime
     */
    protected $selectedDate;

    /**
     * @var \DateTime
     */
    protected $previousMonthDate;

    /**
     * @var \DateTime
     */
    protected $nextMonthDate;

    /**
     * @param AbstractTranslation $translation
     */
    public function __construct(AbstractTranslation $translation)
    {
        $this->trans = $translation;
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
        $today = new \DateTime('now');

        $this->selectedDate = \DateTime::createFromFormat(
            'Y-m-d',
            sprintf(
                '%d-%d-%d',
                $year,
                $month,
                $day
            )
        );

        $currentMonth = clone $this->selectedDate;
        $currentMonth->modify('last day of this month');

        $this->previousMonthDate = (clone $this->selectedDate)->sub(new \DateInterval('P1M'));
        $this->previousMonthDate->modify('last day of this month');

        $this->nextMonthDate = (clone $this->selectedDate)->add(new \DateInterval('P1M'));
        $this->nextMonthDate->modify('first day of this month');

        $lastDayPreviusMonthEnd = (int) $this->previousMonthDate->format('N');
        $firstDayNextMonthStart = 7 - (int) $this->nextMonthDate->format('N');
        $lastDayCurrentMonth = (int) $currentMonth->format('d');

        $totalDaysToShow = $lastDayPreviusMonthEnd + $lastDayCurrentMonth + $firstDayNextMonthStart + 1;

        $dayNumber = 1;
        $dayNumberNextMonth = 1;

        $this->days = [];

        for ($columnIndex = 1; $columnIndex <= $totalDaysToShow; $columnIndex++) {
            $columnNumber = (int) ceil($columnIndex / 7);
            if ($columnNumber === 1 && $columnIndex <= $lastDayPreviusMonthEnd) {
                $this->days[] = [
                    'value' => (int) $this->previousMonthDate->format('d') - $lastDayPreviusMonthEnd + $columnNumber,
                    'class' => null,
                    'out' => true,
                ];
                continue;
            }

            if ($dayNumber <= $lastDayCurrentMonth) {
                $this->days[] = [
                    'value' => $dayNumber,
                    'class' => $this->getClassForDay($today, $dayNumber),
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

    /**
     * @return string
     */
    public function getCurrentDate()
    {
        $monthIndex = (int) $this->selectedDate->format('m');

        return $this->trans->getMonthName($monthIndex);
    }

    /**
     * @return string
     */
    public function getCurrentYear()
    {
        return $this->selectedDate->format('Y');
    }

    /**
     * @return \DateTime
     */
    public function getNextMonth()
    {
        return $this->nextMonthDate;
    }

    /**
     * @return \DateTime
     */
    public function getPreviousMonth()
    {
        return $this->previousMonthDate;
    }

    /**
     * @param \DateTime $today
     * @param $dayNumber
     *
     * @return string
     */
    protected function getClassForDay(\DateTime $today, $dayNumber)
    {
        if (
            $this->selectedDate->format('Y') === $today->format('Y')
            && $this->selectedDate->format('m') === $today->format('m')
            && $dayNumber === (int) $this->selectedDate->format('d')
        ) {
            return 'active';
        }

        return '';
    }
}
