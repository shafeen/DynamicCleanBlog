<?php

namespace framework\controllers;

use framework\controllers\ModuleController;
use framework\views\HomeView;
use framework\models\HomeModel;
require_once("controllers/ModuleController.php");
require_once("views/HomeView.php");
require_once("models/HomeModel.php");

class HomeController extends ModuleController
{
    /** @return int */
    private function getTotalPostNum() {
        // TODO: complete this function
        // TODO: move database access to a separate component
        // NOTE: use php5-mysqlnd
        /** @var array $DB_INFO */
        global $DB_INFO;
        $dbConn = mysqli_connect(
            $DB_INFO["db_addr"],
            $DB_INFO["username"],
            $DB_INFO["password"],
            $DB_INFO["main_db_name"]);

        $sql = "SELECT count(posts.id) as total_posts FROM posts";
        $result = $dbConn->query($sql);
        $postObj = $result->fetch_object();
        $totalPosts = (int)$postObj->total_posts;
        $dbConn->close();
        return $totalPosts;
    }

    /** @param int $pageNum
     *  @return array */
    private function getPagePostList($pageNum) {
        // TODO: complete this function
        // TODO: move database access to a separate component
        // NOTE: use php5-mysqlnd
        /** @var array $DB_INFO */
        global $DB_INFO;
        $dbConn = mysqli_connect(
            $DB_INFO["db_addr"],
            $DB_INFO["username"],
            $DB_INFO["password"],
            $DB_INFO["main_db_name"]);

        $limit = HomeModel::postsPerPage;
        $offset = ($pageNum-1)*5;
        $sql = "SELECT posts.id as post_id,
                  title,
                  subtitle,
                  clean_url_title,
                  created,
                  authors.name as author_name
                FROM posts JOIN authors ON authors.id=posts.author_id
                LIMIT $limit OFFSET $offset";

        $result = $dbConn->query($sql);
        $pagePostObjs = array();
        while ($postObj = $result->fetch_object()) {
            $pagePostObjs[] = $postObj;
        }
        $dbConn->close();
        return $pagePostObjs;
    }


    function run() {
        $currentPage = (!empty($_GET['page']) && (int)$_GET['page'] > 0)? (int)$_GET['page'] : 1;
        $totalPosts = $this->getTotalPostNum();
        $pagePostObjs = $this->getPagePostList($currentPage);

        $this->moduleModel = new HomeModel($currentPage, $totalPosts, $pagePostObjs);
        $this->moduleView = new HomeView($this->moduleModel);
        $this->moduleView->setMainHtmlFile("home.phtml");
        $this->moduleView->displayContent();
    }


}