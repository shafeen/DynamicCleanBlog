<?php

namespace framework\controllers;

use framework\controllers\ModuleController;
use framework\models\TaggedModel;
//use framework\views\TaggedView;
require_once("controllers/ModuleController.php");
require_once("models/TaggedModel.php");
//require_once("views/TaggedView.php");

class TaggedController extends ModuleController
{
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

        // clean the tagname -> todo: use parameterized query$
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
        $taggedPostObjs = $result->fetch_all(); // TODO: debug this
        return $taggedPostObjs;
    }

    /** @return TaggedModel*/
    function initTaggedModel() {
        // TODO: initialize the tagged model here
    }

    function run() {
        // The About module view page does not have need to be dynamic.
        $this->moduleModel = null; // TODO: call to initModel here
//        $this->moduleView = new TaggedView($this->moduleModel); // TODO: create view
//        $this->moduleView->setMainHtmlFile("tagged.phtml"); // TODO: create main-html (for non rest api page)
//        $this->moduleView->displayContent();
    }


}