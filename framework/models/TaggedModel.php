<?php

namespace framework\models;

class TaggedModel
{
    const taggedPostsPerPage = 10;

    private $tags;
    private $pageNum;
    private $apiEndpoint;
    private $taggedPostObjs;

    /** @return array */
    public function getTags() {
        return $this->tags;
    }

    /** @return int */
    public function getPageNum() {
        return $this->pageNum;
    }

    /** @return int */
    public function getMaxPageNum() {
        return ceil(count($this->taggedPostObjs) / self::taggedPostsPerPage);
    }

    /** @return boolean */
    public function isApiEndpoint() {
        return ($this->apiEndpoint=='y');
    }

    /** @return array */
    public function getTaggedPostObjs() {
        return $this->taggedPostObjs;
    }

    /** @param array $tags
      * @param int $pageNum
      * @param string $apiEndpoint */
    function __construct($tags, $pageNum, $apiEndpoint, $taggedPostObjs) {
        $this->tags = $tags;
        $this->pageNum= $pageNum;
        $this->apiEndpoint = $apiEndpoint;
        $this->taggedPostObjs = $taggedPostObjs;
    }

}
