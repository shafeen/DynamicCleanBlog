<?php

namespace framework\controllers;

use framework\controllers\ModuleController;
use framework\views\NotFoundView;
require_once("controllers/ModuleController.php");
require_once("views/NotFoundView.php");

class NotFoundController extends ModuleController
{
    function run() {
        $this->moduleModel = null;
        $this->moduleView = new NotFoundView($this->moduleModel);
        $this->moduleView->setMainHtmlFile("pagenotfound.phtml");
        $this->moduleView->displayContent();
    }

}