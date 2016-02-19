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
use framework\controllers\NotFoundController;
require_once("controllers/NotFoundController.php");
use framework\controllers\TaggedController;
require_once("controllers/TaggedController.php");
use framework\controllers\PostController;
require_once("controllers/PostController.php");
use framework\controllers\HomeController;
require_once("controllers/HomeController.php");
use framework\controllers\AboutController;
require_once("controllers/AboutController.php");
use framework\controllers\ContactController;
require_once("controllers/ContactController.php");
//use framework\controllers\TestController;
//require_once("controllers/TestController.php");


// figure out what module to run:
$moduleToRun = 'home';
if (count(CleanRequestUrlParser::instance()->getExplodedCleanRequestUrl())) {
    $moduleToRun = strtolower(CleanRequestUrlParser::instance()->getExplodedCleanRequestUrl()[0]);
}

// run the module's controller
$moduleController = null;
if ($moduleToRun==='post') {
    $moduleController = new PostController(array_slice(CleanRequestUrlParser::instance()->getExplodedCleanRequestUrl(), 0, 1));
} else if (empty($moduleToRun) || $moduleToRun==='home') {
    $moduleController = new HomeController(array_slice(CleanRequestUrlParser::instance()->getExplodedCleanRequestUrl(), 0, 1));
} else if ($moduleToRun==='about') {
    $moduleController = new AboutController(array_slice(CleanRequestUrlParser::instance()->getExplodedCleanRequestUrl(), 0, 1));
} else if ($moduleToRun==='contact') {
    $moduleController = new ContactController(array_slice(CleanRequestUrlParser::instance()->getExplodedCleanRequestUrl(), 0, 1));
} else if ($moduleToRun==='tagged') {
    // TODO: complete the implementation of the TaggedController
    $moduleController = new TaggedController(array_slice(CleanRequestUrlParser::instance()->getExplodedCleanRequestUrl(), 0, 1));
} else {
    $moduleController = new NotFoundController(array_slice(CleanRequestUrlParser::instance()->getExplodedCleanRequestUrl(), 0, 1));
}
$moduleController->run();