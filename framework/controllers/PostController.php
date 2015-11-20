<?php

namespace framework\controllers;

use framework\controllers\ModuleController;
use framework\views\PostView;
use framework\models\TestModel;
require_once("controllers/ModuleController.php");
require_once("views/PostView.php");
require_once("models/TestModel.php");

class PostController extends ModuleController
{
    function run() {
        $this->moduleModel = null;
        $this->moduleView = new PostView($this->moduleModel);
        $this->moduleView->setMainHtmlFile("post.phtml");
        $this->moduleView->displayContent();
    }


}