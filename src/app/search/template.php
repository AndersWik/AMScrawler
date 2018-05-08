<?php

class Template {

    private $keys;
    private $jobcount;
    private $template;
    private $log;

    public function setKeys($keys) {

        $this->keys = $keys;
        $this->log = Log::getLog();
    }

    public function setJobCount($jobcount) {

        $this->jobcount = $jobcount;
    }

    public function setTemplate($template) {

        $this->template = $template;
    }

    public function getHtml() {

        $html = "";
        $path = Paths::getTemplatePath($this->template);

        if(is_file($path)) {
            try {
                ob_start();
                include $path;
                $html = ob_get_clean(); 
            }
            catch(Exception $e) {
                $error = "Template include failed: ".$e->getCode();
                $this->log->printLog($error);
                $this->log->printLogToFile($error);
            }
        }
        return $html;
    }
}