<?php
class HttpRequest
{
    public $route;
    public $queryParams;
    public $body;

    public function __construct($url, $method, $queryParams, $body)
    {
        $this->route = new Route($url, $method);
        $this->queryParams = $this->extractQueryParams($queryParams);;
    }

    private function extractQueryParams($queryParamsString)
    {
        $paramsString = explode("&", substr($url, $paramsStartIndex));
        var_dump($paramsString);
    }
}
