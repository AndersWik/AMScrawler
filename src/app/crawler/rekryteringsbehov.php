<?php

class Rekryteringsbehov {

  private $headers = array(
    "Accept: application/json, text/plain, */*",
    "Accept-Encoding: gzip, deflate, br",
    "Accept-Language: sv-SE,sv;q=0.8,en-US;q=0.5,en;q=0.3",
    "Connection: keep-alive",
    "Content-Length: %content-length%",
    "Content-Type: application/json;charset=utf-8",
    "Cookie:",
    "Host: www.arbetsformedlingen.se",
    "INT_SYS: platsbanken_web",
    "Referer: https://www.arbetsformedlingen.se/Tjanster/Arbetssokande/Platsbanken/",
    "Requesting-Device-Id:",
    "User-Agent: Mozilla/5.0 (Macintosh; Intel Mac OS X 10.13; rv:57.0) Gecko/20100101 Firefox/57.0"
  );

  private $url = 'https://www.arbetsformedlingen.se/rest/pbapi/af/v1/matchning/matchandeRekryteringsbehov';

  private $content = [ "startrad" => "0",
  "maxAntal" => "25",
  "sorteringsordning" => "RELEVANS",
  "franPubliceringsdatum" => "",
  "matchningsprofil" => [
    "profilkriterier" => [
      0 => [
        "typ" => "YRKESOMRADE_ROLL",
        "varde" => "3",
        "namn" => "Data/IT"
      ]
    ]
  ]
];

  private $counter = 0;
  private $limit;
  private $size = 25;
  private $curl;

  public function __construct() {

    $this->curl = Curl::getCurl();
  }

  public function getContent() {

    $this->content['startrad'] = $this->counter;
    return $this->content;
  }

  public function getHeader() {

    $this->headers[4] = "Content-Length: ".strlen(json_encode($this->content));
    return $this->headers;
  }

  public function getUrl() {

    return $this->url;
  }

  public function setLimit($limit) {

    if($this->limit === null && is_numeric($limit)) {
      $this->limit = intval($limit);
    }
  }

  public function getLimit() {

    return $this->limit;
  }

  public function setCounter() {

    $this->counter = $this->counter+25;
  }

  public function getCounter() {

    return $this->counter;
  }

  public function isMoreRekryteringsbehov() {

    return $this->counter < $this->limit;
  }

  public function getRekryteringsbehov() {

    $this->curl->setContent($this->getContent());
    $this->curl->setHeader($this->getHeader());
    $this->curl->setUrl($this->getUrl());
    $this->curl->postRequest();
    return $this->curl->getResult();
  }

}
