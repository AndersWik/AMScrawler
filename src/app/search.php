<?php

class Search {

    private $config;
    private $filter;
    private $jobs;
    private $keys;
    private $log;
    private $groups;
    private $template;
    
    public function __construct() {

        $this->config = new File(Paths::getKeysPath());
        $this->filter = new Filter();
        $this->jobs = new Jobs();
        $this->log = Log::getLog();
        $this->groups = new File(Paths::getGroupsPath());
        $this->template = new Template();
    }

    public function run($filter = "") {

        $this->filter->setFilter($filter);
        $this->filter->setFiles();
        $this->keys = $this->config->getContentJsonDecode();
        $this->searchKeys();

        $this->template->setKeys($this->keys);
        $this->template->setJobCount($this->filter->getCount());
        $this->template->setTemplate("ams.phtml");

        $prefix = $this->filter->getFilter();
        $this->groups->setPath(Paths::getGroupPath($prefix."-ams.html"));
        $this->groups->writeToFile($this->template->getHtml());
        $this->groups->setPath(Paths::getGroupPath($prefix."-data.json"));
        $this->groups->writeToFile($this->getKeysAsJson());
        $this->groups->setPath(Paths::getGroupPath($prefix."-data.xml"));
        $this->groups->writeToFile($this->getKeysAsXML());
    }


    private function getKeysAsJson() {

        return json_encode($this->keys);
    }

    private function getKeysAsXML() {

        $xml = new SimpleXMLElement('<root/>');
        foreach ($this->keys as $key => $value) {

            $keys = $xml->addChild('keys');
            $keys->addChild('key', str_replace(".net", "dotnet", trim($key)));
            $keys->addChild('count', $value["count"]);

            if(isset($value["alias"]) && is_array($value["alias"])) {
                $alias = $keys->addChild('aliases');
                foreach ($value["alias"] as $key2 => $value2) {

                    $alias->addChild('alias', str_replace(".net", "dotnet", trim($value2)));
                }
            }

            if(isset($value["frequently-with"]) && is_array($value["frequently-with"])) {
                $frequently = $keys->addChild('frequently-with');
                foreach ($value["frequently-with"] as $key3 => $value3) {

                    $frequently->addChild(str_replace(".net", "dotnet", trim($key3)), $value3);
                }
            }
        }
        return $xml->asXML();
    }

    private function searchKeys() {

        $files = $this->filter->getFiles();

        if(is_array($files)) {
            for($i = 0; $i < count($files); $i++) {
                if (strpos($files[$i], '.json') !== false) {
                    $this->log ->printLog("{$i}  {$files[$i]}");
                    $this->jobs->setAddText($files[$i]);
                    $matches = $this->setMatches();
                    $this->setFrequentlyWith($matches);
                }
            }
        }
    }

    private function setMatches() {

        $matches = [];
        if(is_array($this->keys)) {
            foreach($this->keys as $key => $value) {

                $matched = $this->jobs->getIsMatch($key);
    
                if(!$matched && isset($this->keys[$key]['alias'])) {
    
                    foreach($this->keys[$key]['alias'] as $key2 => $alias) {
    
                        $matched = $this->jobs->getIsMatch($alias);
                        if($matched) {
                            break;
                        }
                    }
                }
                if($matched) {
                    $matches[] = $key;
                    $this->keys[$key]['count'] = $this->keys[$key]['count']+1;
                }
            }
        }
        return $matches;
    }

    private function setFrequentlyWith($matches) {

        array_unique($matches);

        foreach($matches as $value) {

            if(!isset($this->keys[$value]['frequently-with'])) {

                $this->keys[$value]['frequently-with'] = array();
            }

            foreach($matches as $value2) {

                if($value !== $value2) {

                    if(isset($this->keys[$value]['frequently-with'][$value2])) {

                        $this->keys[$value]['frequently-with'][$value2] = $this->keys[$value]['frequently-with'][$value2]+1;
                    } else {

                        $this->keys[$value]['frequently-with'][$value2] = 1;
                    }
                }
            }
        }
    }

}