<?php
class HttpRequest
{
    public $route;
    public $queryParams;

    public function __construct(Route $route, Array $queryParams = null)
    {
        $this->route = $route;
        $this->queryParams = $queryParams;
    }
}
