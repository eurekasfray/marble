<?php

namespace Marble;

class Route
{
    private $method;
    private $path;
    private $controller;
    private $action;

    public function __construct($method, $path, $controller, $action)
    {
        $this->setMethod($method);
        $this->setPath($path);
        $this->setController($controller);
        $this->setAction($action);
    }

    public static function create($method, $path, $controller, $action)
    {
        return new Route($method, $path, $controller, $action);
    }

    public function setMethod($method)
    {
        $this->method = $method;
    }

    public function getMethod()
    {
        return $this->method;
    }

    public function method()
    {
        return $this->getMethod();
    }

    public function setPath($path)
    {
        $this->path = $path;
    }

    public function getPath()
    {
        return $this->path;
    }

    public function path()
    {
        return $this->getPath();
    }

    public function setController($controller)
    {
        $this->controller = $controller;
    }

    public function getController()
    {
        return $this->controller;
    }

    public function controller()
    {
        return $this->getController();
    }

    public function setAction($action)
    {
        $this->action = $action;
    }

    public function getAction()
    {
        return $this->action;
    }

    public function action()
    {
        return $this->getAction();
    }
}
