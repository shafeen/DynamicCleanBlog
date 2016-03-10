<?php

namespace framework\views;

use framework\models\HomeModel;
require_once("views/ModuleView.php");

class HomeView extends ModuleView
{
    /** @var array */
    protected $pagePostObjs;
    /** @var int */
    protected $maxPageNum;
    /** @var int */
    protected $pageNum;
    /** @var array */
    protected $headerInfo;

    protected function initStaticInfo() {
        $this->headerInfo = array(
            "mainHeading" => "Dynamic Clean Blog",
            "subHeading"  => "A (Dynamic) Clean Blog Theme",
            "bgndImgAddr" => "/images/home-bg.jpg"
        );
    }

    /** @param HomeModel $model */
    protected function extractInfoFromModel(&$model) {
        // TODO: Implement extractInfoFromModel() method.
        $this->pageNum = $model->getPageNum();
        $this->maxPageNum = $model->getMaxPageNum();
        $this->pagePostObjs = $model->getCurPagePostObjs();
    }
}