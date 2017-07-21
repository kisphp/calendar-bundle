<?php

namespace Kisphp\CalendarBundle\Services;

use Kisphp\CalendarBundle\Translations\AbstractTranslation;
use Kisphp\CalendarBundle\Translations\LangRo;

class Calendar
{
    protected $selectedYear;

    protected $maxim_days = [
        1 => 31,
        28,
        31,
        30,
        31,
        30,
        31,
        31,
        30,
        31,
        30,
        31
    ];

    /**
     * @var AbstractTranslation
     */
    protected $trans;

    public function __construct()
    {
        $this->trans = new LangRo();
    }

    protected function getMaximDays($selectedMonth)
    {
        if ($this->selectedYear % 4 === 0) {
            $this->maxim_days[2] = 29;
        }

        return $this->maxim_days[$selectedMonth];
    }

    public function draw($an = 2017, $luna = 7, $zi = 20)
    {
        $day = (int) $zi;

        $selectedMonth = ($luna > 0) ? $luna : date('n');
        $selectedYear = ($an > 0) ? $an : date('Y');

        $daysPreviousMonth = date('N', mktime(0, 0, 0, $selectedMonth, 1, $selectedYear)) - 1;

        $monthMaximDays = $this->getMaximDays($selectedMonth);
        $daysNextMonth = 7 - date('N', mktime(0, 0, 0, $selectedMonth, $monthMaximDays));

        $maximDaysToShow = $daysPreviousMonth + $daysNextMonth + $monthMaximDays;

        ?>
        <div class="kisphp-calendar">
            <div class="dates">
                <?php
                echo $this->getNavigation($selectedYear, $selectedMonth);
                echo $this->getTableHeader();

                $numberOfColumns = $maximDaysToShow / 7;
                $dayNumber = 1;

                $plus = 1;

                for ($rowNumber = 1; $rowNumber <= $numberOfColumns; $rowNumber++) { ?>
                    <div class="row">
                    <?php
                    for ($columnNumber = 1; $columnNumber <= 7; $columnNumber++) {
                        $out = '<div class="col float">';
                        if (($rowNumber === 1) && ($columnNumber <= $daysPreviousMonth)) {
                            $out .= '<span class="out">' . ($monthMaximDays - $daysPreviousMonth + $columnNumber) . '</span>';
                        } else {
                            if ($dayNumber <= $monthMaximDays) {
                                $out .= '<div';
                                if ($dayNumber === $day || ($day === 0 && $dayNumber === date('j') && $selectedMonth === date('m'))) {
                                    $out .= ' class="activ"';
                                }
                                $out .= '>';
                                $out .= $dayNumber;
                                $out .= '</div>';
                                $dayNumber++;
                            } else {
                                $out .= '<span class="out">' . $plus . '</span>';
                                $plus++;
                            }
                        }
                        $out .= '</div>';
                    }


            $out .= '</div>
            <div class="clear"></div>';
            }
            echo $out;
            ?>
        </div><!-- end .date -->
        </div><!-- end .cld -->
        <div class="desp-10"></div>
<?php

    }

    /**
     * @param int $selectedYear
     * @param int $selectedMonth
     *
     * @return string
     */
    protected function getNavigation($selectedYear, $selectedMonth)
    {
        $int_minus = mktime(0, 0, 0, $selectedMonth - 1, 1, $selectedYear);
        $int_plus = mktime(0, 0, 0, $selectedMonth + 1, 1, $selectedYear);

        $previousMonth = date('n', $int_minus);
        $nextMonth = date('n', $int_plus);

        $yearLastMonth = date('Y', $int_minus);
        $yearNextMonth = date('Y', $int_plus);

        ob_start();
        ?>
        <div class="row-top">
            <div class="col prev-next float">
                <a onclick="calendar_show(<?php echo $yearLastMonth ?>, <?php echo $previousMonth ?>, 0)" href="javascript:void(0)">&laquo;</a>
            </div>
            <div class="col middle float"><?php echo $this->trans->getMonthName($selectedMonth) ?> <?php echo $selectedYear ?></div>
            <div class="col prev-next float">
                <a onclick="calendar_show(<?php echo $yearNextMonth ?>, <?php echo $nextMonth ?>, 0)" href="javascript:void(0)">&raquo;</a>
            </div>
            <div class="clear"></div>
        </div><!-- end .row -->
        <?php

        return ob_get_clean();
    }

    /**
     * @return string
     */
    protected function getTableHeader()
    {
        $html = '<div class="row-head">';
        for($dayNumber = 1; $dayNumber <= 7; $dayNumber++) {
            $html .= '<div class="col float">' . $this->trans->getDayShort($dayNumber) .'</div>';
        }
        $html .= '<div class="clear"></div></div>';

        return $html;
    }
}
