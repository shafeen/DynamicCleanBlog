<?php

namespace framework\views;

require_once("views/ModuleView.php");
use framework\models\PostModel;
require_once("models/PostModel.php");

class PostView extends ModuleView
{
    /** @var string */
    protected $title;
    /** @var string */
    protected $subtitle;
    /** @var string */
    protected $author;
    /** @var string */
    protected $date;
    /** @var string */
    protected $postBody;

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