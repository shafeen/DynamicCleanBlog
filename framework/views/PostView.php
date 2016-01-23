<?php

namespace framework\views;

use framework\models\PostModel;
require_once("models/PostModel.php");

class PostView extends ModuleView
{
    protected function initStaticInfo() {
        // no static info to initialize
    }

    /** @param PostModel $model */
    protected function extractInfoFromModel(&$model) {
        $this->title = $model->getTitle();
        $this->subtitle = $model->getSubtitle();
        $this->author = $model->getAuthor();
        // convert date to a human readable format
        $this->date = date("F jS, Y",strtotime($model->getDate()));
        $this->postBody = $model->getPostBody();
    }
}