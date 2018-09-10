<?php 
class Router {
    private $routes = [];

    public function handleReq(HttpRequest $req)
    {
        $url = $req->route->url;
        $method = $req->route->method;
        $mappings = array_filter($this->routes, function ($mapping) use ($url, $method) {
            return $mapping->route->url === $url && $mapping->route->method === $method;
        });
        if($mappings) {
            $mapping = array_shift($mappings);
            return $mapping->handler->handleReq($req);
        } else {
            echo "not found route";
        }
    }

    public function addMapping($routeMapping)
    {
        // var_dump($routeMapping);
        array_push($this->routes, $routeMapping);
        // echo var_dump($this->routes);
    }
}