<?php

namespace framework\models;

class HomeModel
{
    const postsPerPage = 5;

    private $pageNum;
    private $totalPosts;
    private $pagePostObjs;
    private $maxPageNum;

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
    public function getCurPagePostObjs() {
        return $this->pagePostObjs;
    }

    /** @param int $currentPage
     *  @param int $totalPosts
     *  @param array $pagePostObjs */
    function __construct($currentPage, $totalPosts, $pagePostObjs) {
        $this->initDefaults();
        $this->pageNum = $currentPage;
        $this->totalPosts = $totalPosts;
        $this->pagePostObjs = $pagePostObjs;
        $this->maxPageNum = ceil($this->totalPosts/self::postsPerPage);
    }

    private function initDefaults() {
        // TODO: use reasonable defaults later, test values below
        $this->pageNum = 1;
        $this->totalPosts = self::postsPerPage;
        $this->maxPageNum = ceil($this->totalPosts/self::postsPerPage);
    }

}