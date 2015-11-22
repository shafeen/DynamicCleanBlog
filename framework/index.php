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
use framework\controllers\PostController;
require_once("controllers/PostController.php");
use framework\controllers\HomeController;
require_once("controllers/HomeController.php");


// figure out what module to run here:
$moduleToRun = CleanRequestUrlParser::instance()->getExplodedCleanRequestUrl()[0];
if (strtolower($moduleToRun)==='post') {
    $postController = new PostController(array_slice(CleanRequestUrlParser::instance()->getExplodedCleanRequestUrl(), 0, 1));
    $postController->run();
} else if (empty($moduleToRun) || strtolower($moduleToRun)==='home') {
    $homeController = new HomeController(array_slice(CleanRequestUrlParser::instance()->getExplodedCleanRequestUrl(), 0, 1));
    $homeController->run();
} else {
    $explodedPathToModule = array_slice(CleanRequestUrlParser::instance()->getExplodedCleanRequestUrl(), 0, 4);
    $testController = new TestController($explodedPathToModule);
    $testController->run();
}

