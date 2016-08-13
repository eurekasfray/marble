<?php

// The front controller

// Make life easy
use Marble\Config;
use Marble\Kernel;
use Marble\Request;

if (phpversion() < 5.4) {
    echo "<h3>Marble requires PHP/5.4 or greater.</h3>";
    echo "<p>You're currently running PHP/" . phpversion() . ".</p>";
    die();
}
else {
    // Start sessions
    if (session_id() === "") {
        session_start();
    }

    // Paths
    define ('DS', DIRECTORY_SEPARATOR);
    define ('ENV_PATH', realpath(dirname('..\..')));
    define ('APP_DIR', ENV_PATH . DS . 'app');
    define ('APP_CONFIG_DIR', APP_DIR . DS . 'config');
    define ('APP_MODEL_DIR', APP_DIR . DS . 'model');
    define ('APP_VIEW_DIR', APP_DIR . DS . 'view');
    define ('APP_CONTROLLER_DIR', APP_DIR . DS . 'controller');
    define ('APP_HELPER_DIR', APP_DIR . DS . 'helper');
    define ('APP_PLUGIN_DIR', APP_DIR . DS . 'plugin');
    define ('BOOTSTRAP_DIR', ENV_PATH . DS . 'bootstrap');
    define ('CORE_DIR', ENV_PATH . DS . 'core');

    // Bootstrap framework
    require BOOTSTRAP_DIR . DS . 'autoload.php';

    // Set routes
    require APP_CONFIG_DIR . DS . 'route.php';

    // Run app
    $config = Config::getInstance();
    $config->load(APP_CONFIG_DIR . DS . 'config.php');
    $request = Request::capture();
    $response = Kernel::handle($request);
    $response->send();

    // Close session
    session_write_close();
}
