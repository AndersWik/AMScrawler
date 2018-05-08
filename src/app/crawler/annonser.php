<?php

class Annonser {

  private $curl;

  private $headers = array(
    "Accept: application/json, text/plain, */*",
    "Accept-Encoding: gzip, deflate, br",
    "Accept-Language: sv-SE,sv;q=0.8,en-US;q=0.5,en;q=0.3",
    "Connection: keep-alive",
    "Content-Length: %content-length%",
    "Content-Type: application/json;charset=utf-8",
    "Host: www.arbetsformedlingen.se",
    "INT_SYS: platsbanken_web",
    "Referer: https://www.arbetsformedlingen.se/Tjanster/Arbetssokande/Platsbanken/",
    "User-Agent: Mozilla/5.0 (Macintosh; Intel Mac OS X 10.13; rv:57.0) Gecko/20100101 Firefox/57.0",
    "Cache-Control: max-age=0"
  );

  private $url = 'https://www.arbetsformedlingen.se/rest/pbapi/af/v1/matchning/matchandeRekryteringsbehov/';
  private $content;

  public function __construct() {

    $this->curl = Curl::getCurl();
    $this->content = ["profilkriterier" => []];
  }

  public function getHeader() {

    $this->headers[4] = "Content-Length: ".strlen(json_encode($this->content));
    return $this->headers;
  }

  public function getUrl($id) {

    return $this->url.$id;
  }

  public function getContent() {

    return $this->content;
  }

  public function getAnnons($id) {

    $this->curl->setHeader($this->getHeader());
    $this->curl->setUrl($this->getUrl($id));
    $this->curl->setContent($this->getContent());
    $this->curl->postRequest();
    return $this->curl->getResult();
  }

}
