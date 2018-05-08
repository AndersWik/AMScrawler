<?php

class Folder {

  private $path;
  private $filter;

  public function __construct($path) {

    $this->path = $path;
  }

  public function setPath($path) {

    $this->path = $path;
  }

  public function setFilter($filter) {

    $this->filter = $filter;
  }

  public function getFilter() {

    return $this->filter;
  }

  public function exportFile($name, $content) {

    if(!file_exists($this->path.$name)) {
      $file = fopen($this->path.$name, "w+");
      echo fwrite($file, $content);
      fclose($file);
    }
  }

  public function getList() {

    $list = "";
    if(is_dir($this->path)) {
        $list = scandir($this->path, 1);
    }
    return $list;
  }

  public function getListFiltered() {

    return array_filter($this->getList(), function ($value) {
      return (substr($value, 0, strlen("{$this->filter}")) === $this->filter);
    });
  }

}
