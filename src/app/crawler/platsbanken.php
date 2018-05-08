<?php

class Platsbanken {

  private $curl;

  private $headers = array(
    "Accept: text/html,application/xhtml+xm…plication/xml;q=0.9,*/*;q=0.8",
    "Accept-Encoding: gzip, deflate, br",
    "Accept-Language: sv-SE,sv;q=0.8,en-US;q=0.5,en;q=0.3",
    "Connection: keep-alive",
    "Host: www.arbetsformedlingen.se",
    "Upgrade-Insecure-Requests: 1",
    "User-Agent: Mozilla/5.0 (Macintosh; Intel Mac OS X 10.13; rv:57.0) Gecko/20100101 Firefox/57.0"
  );

  private $url = "https://www.arbetsformedlingen.se/Tjanster/Arbetssokande/Platsbanken/";

  public function __construct() {

    $this->curl = Curl::getCurl();
  }

  public function getHeader() {

    return $this->headers;
  }

  public function getUrl() {

    return $this->url;
  }

  public function getPlatsbanken() {

    $this->curl->setHeader($this->getHeader());
    $this->curl->setUrl($this->getUrl());
    $this->curl->getRequest();
    return $this->curl->getResult();
  }

}
