<?php

namespace framework\controllers;

use framework\controllers\ModuleController;
use framework\views\TestView;
use framework\models\TestModel;
require_once("controllers/ModuleController.php");
require_once("views/TestView.php");
require_once("models/TestModel.php");

class TestController extends ModuleController
{
    function run() {
        $this->moduleModel = new TestModel($this->explodedPathToModule);
        $this->moduleView = new TestView($this->moduleModel);
        $this->moduleView->setMainHtmlFile("test.phtml");
        $this->moduleView->displayContent();
    }

}