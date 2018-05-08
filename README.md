# AMS crawler

Tool for getting the data of jobs published in a category on https://www.arbetsformedlingen.se/.

A html page can then be made that specifies in how many ads a
keyword is mentioned. The keywords are listed in the file `keys.json`.
The result is exported to a json, xml and html file and saved in the `data/groups` folder.

In the html file the result is listed in falling order. The keywords can be expanded and show what other keywords where often used in the same ads.

## Prerequisites

* PHP
* Composer

## Installation

First [install composer](https://getcomposer.org/download/).

``` bash
php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
php -r "if (hash_file('SHA384', 'composer-setup.php') === '544e09ee996cdf60ece3804abc52599c22b1f40f4323403c44d44fdfdd586475ca9813a858088ffbc1f233e9b180f061') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"
php composer-setup.php
php -r "unlink('composer-setup.php');"
```

Then run composer update.

``` bash
$ php composer.phar update
```

### Compatibility

* PHP 7.1.7
* Composer version 1.6.3

## Usage

Avaible options are listed in the `help` menu.

``` bash
$ php ams.php help
```

To be able to search thru the available ads we need to fetch them.
Do this with the crawl option. All ads are saved in json format in `app/data/jobs`.

``` bash
$ php ams.php crawler
```

Search all ads and export the result.

``` bash
$ php ams.php filter
```

Search all ads from current month.

``` bash
$ php ams.php filter-m
```

Search all ads from current year.

``` bash
$ php ams.php filter-y
```

## Tests

The tests are using php unit. To run the test use,

``` php
$ vendor/phpunit/phpunit/phpunit --testsuite Feature Tests
```

## Versioning

https://semver.org/