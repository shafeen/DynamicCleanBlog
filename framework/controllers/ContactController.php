<?php

namespace framework\controllers;

use framework\controllers\ModuleController;
use framework\views\ContactView;
//use framework\models\ContactModel;
require_once("controllers/ModuleController.php");
require_once("views/ContactView.php");
//require_once("models/ContactModel.php");

class ContactController extends ModuleController
{
    function run() {
        $this->moduleModel = null;
        $this->moduleView = new ContactView($this->moduleModel);
        $this->moduleView->setMainHtmlFile("contact.phtml");
        $this->moduleView->displayContent();
    }


}