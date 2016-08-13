<?php

namespace Marble;

class Config 
{
    public $config = [];
    private static $instance;
    
    private function __construct()
    {
    }   
    
    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new Config();
        }
        return self::$instance;
    }
    
    public function load($path)
    {
        $this->config = (require($path));
    }
    
    public function set($name, $value)
    {
        if ($this->has($name)) {
            $this->config[$name] = $value;
            return true;
        }
        return false;
    }
    
    public function get($name)
    {
        if ($this->has($name)) {
            return $this->config[$name];
        }
        return false;
    }
    
    public function has($name)
    {
        if (array_key_exists($name, $this->config)) {
            return true;
        }
        return false;
    }
}