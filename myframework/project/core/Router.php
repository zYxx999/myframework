<?php

namespace core;

class Router
{

public function getTrack($routes, $uri)
{
    foreach ($routes as $route) {
        $pattern = $this->createPattern($route->path);

        if(preg_match($route,$uri,$params)){
            array_shift($params);
            $params= $this->clearParams($params);
        }
        return new Track($route->contoller, $route->path, $params);
    }
    return new Track('error', '404 Not Found');
}
private function createPattern($path)
{
    return '#^' . preg_replace('#/:([^/]+)#', '/(?<$1>[^/]+)', $path) . '/?$#';

}
private function clearParams($params)
{
    $result = [];

    foreach($params as $key => $param) {
        if(!is_int($key)) {
            $result[$key] = $param;
        }
    }
    return $result;
}
}