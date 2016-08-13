<?php

namespace Marble;

use Marble\Route;
use Marble\RouteTable;
use Marble\Helper;
use Marble\Config;
use Marble\Response;

// The router parses the URL, and gets the class, function, and arguments.

class Router
{

    public static function parseRequest($path, $method)
    {
        $hook = self::find($path, $method);
        return $hook;
    }

    // Find controller
    public static function find($path, $method)
    {
        // Get routes
        $routeTable = RouteTable::getInstance();
        $routes = $routeTable->all();

        // Let's search each route for a match
        foreach ($routes as $i=>$route) {
            // If requests don't match, ...
            if (strtolower($route->method()) == strtolower($method)) {
                // Do routes match?
                if (self::match($path, $route->path())) {
                    $hook = Hook::create();
                    $hook->setController($route->getController());
                    $hook->setAction($route->getAction());
                    $hook->setArgs(self::getArgs($path, $route->path()));
                    return $hook;
                }
            }
        }

        // No matches were found
        return null;
    }

    public static function match($requestPath, $routePath)
    {
        // Split paths into parts
        $requestParts = explode('/', $requestPath);
        $routeParts = explode('/', $routePath);

        // If the parts are inequal in their count, there's no match
        if (count($requestParts) != count($routeParts)) {
            return false;
        }

        // Do paths match? The part for a request and route match if either
        // both parts are equal strings or the route part is a placeholder.
        foreach ($routeParts as $i=>$routePart) {
            echo $routePart . "<br/>";
            echo $requestParts[$i] . "<br/>";
            if (strtolower($routePart) != strtolower($requestParts[$i])) {
                if (!self::isPlaceholder($routePart)) {
                    return false;
                }
            }
        }

        // It's a match!
        return true;
    }

    private static function getArgs($requestPath, $routePath)
    {
        $requestParts = explode('/', $requestPath);
        $routeParts = explode('/', $routePath);

        $args = array();
        foreach ($routeParts as $i=>$routePart) {
            if (self::isPlaceholder($routePart)) {
                $argName = self::extractIdentifier($routePart);
                $argValue = $requestParts[$i];
                $args[$argName] = $argValue;
            }
        }
        return $args;
    }

    // Utility: Is subject a valid placeholder?

    private static function isPlaceholder($subject)
    {
        $syntax = '/^:[A-Za-z_][A-Za-z0-9_]*$/';

        if (preg_match($syntax, $subject)) {
            return true;
        }
        else {
            return false;
        }
    }

    // Utility: Extract placeholder identifier from placeholder string.

    private static function extractIdentifier($placeholder)
    {
        $identifier = substr($placeholder, 1);
        return $identifier;
    }

    public static function get($path, $controller, $action)
    {
        $result = self::processRoute('GET', $path, $controller, $action);
        return $result;
    }

    public static function post($path, $controller, $action)
    {
        $result = self::processRoute('POST', $path, $controller, $action);
        return $result;
    }

    public static function put($path, $controller, $action)
    {
        $result = self::processRoute('PUT', $path, $controller, $action);
        return $result;
    }

    public static function delete($path, $controller, $action)
    {
        $result = self::processRoute('DELETE', $path, $controller, $action);
        return $result;
    }

    private static function processRoute($method, $path, $controller, $action)
    {
        $routeTable = RouteTable::getInstance();
        $path = Helper::normalizePath($path);
        $route = self::generateRoute($method, $path, $controller, $action);
        if ($route === null) {
            return false;
        }
        else {
            $routeTable->add($route);
            return true;
        }
    }

    private static function generateRoute($method, $path, $controller, $action)
    {
        return Route::create($method, $path, $controller, $action);
    }

    // Parses path and extracts controller, action and parameters.
    //
    // @return array|false Returns an array with the controller, action,
    // and parameters on valid parse. Otherwise, false is return.

    private static function parsePath($path)
    {
        // Normalize path
        $path = Helper::normalizePath($path);
        $parts = explode('/', $path);

        // If controller isn't specified
        if (empty($parts[0])) {
            $parts[0] = "";
        }

        // Load config
        $config = Config::getInstance();

        // If action isn't specified
        if (!isset($parts[1]) && empty($parts[1])) {
            $parts[1] = $config->get('default_action');
        }

        // Get controller and action
        $route = [];
        $route['controller'] = $parts[0];
        $route['action'] = $parts[1];

        // Store parameter identifiers
        $param = [];
        if (count($parts) > 2) {
            $param = array_splice($parts, 2);
        }
        $route['param'] = $param;

        // Be free little birdy
        return $route;
    }

    // $routes accessor. Adds route to $routes array.

    private static function addRoute(Route $route)
    {
        self::$routes[] = $route;
    }

    private static function getRoutes()
    {
        return self::$routes;
    }

    // Generate url

    public static function url()
    {
    }
}
