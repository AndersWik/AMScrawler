<?php

class App {

  private $crawler;
  private $search;

  public function __construct() {

    $this->crawler = new Crawler();
    $this->search = new Search();
  }

  private function getHelp() {

    echo <<<HELP
\n
  AMS scraper
  =====================================================
  Options:
  help              Show help menu.
  crawler           Get all available ads.
  filter            Search all ads.
  filter-m          Search all ads from current month.
  filter-y          Search all ads from current year.
\n
HELP;
  }

  private function getArgs() {

    $arguments = array("key" => "");

    if(!isset($argv)) {
      $argv = $_SERVER['argv'];
    }
    if(isset($argv[1])) {

      $arguments['key'] = $argv[1];
    }
    return $arguments;
  }

  public function run() {

    $args = $this->getArgs();

    if($args['key'] == "help") {
      $this->getHelp();
    } elseif($args['key'] == "filter") {
      $this->search->run();
    } elseif($args['key'] == "filter-m") {
      $this->search->run("m");
    } elseif($args['key'] == "filter-y") {
      $this->search->run("y");
    } elseif($args['key'] == "crawler") {
      $this->crawler->run();
    }
  }
}