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
    private $moduleToControllerMap = array(
        'home'    => 'HomeController',
        'post'    => 'PostController',
        'about'   => 'AboutController',
        'contact' => 'ContactController',
        'tagged'  => 'TaggedController',
        'notfound'=> 'NotFoundController'
    );

    public function routeToModuleController() {
        $explodedCleanRequestUrl = CleanRequestUrlParser::instance()->getExplodedCleanRequestUrl();
        $moduleToRun = $this->getModuleNameFromRequestUrl($explodedCleanRequestUrl);

        // return the correct intialized module's controller
        $controllerName = $this->moduleToControllerMap[$moduleToRun];
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