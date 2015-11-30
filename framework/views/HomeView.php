<?php

namespace framework\views;

use framework\models\HomeModel;

class HomeView extends ModuleView
{
    /** @param HomeModel $model */
    protected function extractInfoFromModel(&$model) {
        // TODO: Implement extractInfoFromModel() method.
        $this->pageNum = $model->getPageNum();
        $this->maxPageNum = $model->getMaxPageNum();
        $this->pagePostObjs = $model->getCurPagePostObjs();
    }
}