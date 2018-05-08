<?php

class Filter {

    private $jobs;
    private $files;
    private $filter;

    public function __construct() {

        $this->jobs = new Folder(Paths::getJobsPath());
    }

    public function setFilter($filter) {

        $this->filter = $filter;
        switch ($filter) {
            case 'y':
                $this->jobs->setFilter(Functions::getYear());
                break;
            case 'm':
                $this->jobs->setFilter(Functions::getYearMonth());
                break;
            default:
                $this->jobs->setFilter('');
        }
    }

    public function getFilter() {

        $filter = "";
        switch ($this->filter) {
            case 'y':
                $filter = Functions::getYear();
                break;
            case 'm':
                $filter = Functions::getYearMonth();
                break;
        }
        return $filter;
    }

    public function setFiles() {

        $this->files = $this->getList();
    }
    
    public function getFiles() {

        return $this->files;
    }

    public function getCount() {

        return count($this->files);
    }

    private function getList() {

        $list = "";
        if($this->jobs->getFilter()) {
            $list = $this->jobs->getListFiltered();
        } else {
            $list = $this->jobs->getList();
        }
        return $list;
    }

}