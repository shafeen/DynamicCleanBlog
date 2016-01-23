<?php

namespace framework\views;

use framework\models\HomeModel;

class HomeView extends ModuleView
{
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