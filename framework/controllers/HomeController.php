<?php

namespace framework\controllers;

use framework\components\DbAccessor;
use framework\controllers\ModuleController;
use framework\views\HomeView;
use framework\models\HomeModel;
require_once("components/DbAccessor.php");
require_once("controllers/ModuleController.php");
require_once("views/HomeView.php");
require_once("models/HomeModel.php");

class HomeController extends ModuleController
{
    function run() {
        /** @var DbAccessor $dbAccessor */
        $dbAccessor = DbAccessor::instance();
        $totalPosts = $dbAccessor->getTotalPostNum();

        $currentPage = (!empty($_GET['page']) && (int)$_GET['page'] > 0)? (int)$_GET['page'] : 1;
        $pagePostObjs = $dbAccessor->getPagePostList($currentPage);

        $this->moduleModel = new HomeModel($currentPage, $totalPosts, $pagePostObjs);
        $this->moduleView = new HomeView($this->moduleModel);
        $this->moduleView->setMainHtmlFile("home.phtml");
        $this->moduleView->displayContent();
    }


}