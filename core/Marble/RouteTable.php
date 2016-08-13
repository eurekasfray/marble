<?php

namespace Marble;

use Marble\Route;

class RouteTable
{
    private static $instance;
    private $routes = array();

    private function __construct()
    {
    }

    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new RouteTable();
        }
        return self::$instance;
    }

    public function add(Route $route)
    {
        $this->routes[] = $route;
    }

    public function all()
    {
        return $this->routes;
    }
}
