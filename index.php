<?php

require_once __DIR__ . '/vendor/autoload.php';

$pathToTemplates = __DIR__ . '/src/CalendarBundle/Resources/views/';

$loader = new Twig_Loader_Filesystem($pathToTemplates);
$loader->addPath($pathToTemplates, 'Calendar');
$twig = new Twig_Environment($loader, [
    'debug' => true,
]);

$year = (int) $_GET['year'] ?? date('Y');
$month = (int) $_GET['month'] ?? date('m');

use Kisphp\CalendarBundle\Translations\LangRo;
use Kisphp\CalendarBundle\Services\Calendar;

$translation = new LangRo();
$calendar = new Calendar($translation);
$calendar->generateData($year, $month, date('d'));

echo $twig->render('@Calendar/Demo/calendar.html.twig', [
    'calendar' => $calendar,
]);
