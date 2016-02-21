<?php

namespace framework\controllers;

use framework\components\DbAccessor;
use framework\controllers\ModuleController;
use framework\models\TaggedModel;
use framework\views\TaggedView;
require_once("components/DbAccessor.php");
require_once("controllers/ModuleController.php");
require_once("models/TaggedModel.php");
require_once("views/TaggedView.php");

class TaggedController extends ModuleController
{
    const TAG_DELIMITER = ':';

    /** @return TaggedModel */
    function getInitializedTaggedModel() {
        $unparsedTags = isset($_GET["tags"])? $_GET["tags"] : "";
        $tags = explode(self::TAG_DELIMITER, $unparsedTags);
        $pageNum = (isset($_GET["page"]) && (int)$_GET["page"])? (int)$_GET["page"] : 1;
        $apiEndpoint = isset($_GET["apiendpoint"])? $_GET["apiendpoint"] : "n";

        /** @var DbAccessor $dbAccessor */
        $dbAccessor = DbAccessor::instance();
        $taggedPostObjs = $dbAccessor->getTaggedPostsForTags($tags);
        return new TaggedModel($tags, $pageNum, $apiEndpoint, $taggedPostObjs);
    }

    /** Request URL will be assumed to be in the following format below:
     *  /tagged/tags/<tag1>:<tag2>:<tag3>/page/<pagenum>
     *
     *  For Example:
     *  /tagged/tags/redis:java/page/1 */
    function run() {
        $this->moduleModel = $this->getInitializedTaggedModel();

        // TODO: the tagged posts need to have pagination implemented (doesn't work now)
        $this->moduleView = new TaggedView($this->moduleModel);

        if ($this->moduleModel->isApiEndpoint()) {
            header('Content-Type: application/json');
            echo json_encode($this->moduleModel->getTaggedPostObjs());
        } else {
            $this->moduleView->setMainHtmlFile("tagged.phtml");
            $this->moduleView->displayContent();
        }
    }

}