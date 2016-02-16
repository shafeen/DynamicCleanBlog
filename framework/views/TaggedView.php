<?php

namespace framework\views;

use framework\models\TaggedModel;

class TaggedView extends ModuleView
{
    protected function initStaticInfo() {
        // no static data
    }

    /** @param TaggedModel $model */
    protected function extractInfoFromModel(&$model) {
        // TODO: Implement extractInfoFromModel() method.
        $this->tags = $model->getTags();
        $this->pageNum = $model->getPageNum();
        $this->taggedPostObjs = $model->getTaggedPostObjs();
        // TODO: the model
    }

}