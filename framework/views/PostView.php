<?php

namespace framework\views;

class PostView extends ModuleView
{
    protected function extractInfoFromModel(&$model) {
        $this->title = $model->getTitle();
        $this->subtitle = $model->getSubtitle();
        $this->author = $model->getAuthor();
        $this->date = $model->getDate();
        $this->postBody = $model->getPostBody();
    }
}