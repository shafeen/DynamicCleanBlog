<?php

require_once("config/config.php");

/*
 * This is the main application FrontController
 *
 * The first parameter decides which module's FrontController to call.
 * From there, the module's FrontController dispatches to individual
 * page Controllers.
 *
 */

use framework\components\CleanRequestUrlParser;
require_once("components/CleanRequestUrlParser.php");
use framework\components\Router;
require_once("components/Router.php");

// figure out what module to run
// and run that module's controller
/** @var Router $router */
$router = Router::instance();
$moduleController = $router->routeToModuleController();
$moduleController->run();