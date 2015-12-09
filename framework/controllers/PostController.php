<?php

namespace framework\controllers;

use framework\components\CleanRequestUrlParser;
use framework\controllers\ModuleController;
use framework\views\PostView;
use framework\models\PostModel;
require_once("controllers/ModuleController.php");
require_once("views/PostView.php");
require_once("models/PostModel.php");

class PostController extends ModuleController
{
    private function getPostFromDb($date, $cleanUrlTitle) {
        // TODO: move database access to a separate component
        if (empty($date) || empty($cleanUrlTitle)) {
            return null;
        }

        // NOTE: use php5-mysqlnd
        /** @var array $DB_INFO */
        global $DB_INFO;
        $dbConn = mysqli_connect(
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
        $postObj = $this->getPostFromDb($postDate, $postCleanUrlTitle);

        if (empty($postObj)) { // perform a cheap exit for incorrect urls
            ob_clean();
            echo "Page ".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI']." Not Found";
            exit();
        }

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