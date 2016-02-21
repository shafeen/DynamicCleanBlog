<?php
namespace framework\components;

use framework\components\Singleton;
require_once("components/Singleton.php");
use framework\models\HomeModel;
require_once("models/HomeModel.php");

class DbAccessor extends Singleton
{
    private $dbConn;

    private function getDbConn() {
        // NOTE: use php5-mysqlnd
        if (empty($this->dbConn)) {
            /** @var array $DB_INFO */
            global $DB_INFO;
            $this->dbConn = mysqli_connect(
                $DB_INFO["db_addr"],
                $DB_INFO["username"],
                $DB_INFO["password"],
                $DB_INFO["main_db_name"]);
        }
        // TODO: is it required to close this (probably not)?
        return $this->dbConn;
    }

    public function getPostFromDb($date, $cleanUrlTitle) {
        if (empty($date) || empty($cleanUrlTitle)) {
            return null;
        }

        // clean the $date and $cleanUrlTitle
        $date = $this->getDbConn()->real_escape_string($date);
        $cleanUrlTitle = $this->getDbConn()->real_escape_string($cleanUrlTitle);

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
        $result = $this->getDbConn()->query($sql);
        $postObj = $result->fetch_object();
        return $postObj;
    }

    /** @return int */
    public function getTotalPostNum() {
        $sql = "SELECT count(posts.id) as total_posts
                FROM posts";
        $result = $this->getDbConn()->query($sql);
        $postObj = $result->fetch_object();
        $totalPosts = (int)$postObj->total_posts;
        return $totalPosts;
    }

    /** @param int $pageNum
     *  @return array */
    public function getPagePostList($pageNum) {
        $limit = HomeModel::postsPerPage;
        $offset = ((int)$pageNum-1)*5;
        $sql = "SELECT posts.id as post_id,
                  title,
                  subtitle,
                  clean_url_title,
                  created,
                  authors.name as author_name
                FROM posts JOIN authors ON authors.id=posts.author_id
                LIMIT $limit OFFSET $offset";

        $result = $this->dbConn->query($sql);
        $pagePostObjs = array();
        while ($postObj = $result->fetch_object()) {
            $pagePostObjs[] = $postObj;
        }
        return $pagePostObjs;
    }

    /** @param array $tagnameArray
     *  @return array */
    public function getTaggedPostsForTags($tagnameArray) {
        if (empty($tagnameArray)) {
            return null;
        }

        // TODO: use parameterized queries
        $tagnameWhereStr = '';
        foreach ($tagnameArray as $tagname) {
            $tagnameWhereStr .= ($tagnameWhereStr=='')? '': ' OR ';
            $tagnameWhereStr .= "tagname='{$this->getDbConn()->real_escape_string($tagname)}'";
        }

        $sql = "SELECT
                  posts.id as post_id,
                  posts.created,
                  posts.title as post_title,
                  posts.subtitle as post_subtitle,
                  posts.clean_url_title,
                  authors.name as author_name,
                  tags.tagname FROM posts
                  JOIN authors ON posts.author_id = authors.id
                  JOIN tagged_posts ON posts.id = tagged_posts.post_id
                  JOIN tags ON tagged_posts.tag_id = tags.id
                WHERE {$tagnameWhereStr}
                ORDER BY posts.created DESC, post_id ASC";
        $result = $this->getDbConn()->query($sql);

        $taggedPostObjs = [];
        while ($taggedPostObj = $result->fetch_object()) {
            if (array_key_exists($taggedPostObj->post_id, $taggedPostObjs)) {
                $taggedPostObjs[$taggedPostObj->post_id]->tagname []= $taggedPostObj->tagname;
            } else {
                $taggedPostObj->tagname = [$taggedPostObj->tagname];
                $taggedPostObjs[$taggedPostObj->post_id] = $taggedPostObj;
            }
        }
        return $taggedPostObjs;
    }


}