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
## Extend calendar

Here is an example on how to make the callendar responsive.
All you have to do is to extend the scss file:

```scss
$column_width: 100%/7;
$column_height: 35px;
$font-size: 16px;
$active_background: #369;
$active_color: #fff;
$col_border_width: 0;

@import "vendor/kisphp/calendar-bundle/gulp/assets/scss/calendar.scss";

.kisphp-calendar {

  .col {
    &:hover {
      background: #ccc;

      .out {
        color: #fff;
      }
    }

    .active {
      a {
        color: #fff;
      }
    }
    .day {
      a {
        font-weight: bold;

        &:hover {
          color: #a30000;
        }
      }
    }
  }
}
```
