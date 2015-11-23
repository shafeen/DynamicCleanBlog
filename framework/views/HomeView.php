<?php

namespace framework\views;

class HomeView extends ModuleView
{
    protected function extractInfoFromModel(&$model) {
        // TODO: Implement extractInfoFromModel() method.
        $this->pageNum = $model->getPageNum();
        $this->maxPageNum = $model->getMaxPageNum();
    }
}