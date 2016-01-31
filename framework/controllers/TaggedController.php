<?php

namespace framework\controllers;

use framework\controllers\ModuleController;
use framework\models\TaggedModel;
//use framework\views\TaggedView;
require_once("controllers/ModuleController.php");
require_once("views/TaggedModel.php");
//require_once("views/TaggedView.php");
//require_once("models/AboutModel.php");

class TaggedController extends ModuleController
{
    /** @return TaggedModel*/
    function initTaggedModel() {
        // TODO: initialize the tagged model here
    }

    function run() {
        // The About module view page does not have need to be dynamic.
        $this->moduleModel = null; // TODO: call to initModel here
//        $this->moduleView = new TaggedView($this->moduleModel); // TODO: create view
//        $this->moduleView->setMainHtmlFile("tagged.phtml"); // TODO: create main-html
//        $this->moduleView->displayContent();
    }


}