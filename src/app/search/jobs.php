<?php

class Jobs {

    const ADD_TEXT = "annonstext";

    private $path;
    private $job;
    private $content;

    public function __construct() {

        $this->path = Paths::getJobsPath();
        $this->job = new File(Paths::getJobsPath());
    }

    public function getIsMatch($key) {

        return strpos($this->content, $key) ? true : false;
    }

    public function setAddText($file) {

        $this->setJobPath($this->getJobPath($file));
        $this->setContent($this->getText());
    }

    public function setPath($path) {

        $this->path = $path;
    }

    public function setJobPath($path) {

        $this->job->setPath($path);
    }

    public function getJobPath($path) {

        return $this->path.$path;
    }

    public function setContent($content) {

        $this->content = strtolower($content);
    }

    private function getText() {

        $content = "";
        $arr = $this->job->getContentJsonDecode();

        if(isset($arr[self::ADD_TEXT])) {
            $content = $arr[self::ADD_TEXT];
        }
        return $content;
    }

}