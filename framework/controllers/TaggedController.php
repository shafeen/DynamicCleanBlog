<?php

namespace framework\controllers;

use framework\controllers\ModuleController;
use framework\models\TaggedModel;
use framework\views\TaggedView;
require_once("controllers/ModuleController.php");
require_once("models/TaggedModel.php");
require_once("views/TaggedView.php");

class TaggedController extends ModuleController
{
    const TAG_DELIMITER = "--";

    private function getTaggedPostsFromDbForTags($tagArray) {
        $taggedPostObjsForTag = [];
        foreach ($tagArray as $tag) {
            $taggedPostObjsForTag = array_merge($taggedPostObjsForTag, $this->getTaggedPostsFromDb($tag));
        }
        // TODO: ensure posts with multiple tags aren't double counted
        return $taggedPostObjsForTag;
    }

    // TODO: move database access to a separate component
    private function getTaggedPostsFromDb($tagname) {
        if (empty($tagname)) {
            return null;
        }

        global $DB_INFO;
        $dbConn = mysqli_connect(
            $DB_INFO["db_addr"],
            $DB_INFO["username"],
            $DB_INFO["password"],
            $DB_INFO["main_db_name"]);

        // clean the tagname -> todo: use parameterized queries
        $tagname = $dbConn->real_escape_string($tagname);
        $sql = "SELECT
                  posts.id as post_id,
                  posts.created,
                  posts.title as post_title,
                  tags.tagname FROM posts
                  JOIN tagged_posts ON posts.id = tagged_posts.post_id
                  JOIN tags ON tagged_posts.tag_id = tags.id
                WHERE tagname='$tagname'";
        $result = $dbConn->query($sql);
        $taggedPostObjs = []; // TODO: debug this
        while ($taggedPostObj = $result->fetch_object()) {
            $taggedPostObjs []= $taggedPostObj;
        }
        return $taggedPostObjs;
    }

    /** @return TaggedModel */
    function getInitializedTaggedModel() {
        $unparsedTags = isset($_GET["tags"])? $_GET["tags"] : "";
        $tags = explode(self::TAG_DELIMITER, $unparsedTags);
        $pageNum = (isset($_GET["page"]) && (int)$_GET["page"])? (int)$_GET["page"] : 1;
        $apiEndpoint = isset($_GET["apiendpoint"])? $_GET["apiendpoint"] : "n";
        $taggedPostObjs = $this->getTaggedPostsFromDbForTags($tags);
        return new TaggedModel($tags, $pageNum, $apiEndpoint, $taggedPostObjs);
    }

    /** Request URL will be assumed to be in the following format below:
     *  /tagged/tags/<tag1>--<tag2>--<tag3>/page/<pagenum>
     *
     *  For Example:
     *  /tagged/tags/redis--java/page/1 */
    function run() {
        $this->moduleModel = $this->getInitializedTaggedModel(); // TODO: verify
        $this->moduleView = new TaggedView($this->moduleModel); // TODO: complete view class

        if ($this->moduleModel->isApiEndpoint()) {
            header('Content-Type: application/json');
            echo json_encode($this->moduleModel->getTaggedPostObjs());
        } else {
            $this->moduleView->setMainHtmlFile("tagged.phtml");
            $this->moduleView->displayContent();
        }
    }


}