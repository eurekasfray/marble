<?php

spl_autoload_register(function($class) {
    // Normalize class path
    $class = preg_replace('{/|\\\}', DS, $class);

    // Load class from core
    if (file_exists($path = CORE_DIR . DS . $class . '.php')) {
        require_once($path);
    }
    // Load class from controller directory
    else if (file_exists($path = APP_CONTROLLER_DIR . DS . $class . '.php')) {
        require_once($path);
    }
    // Load class from model directory
    else if (file_exists($path = APP_MODEL_DIR . DS . $class . '.php')) {
        require_once($path);
    }
    // Load class from helper directory
    else if (file_exists($path = APP_HELPER_DIR . DS . $class . '.php')) {
        require_once($path);
    }
    // Load class from plugin directory
    else if (file_exists($path = APP_PLUGIN_DIR . DS . $class . '.php')) {
        require_once($path);
    }
    // Report missing class file
    else {
        trigger_error('Marble: Error: The autoload could not find class "' . $class . '".', E_USER_ERROR);
    }
});
