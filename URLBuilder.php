<?php

class URLBuilder
{
  private $scheme;
  private $user;
  private $pass;
  private $host;
  private $port;
  private $path;
  private $query;
  private $fragment;

  public function __construct($params) {

    if (is_array($params) && isset($params['host'])) {

        $this->scheme = isset($params['scheme']) ? $params['scheme'] : 'http';
        $this->user = isset($params['user']) ? $params['user'] : '';
        $this->pass = isset($params['pass']) ? ':' . $params['pass'] : '';
        $this->host = $params['host'];
        $this->port = isset($params['port']) ? $params['port'] : 80;
        $this->path = isset($params['path']) ? $params['path'] : '/';
        $this->query = isset($params['query']) ? $params['query'] : [];
        $this->fragment = isset($params['fragment']) ? '#' . $params['fragment'] : '';

    } else {

        throw new Exception('Some fields not formatted correctly');
    }

  }

  function build() {

    $pass = ($this->user || $this->pass) ? $this->pass . '@' : '';

    $constructed_url =  (string)  $this->scheme .'://' .
                                  $this->user .
                                  $pass .
                                  $this->host .
                                  ':' . $this->port .
                                  $this->path .
                                  implode($this->query) .
                                  $this->fragment;

    return $constructed_url;
  }

}

$params = array(
                  'host' => 'blah.com',

          );

$built_url = new URLBuilder($params);

var_dump($built_url->build());

