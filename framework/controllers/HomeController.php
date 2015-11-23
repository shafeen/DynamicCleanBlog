<?php

namespace framework\controllers;

use framework\controllers\ModuleController;
use framework\views\HomeView;
use framework\models\HomeModel;
require_once("controllers/ModuleController.php");
require_once("views/HomeView.php");
require_once("models/HomeModel.php");

class HomeController extends ModuleController
{
    function run() {
        $this->moduleModel = new HomeModel();
        $this->moduleView = new HomeView($this->moduleModel);
        $this->moduleView->setMainHtmlFile("home.phtml");
        $this->moduleView->displayContent();
    }


}