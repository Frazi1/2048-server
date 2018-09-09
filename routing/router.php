<?php 
class Router {
    private $routes = [];

    public function handleReq($url, $method)
    {
        $route = array_filter($this->routes, function ($r) use ($url, $method) {
            return $r->url === $url && $r->method === $method;
        });
        if($route) {
            $route[0]->callback->__invoke();
        } else {
            echo "not found route";
        }
    }

    public function addRoute($route)
    {
        // var_dump($route);
        array_push($this->routes, $route);
        // echo var_dump($this->routes);
    }
}