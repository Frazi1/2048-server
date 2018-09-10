<?php
class Route {
    public $url;
    public $method;

    public function __construct($url, $method)
    {
        $this->url = $url;
        $this->method = $method;
    }
}