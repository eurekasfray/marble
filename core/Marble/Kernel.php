<?php

namespace Marble;

use Marble\Request;
use Marble\Router;
use Marble\Hook;

// The Kernel resolves the controller

class Kernel
{
    // Handle request
    public static function handle(Request $request)
    {
        $hook = Router::parseRequest($request->path(), $request->method());
        if ($hook === null) {
            trigger_error('Marble: Error: Couldn\'t find route by request "' . $request->method() . ' ' . $request->path() . '".', E_USER_ERROR);
        }
        $response = self::dispatch($hook);
        return $response;
    }

    // Dispatch the hook
    private static function dispatch(Hook $hook)
    {
        $class = $hook->getController();
        $instance = new $class();
        if (method_exists($instance, $hook->action())) {
            $response = call_user_func_array( array($instance, $hook->action()), $hook->args() );
        }
        else {
            trigger_error('Marble: Error: Method "' . $hook->controller . '::' . $hook->action . '".', E_USER_ERROR);
        }
        return $response;
    }
}
