<?php

namespace framework\controllers;

use framework\controllers\ModuleController;
use framework\views\AboutView;
//use framework\models\AboutModel;
require_once("controllers/ModuleController.php");
require_once("views/AboutView.php");
//require_once("models/AboutModel.php");

class AboutController extends ModuleController
{
    function run() {
        // The About module view page does not have need to be dynamic.
        $this->moduleModel = null;
        $this->moduleView = new AboutView($this->moduleModel);
        $this->moduleView->setMainHtmlFile("about.phtml");
        $this->moduleView->displayContent();
    }


}