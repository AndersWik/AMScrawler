<?php

class File {

  private $path;

  public function __construct($path) {

    $this->path = $path;
  }

  public function setPath($path) {

    $this->path = $path;
  }

  public function getContent() {

    $content = "";
    if($this->isPathFile()) {
      $content = file_get_contents($this->path);
    }
    return $content;
  }

  public function getContentJsonDecode() {

    return json_decode($this->getContent(), true);
  }

  public function getContentArray() {

    return explode(PHP_EOL, $this->getContent());
  }

  public function appendToFile($content) {

    file_put_contents($this->path, $content, FILE_APPEND);
  }

  public function writeToFile($content) {

    file_put_contents($this->path, $content);
  }

  public function isPathFile() {

    return is_file($this->path);
  }

}
