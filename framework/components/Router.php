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
    // when adding a new module route -->
    // add the module name to Controller here in this array
    // TODO: need a way to verify expected url format for a controller in the Router
    // modulename => array(ModuleControllerName, RegexForURL)
    private $moduleToControllerMap = array(
        'home'    => array('HomeController',     '/(^\/?home\/page\/[0-9]+\/?$)|(^\/?home\/?$)|(^\/?$)/'),
        'post'    => array('PostController',     '/^\/?post\/[0-9]{4}-[0-9]{2}-[0-9]{2}\/(.*)/'),
        'about'   => array('AboutController',    '/^\/?about\/?$/'),
        'contact' => array('ContactController',  '/^\/?contact\/?$/'),
        'tagged'  => array('TaggedController',   '/^\/?tagged\/tags\/[a-zA-Z]+(:[a-zA-Z]+)*(\/|(\/page\/[0-9]+\/?))?$/'),
        'notfound'=> array('NotFoundController', '(.*)') // no regex match needed or used
    );

    public function routeToModuleController() {
        $explodedCleanRequestUrl = CleanRequestUrlParser::instance()->getExplodedCleanRequestUrl();
        $cleanRequestUrl = CleanRequestUrlParser::instance()->getCleanRequestUrl();
        $moduleToRun = $this->getModuleNameFromRequestUrl($explodedCleanRequestUrl);

        // return the correct intialized module's controller
        $controllerUrlRegex = $this->moduleToControllerMap[$moduleToRun][1];
        $controllerName = $this->moduleToControllerMap[$moduleToRun][0];
        $defaultControllerName = $this->moduleToControllerMap['notfound'][0];
        if (!preg_match($controllerUrlRegex, $cleanRequestUrl)) {
            $controllerName = $defaultControllerName;
        }

        require_once('controllers/'.$controllerName.'.php');
        $fullyQualifiedControllerName = 'framework\\controllers\\'.$controllerName;
        return new $fullyQualifiedControllerName(array_slice($explodedCleanRequestUrl, 0, 1));
    }

    private function getModuleNameFromRequestUrl($explodedCleanRequestUrl) {
        $moduleToRun = 'home';
        if (count($explodedCleanRequestUrl)) {
            $moduleNameFromUrl = strtolower($explodedCleanRequestUrl[0]);
            if (array_key_exists($moduleNameFromUrl, $this->moduleToControllerMap)) {
                $moduleToRun = $moduleNameFromUrl;
            } else {
                $moduleToRun = 'notfound';
            }
        }
        return $moduleToRun;
    }

}