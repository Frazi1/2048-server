<?php
class Route {
    public $url;
    public $method;
    public $callback;

    public function __construct($url, $method, $callback = null)
    {
        $this->url = $url;
        $this->method = $method;
        if($callback) {
            $this->callback = $callback;
        } else {
            $this->callback = function() use($url, $method) {
                echo "call $url - $method callback";
            };
        }

    }
}