<?php

namespace framework\controllers;

use framework\controllers\ModuleController;
use framework\views\PostView;
use framework\models\PostModel;
require_once("controllers/ModuleController.php");
require_once("views/PostView.php");
require_once("models/PostModel.php");

class PostController extends ModuleController
{
    private function getPostFromDb($date, $cleanUrlTitle) {
        // TODO: complete this function
        // TODO: move database access to a separate component
        /** @var array $DB_INFO */
        // NOTE: use php5-mysqlnd
        $dbConn = mysqli_connect(
            global $DB_INFO;
            $DB_INFO["db_addr"],
            $DB_INFO["username"],
            $DB_INFO["password"],
            $DB_INFO["main_db_name"]);

        $sql = "SELECT
              posts.id AS post_id,
              authors.name as author_name,
              title,
              clean_url_title,
              subtitle,
              body_text,
              created,
              modified FROM posts
              JOIN post_body ON post_body.id = posts.post_body_id
              JOIN authors ON authors.id = posts.author_id
              WHERE created='$date' AND clean_url_title='$cleanUrlTitle'";
        $result = $dbConn->query($sql);
        $postObj = $result->fetch_object();
        return $postObj;
    }

    function run() {
        $postDate = $_GET['date'];
        $postCleanUrlTitle = $_GET['title'];
        $postObj = $this->getPostFromDb($postDate, $postCleanUrlTitle);

        $this->moduleModel = new PostModel(
            $postObj->title,
            $postObj->subtitle,
            $postObj->author_name,
            $postObj->created,
            $postObj->body_text);
        $this->moduleView = new PostView($this->moduleModel);
        $this->moduleView->setMainHtmlFile("post.phtml");
        $this->moduleView->displayContent();
    }




}