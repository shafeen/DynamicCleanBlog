<?php

namespace framework\models;

class HomeModel
{
    const postsPerPage = 5;

    private $pageNum;
    private $totalPosts;
    private $maxPageNum;
    private $curPagePostIds;

    /** @return int */
    public function getPageNum() {
        return $this->pageNum;
    }

    /** @return int */
    public function getTotalPosts() {
        return $this->totalPosts;
    }

    /** @return int */
    public function getMaxPageNum() {
        return $this->maxPageNum;
    }

    /** @return array */
    public function getCurPagePostIds() {
        return $this->curPagePostIds;
    }

    function __construct() {
        $this->initDefaults();
        if (!empty($_GET['page']) &&
            (int)$_GET['page'] > 0 &&
            (int)$_GET['page'] <= $this->maxPageNum) {
            $this->pageNum = (int)$_GET['page'];
        }
    }

    private function initDefaults() {
        // TODO: use reasonable defaults later, test values below
        $this->pageNum = 1;
        $this->totalPosts = 10;
        $this->maxPageNum = ceil($this->totalPosts/self::postsPerPage);
        $this->curPagePostIds = array();
    }

}