<?php

namespace framework\views;

use framework\views\ModuleView;
require_once("views/ModuleView.php");

class TestView extends ModuleView
{
    protected function initStaticInfo() {
        // no static info to initialize
    }

    protected function extractInfoFromModel(&$model) {
        // set the variables needed for the main html file
        $this->reqPathParamArray = $model->getReqPathParamArray();
    }

}