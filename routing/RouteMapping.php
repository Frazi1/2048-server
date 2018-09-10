<?php
class RouteMapping {
    public $route;
    public $handler;

    public function __construct(Route $route, RequestHandler $handler = null)
    {
        $this->route = $route;
        if($handler != null) {
            $this->handler = $handler;
        } else {
            $this->handler = new RequestHandler;
        }

    }
}