<?php

namespace framework\components;

use framework\components\CleanRequestUrlParser;
require_once("components/CleanRequestUrlParser.php");

use framework\controllers\HomeController;
use framework\controllers\PostController;
use framework\controllers\TaggedController;
use framework\controllers\AboutController;
use framework\controllers\ContactController;
use framework\controllers\NotFoundController;

// TODO: refactor this VERY basic router
class Router extends Singleton
{
    public function routeToModuleController() {
        $explodedCleanRequestUrl = CleanRequestUrlParser::instance()->getExplodedCleanRequestUrl();
        $moduleToRun = $this->getModuleNameFromRequestUrl($explodedCleanRequestUrl);

        // intialize the correct module's controller
        $moduleController = null;
        if ($moduleToRun==='post') {
            require_once("controllers/PostController.php");
            $moduleController = new PostController(array_slice($explodedCleanRequestUrl, 0, 1));
        } else if (empty($moduleToRun) || $moduleToRun==='home') {
            require_once("controllers/HomeController.php");
            $moduleController = new HomeController(array_slice($explodedCleanRequestUrl, 0, 1));
        } else if ($moduleToRun==='about') {
            require_once("controllers/AboutController.php");
            $moduleController = new AboutController(array_slice($explodedCleanRequestUrl, 0, 1));
        } else if ($moduleToRun==='contact') {
            require_once("controllers/ContactController.php");
            $moduleController = new ContactController(array_slice($explodedCleanRequestUrl, 0, 1));
        } else if ($moduleToRun==='tagged') {
            // TODO: complete the implementation of the TaggedController
            require_once("controllers/TaggedController.php");
            $moduleController = new TaggedController(array_slice($explodedCleanRequestUrl, 0, 1));
        } else {
            require_once("controllers/NotFoundController.php");
            $moduleController = new NotFoundController(array_slice($explodedCleanRequestUrl, 0, 1));
        }
        return $moduleController;
    }

    private function getModuleNameFromRequestUrl($explodedCleanRequestUrl) {
        $moduleToRun = 'home';
        if (count($explodedCleanRequestUrl)) {
            $moduleToRun = strtolower($explodedCleanRequestUrl[0]);
        }
        return $moduleToRun;
    }

}