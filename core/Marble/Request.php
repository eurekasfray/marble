<?php

namespace Marble;

use Marble\Helper;

class Request
{
    private $method; // Request method
    private $path;   // the URI path

    public function __construct()
    {
    }

    public static function capture()
    {
        $request = new Request();
        $request->setMethod($_SERVER['REQUEST_METHOD']);
        $path = $_SERVER['REQUEST_URI'];
        $path = Helper::normalizePath($path);
        $request->setPath($path);
        return $request;
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
}
