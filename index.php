<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Calendar</title>
    <link rel="stylesheet" href="src/CalendarBundle/Resources/public/css/calendar.css">
</head>
<body>
<?php

require_once __DIR__ . '/vendor/autoload.php';

$c = new \Kisphp\CalendarBundle\Services\Calendar();

$c->draw();
?>
</body>
</html>