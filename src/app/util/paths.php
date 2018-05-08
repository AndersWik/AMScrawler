<?php

class Paths {

  private static $root;
  private static $cookie;
  private static $ids;
  private static $options;
  private static $jobs;
  private static $keys;
  private static $groups;
  private static $templates;
  private static $log;

  public static function getRootPath() {

    if(self::$root === null) {
      self::$root = dirname(dirname(dirname(__DIR__)));
    }
    return self::$root;
  }

  public static function getCookiePath() {

    if(self::$cookie === null) {
      self::$cookie = self::getPath("data/cookie.txt");
    }
    return self::$cookie;
  }

  public static function getIdsPath() {
    if(self::$ids === null) {
      self::$ids = self::getPath("data/ids.txt");
    }
    return self::$ids;
  }

  public static function getOptionsPath() {
    if(self::$options === null) {
      self::$options = self::getPath("data/options.json");
    }
    return self::$options;
  }

  public static function getJobsPath() {
    if(self::$jobs === null) {
      if(Functions::getTest()) {
        self::$jobs = self::getPath("tests/data/jobs/");
      } else {
        self::$jobs = self::getPath("data/jobs/");
      }
    }
    return self::$jobs;
  }

  public static function getJobPath($file) {

    return self::getJobsPath().$file;
  }

  public static function getKeysPath() {

    if(self::$keys === null) {
      if(Functions::getTest()) {
        self::$keys = self::getPath("tests/data/keys.json");
      } else {
        self::$keys = self::getPath("data/keys.json");
      }
    }
    return self::$keys;
  }

  public static function getGroupsPath() {
    if(self::$groups === null) {
      self::$groups = self::getPath("data/groups/");
    }
    return self::$groups;
  }

  public static function getGroupPath($group) {
    
    return self::getGroupsPath().$group;
  }

  public static function getTemplatesPath() {
    if(self::$templates === null) {
      self::$templates = self::getPath("src/app/templates/");
    }
    return self::$templates;
  }

  public static function getTemplatePath($template) {
    
    return self::getTemplatesPath().$template;
  }

  public static function getLogPath() {

    if(self::$log === null) {
      self::$log = self::getPath("data/log.txt");
    }
    return self::$log;
  }

  private static function getPath($item) {

    $path = "";
    if($item) {
      $path = self::getRootPath()."/".$item;
    }
    return $path;
  }
}
