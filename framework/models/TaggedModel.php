<?php

namespace framework\models;

class TaggedModel
{
    private $tags;
    private $pageNum;
    private $apiEndpoint;

    /** @return array */
    public function getTags() {
        return $this->tags;
    }

    /** @return int */
    public function getPageNum() {
        return $this->pageNum;
    }

    /** @return boolean */
    public function isApiEndpoint() {
        return ($this->apiEndpoint=='y');
    }

    /** @param array $tags
      * @param int $pageNum
      * @param string $apiEndpoint */
    function __construct($tags, $pageNum, $apiEndpoint) {
        $this->tags = $tags;
        $this->pageNum= $pageNum;
        $this->apiEndpoint = $apiEndpoint;
    }

}