<?php

class Log {

  public static $file;

  private function __construct() {

    self::$file = new File(Paths::getLogPath());
  }

  public static function getLog() {

    if(self::$file === null) {
      self::$file = new Log();
    }
    return self::$file;
  }

  public function printLog($log) {

    echo $log.PHP_EOL;
  }

  public function printLogToFile($log) {

    self::$file->appendToFile($log);
  }

}
