# Vue.js events calendar Landingpage

Vue.js events calendar Landingpage based on [jigsaw](http://jigsaw.tighten.co/) template

Events json file is loaded via ajax and sorted by date, newest to oldest, past events at bottom.
Clickable imagemap scrolls to event details of corresponding city.
Searching for Zips in Event searchbar shows closest city.

## Prerequisites

* [nodejs](https://nodejs.org/en/download/)
* [yarn](https://yarnpkg.com/en/docs/install)
* [composer](https://getcomposer.org/download/)

## Installation

To begin using this template:

* clone repo
* composer install
* yarn install
* set www-root to build_local or build_production
* create .env file and set browsersync proxy: ```cp .env.example .env```

Usage / Demo

* Visit http://vue-events-calendar.rf.gd/

After downloading, simply edit:

* HTML in source/_layouts
* JS in source/_assets/js/
* SASS in source/_assets/sass

### Webpack commands

* yarn dev
* yarn prod
* yarn watch

## Additional Info

### Events.json

* sort by date
* date format: YYYY-MM-DD HH:mm
* convert xls to json http://www.convertcsv.com/csv-to-json.htm

### calendarics

Create .ics files at https://www.sitepackage.de/service/tools/icalendar.php