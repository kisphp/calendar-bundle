<?php

require_once __DIR__ . '/vendor/autoload.php';

$pathToTemplates = __DIR__ . '/src/CalendarBundle/Resources/views/';

$loader = new Twig_Loader_Filesystem($pathToTemplates);
$loader->addPath($pathToTemplates, 'Calendar');
$twig = new Twig_Environment($loader, [
    'debug' => true,
]);

$translation = new \Kisphp\CalendarBundle\Translations\LangRo();
$calendar = new \Kisphp\CalendarBundle\Services\Calendar($translation);
$calendar->generateData(2017, 5, 21);

echo $twig->render('@Calendar/Demo/calendar.html.twig', [
    'calendar' => $calendar,
]);
