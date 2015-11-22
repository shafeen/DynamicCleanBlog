<?php

namespace framework\controllers;

use framework\controllers\ModuleController;
use framework\views\PostView;
use framework\models\PostModel;
require_once("controllers/ModuleController.php");
require_once("views/PostView.php");
require_once("models/PostModel.php");

class PostController extends ModuleController
{
    function run() {
        $this->moduleModel = new PostModel();
        $this->moduleView = new PostView($this->moduleModel);
        $this->moduleView->setMainHtmlFile("post.phtml");
        $this->moduleView->displayContent();
    }


}