<?php


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
use framework\controllers\TestController;
require_once("controllers/TestController.php");

$explodedPathToModule = array_slice(CleanRequestUrlParser::instance()->getExplodedCleanRequestUrl(), 0, 4);
$testController = new TestController($explodedPathToModule);
$testController->run();