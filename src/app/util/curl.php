<?php

class Curl {

  private static $curl;

  private $header;
  private $url;
  private $result;
  private $content;
  private $cookiefile;

  public static function getCurl() {

    if($curl === null) {
      self::$curl = new Curl();
    }
    return self::$curl;
  }

  private function __construct() {
    $this->cookiefile = Paths::getCookiePath();
  }

  public function getRequest() {
    // Tell cURL what url to get from
    $this->ch = curl_init($this->url);
    //
    curl_setopt($this->ch, CURLINFO_HEADER_OUT, true);
    //
    curl_setopt($this->ch, CURLOPT_VERBOSE, false);
    //Tell cURL that we want to send a GET request.
    curl_setopt($this->ch, CURLOPT_POST, 0);
    // Write cookies to file
    curl_setopt($this->ch, CURLOPT_COOKIEJAR, $this->cookiefile);
    // Read cookies from file
    curl_setopt($this->ch, CURLOPT_COOKIEFILE, $this->cookiefile);
    //
    curl_setopt($this->ch, CURLOPT_HEADER, 1);
    // Set array to headers
    curl_setopt($this->ch, CURLOPT_HTTPHEADER, $this->header);
    // Print return to String
    curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, TRUE);
    // Fix encoding issue
    curl_setopt($this->ch, CURLOPT_ENCODING, '');
    // Execute the request
    $this->result = curl_exec($this->ch);
    // Closing curl
    curl_close($this->ch);
  }

  public function postRequest() {
    // json encode content before adding to post
    $data = json_encode($this->content);
    // Tell cURL what url to post to
    $this->ch = curl_init($this->url);
    // Tell cURL that we want to send a POST request.
    curl_setopt($this->ch, CURLOPT_CUSTOMREQUEST, "POST");
    //
    curl_setopt($this->ch, CURLOPT_POSTFIELDS, $data);
    // Write cookies to file
    curl_setopt($this->ch, CURLOPT_COOKIEJAR, $this->cookiefile);
    // Read cookies from file
    curl_setopt($this->ch, CURLOPT_COOKIEFILE, $this->cookiefile);
    // Set array to headers
    curl_setopt($this->ch, CURLOPT_HTTPHEADER, $this->header);
    // Print return to String
    curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, true);
    // Fix encoding issue
    curl_setopt($this->ch, CURLOPT_ENCODING, '');
    // Execute the request
    $this->result = curl_exec($this->ch);
    // Closing curl
    curl_close($this->ch);
  }

  public function setHeader($header) {

    $this->header = $header;
  }

  public function setUrl($url) {

    $this->url = $url;
  }

  public function setContent($content) {

    return $this->content = $content;
  }

  public function getResult() {

    return $this->result;
  }

}
