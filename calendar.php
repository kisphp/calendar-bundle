<?php

function sanitize_int($number)
{
    return (int)$number;
}

$luna = (int)$_POST['luna'];
if (preg_match("/([0-9]{4})/", $_POST['an'])) {
    $an = (int)$_POST['an'];
} else {
    $an = date("Y");
}

$_zi = sanitize_int($_POST['zi']);

$luna_selectata = ($luna > 0) ? $luna : date("n");
$an_selectat = ($an > 0) ? $an : date("Y");

$months = [1 => "Ianuarie", "Februarie", "Martie", "Aprilie", "Mai", "Iunie", "Iulie", "August", "Septembrie", "Octombrie", "Noiembrie", "Decembrie"];
$maxim_de_zile = [1 => 31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31];

if ($an_selectat % 4 == 0) {
    $maxim_de_zile[2] = 29;
}

$gol_prim = date("N", mktime(0, 0, 0, $luna_selectata, 1, $an_selectat)) - 1;

$gol_secund = 7 - date("N", mktime(0, 0, 0, $luna_selectata, $maxim_de_zile[(int)$luna_selectata], $an_selectat));

$max_zile = $gol_prim + $gol_secund + $maxim_de_zile[(int)$luna_selectata];

$int_minus = mktime(0, 0, 0, $luna_selectata - 1, 1, $an_selectat);
$int_plus = mktime(0, 0, 0, $luna_selectata + 1, 1, $an_selectat);

$data_minus = date("M Y", $int_minus);
$data_plus = date("M Y", $int_plus);

$luna_minus = date("n", $int_minus);
$luna_plus = date("n", $int_plus);

$an_minus = date("Y", $int_minus);
$an_plus = date("Y", $int_plus);

?>
<div class="float cld">
    <div class="dates">
        <div class="row-top">
            <div class="prev-next float"><a onclick="calendar_show(<?= $an_minus ?>, <?= $luna_minus ?>, 0)"
                                            href="javascript:void(0)">&laquo;</a></div>
            <div class="middle float"><?= $months[$luna_selectata] ?> <?= $an_selectat ?></div>
            <div class="prev-next float"><a onclick="calendar_show(<?= $an_plus ?>, <?= $luna_plus ?>, 0)"
                                            href="javascript:void(0)">&raquo;</a></div>
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
        $tmp_luna = $luna_selectata - 1;
        if ($tmp_luna < 1) {
            $tmp_luna = 12;
        }

        $tmp = 0;

        $_dates = [];

        for ($j = 1;
        $j <= $j_max;
        $j++) { ?>
        <div class="row">
            <?php for ($i = 1;
            $i <= 7;
            $i++) {
            echo '<div class="col float">';
            if (($j == 1) && ($i <= $gol_prim)) {
                echo '<span class="out">' . ($maxim_de_zile[$tmp_luna] - $gol_prim + $i) . '</span>';
            } else {
                if ($nr_zi <= $maxim_de_zile[$luna_selectata]) {
                    echo '<div';
                    if ($nr_zi == $_zi || ($_zi == 0 && $nr_zi == date('j') && $luna_selectata == date('m'))) {
                        echo ' class="activ"';
                    }
                    echo '>';
                    echo $nr_zi;
                    echo '</div>';
                    $nr_zi++;
                } else {
                    echo '<span class="out">' . ($plus) . '</span>';
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
