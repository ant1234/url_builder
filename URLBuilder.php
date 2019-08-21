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

    // Query index exists but isn't an array, so throw exception
    if(array_key_exists('query', $params) && !is_array($params['query'])) {

      throw new Exception('Sorry, if query index is specified it needs to be an array');

    }

    // Host is specified so set the default values
    if ((isset($params['host']) && $params['host'] != null)) {

        $this->host =     $params['host'];
        $this->scheme =   (isset($params['scheme']) && $params['scheme'] != null) ? $params['scheme'] : 'http';
        $this->user =     (isset($params['user']) && $params['user'] != null) ? $params['user'] : null;
        $this->pass =     (isset($params['pass']) && $params['pass'] != null) ? $params['pass'] : null;
        $this->port =     (isset($params['port']) && $params['port'] != null) ? $params['port'] : 80;
        $this->path =     (isset($params['path']) && $params['path'] != null) ? $params['path'] : '/';
        $this->fragment = (isset($params['fragment']) && $params['fragment'] != '') ? '#' . $params['fragment'] : null;
        $this->query =    (isset($params['query']) && $params['query'] != null) ? $params['query'] : [];

    } else {

      throw new Exception('Sorry, host is a required index and needs to be specified');

    }

  }

  //
  // Return the built url in a string
  //
  function build() {

    // If username, password or port aren't specified, they must not be shown
    $userInfo = ($this->user && $this->pass) ? $this->user .':'. $this->pass . '@' : '';
    $port = ($this->port == 80 || $this->port == '') ? '' : ':'.$this->port;

    $constructed_url =  (string)  $this->scheme .'://' .
                                  $userInfo .
                                  $this->host .
                                  $port .
                                  $this->path .
                                  implode($this->query) .
                                  $this->fragment;

    return $constructed_url;
  }

}

$params = array(
                  'host' => 'blah.com',
                  'user' => 'ant',
                  'pass' => 'admin',
                  'port' => 8080,
                  'query' => ['?arg=val'],
                  'path' => '/about',
                  'fragment' => 'anchor'
          );

$built_url = new URLBuilder($params);

echo $built_url->build();

