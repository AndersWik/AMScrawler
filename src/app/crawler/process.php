<?php

class Process {

  private $ids;
  private $jobs;
  private $log;
  private $file;

  public function __construct() {

    $this->ids = new File(Paths::getIdsPath());
    $this->jobs = new Folder(Paths::getJobsPath());
    $this->file = new File(Paths::getJobsPath());
    $this->log = Log::getLog();
  }

  public function getIdsFromFile() {

    return $this->ids->getContentArray();
  }

  public function clearIdsFromFile() {
    $this->ids->writeToFile("");
  }

  public function setIdsToFile($ids) {

    if(is_array($ids)) {
      $content = "";
      foreach ($ids as $key => $value) {
        if(isset($value['publiceringsdatum']) && isset($value['id'])) {
          $content .= $value['publiceringsdatum'].",".$value['id']."\n";
        }
      }
      $this->ids->appendToFile($content);
    }
  }

  public function isFile($date, $id) {

    $path = Paths::getJobPath($date."-".$id.".json");
    $this->file->setPath($path);
    return $this->file->isPathFile();
  }

  public function saveJobs($date, $id, $content) {

    $filename = $date."-".$id.".json";
    $json = json_decode($content, true);
    $this->log->printLog("Exporting json for: $filename");
    $this->jobs->exportFile($filename, $content);
  }

}
