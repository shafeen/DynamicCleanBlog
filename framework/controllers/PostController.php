<?php

namespace framework\controllers;

use framework\components\CleanRequestUrlParser;
use framework\components\DbAccessor;
use framework\controllers\ModuleController;
use framework\views\NotFoundView;
use framework\views\PostView;
use framework\models\PostModel;
require_once("controllers/ModuleController.php");
require_once("components/DbAccessor.php");
require_once("views/NotFoundView.php");
require_once("views/PostView.php");
require_once("models/PostModel.php");

class PostController extends ModuleController
{
    /** Date and Title will be parsed assuming the
     *  Request Url is in the format /path/to/module/<date_str>/<title_str>
     *  For Example: /post/1989-05-24/this-is-a-post-title
     *
     *  @param int $offset */
    protected function parseRequestVars($offset) {
        $explodedCleanRequestUrl = CleanRequestUrlParser::instance()->getExplodedCleanRequestUrl();
        if ($_SERVER["REQUEST_METHOD"] === "GET") {
            $_GET['date']  = empty($explodedCleanRequestUrl[$offset+0])? null : $explodedCleanRequestUrl[$offset+0];
            $_GET['title'] = empty($explodedCleanRequestUrl[$offset+1])? null : $explodedCleanRequestUrl[$offset+1];
        } else { // assume it is a "POST"
            $_POST['date']  = empty($explodedCleanRequestUrl[$offset+0])? null : $explodedCleanRequestUrl[$offset+0];
            $_POST['title'] = empty($explodedCleanRequestUrl[$offset+1])? null : $explodedCleanRequestUrl[$offset+1];;
        }
    }

    function run() {
        $postDate = $_GET['date'];
        $postCleanUrlTitle = $_GET['title'];

        /** @var DbAccessor $dbAccessor */
        $dbAccessor = DbAccessor::instance();
        $postObj = $dbAccessor->getPostFromDb($postDate, $postCleanUrlTitle);

        if (empty($postObj)) { // perform a cheap exit for incorrect urls
            $this->moduleModel = null;
            $this->moduleView = new NotFoundView($this->moduleModel);
            $this->moduleView->setMainHtmlFile("pagenotfound.phtml");
            // echo "Page ".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI']." Not Found";
        } else {
            $this->moduleModel = new PostModel(
                $postObj->title,
                $postObj->subtitle,
                $postObj->author_name,
                $postObj->created,
                $postObj->body_text);
            $this->moduleView = new PostView($this->moduleModel);
            $this->moduleView->setMainHtmlFile("post.phtml");
        }
        $this->moduleView->displayContent();
    }


}