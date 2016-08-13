<?php

namespace Marble;

class Hook
{
    private $controller;
    private $action;
    private $args;

    public function __construct()
    {
    }

    public static function create()
    {
        $hook = new Hook();
        return $hook;
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

    public function setArgs($args)
    {
        $this->args = $args;
    }

    public function getArgs()
    {
        return $this->args;
    }

    public function args()
    {
        return $this->getArgs();
    }
}
