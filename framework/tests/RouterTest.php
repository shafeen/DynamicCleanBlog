<?php

namespace framework\tests;

use framework\components\CleanRequestUrlParser;
use framework\components\Router;
use PHPUnit_Framework_TestCase;

class RouterTest extends PHPUnit_Framework_TestCase
{
    protected function setUp() {
        $this->initRootDir();
        $this->initRequired();
        Router::resetInstances();
    }

    protected function initRootDir() {
        // before testing -> 'framework/' should be the root directory
        if (substr(getcwd(), -9) != 'framework') {
            chdir('..');
            $this->assertEquals(substr(getcwd(), -9), 'framework');
        }
    }

    protected function initRequired() {
        require_once('components/CleanRequestUrlParser.php');
        require_once('components/Router.php');
    }

    // TODO: complete this unit test class --> CORRECTLY

    public function test_routeToHomeController() {
        $_SERVER['REQUEST_METHOD'] = 'GET';
        $_SERVER['REQUEST_URI'] = '/home/page/1';

        /** @var Router $router */
        $router = Router::instance();
        $moduleController = $router->routeToModuleController();
        $this->assertEquals('framework\controllers\HomeController', get_class($moduleController));
    }

    public function test_routeToContactController() {
        $_SERVER['REQUEST_METHOD'] = 'GET';
        $_SERVER['REQUEST_URI'] = '/contact';

        /** @var Router $router */
        $router = Router::instance();
        $moduleController = $router->routeToModuleController();
        $this->assertEquals('framework\controllers\ContactController', get_class($moduleController));
    }

    public function test_routeToAboutController() {
        $_SERVER['REQUEST_METHOD'] = 'GET';
        $_SERVER['REQUEST_URI'] = '/about';

        /** @var Router $router */
        $router = Router::instance();
        $moduleController = $router->routeToModuleController();
        $this->assertEquals('framework\controllers\AboutController', get_class($moduleController));
    }

    public function test_routeToPostController() {
        $_SERVER['REQUEST_METHOD'] = 'GET';
        $_SERVER['REQUEST_URI'] = '/post/1989-05-24/Man-must-explore-and-this-is-exploration-at-its-greatest';

        /** @var Router $router */
        $router = Router::instance();
        $moduleController = $router->routeToModuleController();
        $this->assertEquals('framework\controllers\PostController', get_class($moduleController));
    }

    public function test_routeToTaggedController() {
        $_SERVER['REQUEST_METHOD'] = 'GET';
        $_SERVER['REQUEST_URI'] = '/tagged/tag1:tag2/page/1';

        /** @var Router $router */
        $router = Router::instance();
        $moduleController = $router->routeToModuleController();
        $this->assertEquals('framework\controllers\TaggedController', get_class($moduleController));
    }

    public function test_routeToNotFoundController1() {
        $_SERVER['REQUEST_METHOD'] = 'GET';
        $_SERVER['REQUEST_URI'] = '/blah/blah';

        /** @var Router $router */
        $router = Router::instance();
        $moduleController = $router->routeToModuleController();
        $this->assertEquals('framework\controllers\NotFoundController', get_class($moduleController));
    }

    public function test_routeToNotFoundController2() {
        $_SERVER['REQUEST_METHOD'] = 'GET';
        $_SERVER['REQUEST_URI'] = '/post/blah/blah';

        /** @var Router $router */
        $router = Router::instance();
        $moduleController = $router->routeToModuleController();
        $this->assertEquals('framework\controllers\NotFoundController', get_class($moduleController));
    }
}
