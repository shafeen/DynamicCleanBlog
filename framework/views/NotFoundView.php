<?php

namespace framework\views;

use framework\views\ModuleView;
require_once("views/ModuleView.php");

class NotFoundView extends ModuleView
{
    /** @var array */
    protected $headerInfo;

    protected function initStaticInfo() {
        $this->headerInfo = array(
            "mainHeading" => "Page Not Found",
            "subHeading"  => "sadface :'(",
            "bgndImgAddr" => "/images/black-bg.jpg"
        );
    }

    protected function extractInfoFromModel(&$model) {
        // no dynamic info to initialize
    }
}