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

        if ($selectedYear % 4 == 0) {
            $maxim_de_zile[2] = 29;
        }

        $gol_prim = date('N', mktime(0, 0, 0, $selectedMonth, 1, $selectedYear)) - 1;

        $monthMaximDays = $this->getMaximDays($selectedMonth);
        $gol_secund = 7 - date('N', mktime(0, 0, 0, $selectedMonth, $monthMaximDays));

        $max_zile = $gol_prim + $gol_secund + $monthMaximDays;

        $int_minus = mktime(0, 0, 0, $selectedMonth - 1, 1, $selectedYear);
        $int_plus = mktime(0, 0, 0, $selectedMonth + 1, 1, $selectedYear);

//        $data_minus = date("M Y", $int_minus);
//        $data_plus = date("M Y", $int_plus);

        $luna_minus = date('n', $int_minus);
        $luna_plus = date('n', $int_plus);

        $an_minus = date('Y', $int_minus);
        $an_plus = date('Y', $int_plus);

        ?>
        <div class="float cld">
            <div class="dates">
                <div class="row-top">
                    <div class="prev-next float">
                        <a onclick="calendar_show(<?php echo $an_minus ?>, <?php echo $luna_minus ?>, 0)" href="javascript:void(0)">&laquo;</a>
                    </div>
                    <div class="middle float"><?php echo $this->trans->getMonthName($selectedMonth) ?> <?php echo $selectedYear ?></div>
                    <div class="prev-next float">
                        <a onclick="calendar_show(<?php echo $an_plus ?>, <?php echo $luna_plus ?>, 0)" href="javascript:void(0)">&raquo;</a>
                    </div>
                    <div class="clear"></div>
                </div><!-- end .row -->
                <div class="row-head">
                    <div class="col float">Lun</div>
                    <div class="col float">Mar</div>
                    <div class="col float">Mie</div>
                    <div class="col float">Joi</div>
                    <div class="col float">Vin</div>
                    <div class="col float">Sam</div>
                    <div class="col float">Dum</div>
                    <div class="clear"></div>
                </div><!-- end .row -->
                <?php
                $j_max = $max_zile / 7;
                $nr_zi = 1;

                $plus = 1;
//                $tmp_luna = $selectedMonth - 1;
//                if ($tmp_luna < 1) {
//                    $tmp_luna = 12;
//                }

                for ($j = 1; $j <= $j_max; $j++) { ?>
                <div class="row">
                    <?php for ($i = 1;
                    $i <= 7;
                    $i++) {
                    echo '<div class="col float">';
                    if (($j === 1) && ($i <= $gol_prim)) {
                        echo '<span class="out">' . ($monthMaximDays - $gol_prim + $i) . '</span>';
                    } else {
                        if ($nr_zi <= $monthMaximDays) {
                            echo '<div';
                            if ($nr_zi === $day || ($day === 0 && $nr_zi === date('j') && $selectedMonth === date('m'))) {
                                echo ' class="activ"';
                            }
                            echo '>';
                            echo $nr_zi;
                            echo '</div>';
                            $nr_zi++;
                        } else {
                            echo '<span class="out">' . $plus . '</span>';
                            $plus++;
                        }
                    }
                    ?>
                </div>
            <?php } ?>
            </div>
            <div class="clear"></div>
            <?php } ?>
        </div><!-- end .date -->
        </div><!-- end .cld -->
        <div class="desp-10"></div>
<?php

    }
}
