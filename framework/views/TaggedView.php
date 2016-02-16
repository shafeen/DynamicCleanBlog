<?php

namespace framework\views;

use framework\models\TaggedModel;

class TaggedView extends ModuleView
{
    /** @var array */
    protected $tags;
    /** @var int */
    protected $pageNum;
    /** @var array */
    protected $taggedPostObjs;

    protected function initStaticInfo() {
        // no static data
    }

    /** @param TaggedModel $model */
    protected function extractInfoFromModel(&$model) {
        // TODO: Implement extractInfoFromModel() method.
        $this->tags = $model->getTags();
        $this->pageNum = $model->getPageNum();
        $this->taggedPostObjs = $model->getTaggedPostObjs();
    }

}