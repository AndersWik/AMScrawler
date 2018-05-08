<?php

class Functions {

    private static $test = false;

    public function getDate() {

        return date("Y-m-d");
    }

    public function getYear() {

        return date("Y");
    }

    public function getYearMonth() {

        return date("Ym");
    }

    public function getDateFromTimestamp($stamp) {

        $stamp = substr("{$stamp}", 0, 10);
        return date('Ymd', $stamp);
    }

    public function setTest($test) {

        self::$test = $test;
    }

    public function getTest() {

        return self::$test;
    }
    
}