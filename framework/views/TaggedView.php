<?php

namespace framework\views;

use framework\models\TaggedModel;
require_once("views/ModuleView.php");

class TaggedView extends ModuleView
{
    /** @var array */
    protected $headerInfo;
    /** @var array */
    protected $tags;
    /** @var int */
    protected $pageNum;
    /** @var int */
    protected $maxPageNum;
    /** @var array */
    protected $taggedPostObjs;

    protected function initStaticInfo() {
        $this->headerInfo = array(
            "mainHeading" => "Tagged Posts",
            "subHeading"  => "tags: ",
            "bgndImgAddr" => "/images/black-bg.jpg"
        );
    }

    /** @param TaggedModel $model */
    protected function extractInfoFromModel(&$model) {
        $this->tags = $model->getTags();
        $this->pageNum = $model->getPageNum();
        $this->maxPageNum = $model->getMaxPageNum();
        $this->taggedPostObjs = $model->getTaggedPostObjs();

        $this->headerInfo["subHeading"] .= json_encode($this->tags);
    }

}