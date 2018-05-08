<?php

class Crawler {

  private $platsbanken;
  private $yrkesgrupper;
  private $rekryteringsbehov;
  private $annonser;
  private $process;

  public function __construct() {

    $this->platsbanken = new Platsbanken();
    $this->yrkesgrupper = new Yrkesgrupper();
    $this->rekryteringsbehov = new Rekryteringsbehov();
    $this->annonser = new Annonser();
    $this->process = new Process();
  }

  public function run() {

    // Step one: get site and set cookies
    $this->getPlatsbanken();
    // Step two: get search options
    // This method could get the values for the options when searching.
    // Ex: Data/IT is 3. Is this needed?
    // @todo Save options to file
    $this->getYrkesgrupper();
    // Step three: save all job ids to file
    $this->getRekryteringsbehov();
    // Step four: get all job info and save to file
    $this->getAnnons();
  }

  private function getPlatsbanken(){

    $this->platsbanken->getPlatsbanken();
    Log::printLog("Platsbanken");
  }

  private function getYrkesgrupper() {

    $this->yrkesgrupper->getYrkesgrupper();
    Log::printLog("Yrkesgrupper");
  }

  private function getRekryteringsbehov() {

    $this->process->clearIdsFromFile();
    do {
      $json = $this->rekryteringsbehov->getRekryteringsbehov();
      $json = json_decode($json, true);
      $this->rekryteringsbehov->setLimit($json['antalRekryteringsbehov']);
      $this->process->setIdsToFile($json["rekryteringsbehov"]);
      $this->rekryteringsbehov->setCounter();
      Log::printLog("Rekryteringsbehov: ".$this->rekryteringsbehov->getCounter()." of ".$this->rekryteringsbehov->getLimit());
      usleep(100000);
    } while($this->rekryteringsbehov->isMoreRekryteringsbehov());
  }

  private function getAnnons() {

    $content = $this->process->getIdsFromFile();
    foreach ($content as $key => $row) {

      if($row) {
        $arr = explode(',', $row);

        if(isset($arr[0]) && isset($arr[1])) {
          $arr[0] = Functions::getDateFromTimestamp($arr[0]);
          $log = "Annons: discarding {$arr[1]}";

          if(!$this->process->isFile($arr[0], $arr[1])) {
            $log = "Annons: saving {$arr[1]}";
            $content = $this->annonser->getAnnons($arr[1]);
            $this->process->saveJobs($arr[0], $arr[1], $content);
            usleep(100000);
          }
          Log::printLog($log);
        }
      }
    }
  }

}
