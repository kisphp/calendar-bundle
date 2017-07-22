# Kisphp Calendar Bundle

[![Build Status](https://travis-ci.org/kisphp/calendar-bundle.svg?branch=master)](https://travis-ci.org/kisphp/calendar-bundle)

## Installation

```bash
composer require kisphp/calendar-bundle
```

## Usage

```php
<?php

use Kisphp\CalendarBundle\Translations\LangRo;
use Kisphp\CalendarBundle\Services\Calendar;

$translation = new LangRo();
$calendar = new Calendar($translation);
$calendar->generateData($year, $month, date('d'));

// get generated days as array
$calendar->getDays();
```

Add css to your page (Symfony)
```html
<link href="bundles/calendar/css/calendar.css" rel="stylesheet" /> 
```
