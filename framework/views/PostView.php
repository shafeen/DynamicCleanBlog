<?php

namespace framework\views;

use framework\models\PostModel;
require_once("models/PostModel.php");

class PostView extends ModuleView
{
    /** @param PostModel $model */
    protected function extractInfoFromModel(&$model) {
        $this->title = $model->getTitle();
        $this->subtitle = $model->getSubtitle();
        $this->author = $model->getAuthor();
        $this->date = $model->getDate();
        $this->postBody = $model->getPostBody();
    }
}