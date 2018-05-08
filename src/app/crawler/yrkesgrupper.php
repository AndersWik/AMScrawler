<?php

class Yrkesgrupper {

  private $curl;

  private $headers = array(
    "Host: www.arbetsformedlingen.se",
    "User-Agent: Mozilla/5.0 (Macintosh; Intel Mac OS X 10.13; rv:57.0) Gecko/20100101 Firefox/57.0",
    "Accept: application/json, text/plain, */*",
    "Accept-Language: sv-SE,sv;q=0.8,en-US;q=0.5,en;q=0.3",
    "Accept-Encoding: gzip, deflate, br",
    "Referer: https://www.arbetsformedlingen.se/Tjanster/Arbetssokande/Platsbanken/",
    "INT_SYS: platsbanken_web",
    "Connection: keep-alive"
  );

  private $url = "https://www.arbetsformedlingen.se/rest/matchning/rest/af/v1/matchning/matchningskriterier/yrkesomraden";

  public function __construct() {

    $this->curl = Curl::getCurl();
  }

  public function getHeader() {

    return $this->headers;
  }

  public function getUrl() {

    return $this->url;
  }

  public function getYrkesgrupper() {

    $this->curl->setHeader($this->getHeader());
    $this->curl->setUrl($this->getUrl());
    $this->curl->getRequest();
    return $this->curl->getResult();
  }

}
