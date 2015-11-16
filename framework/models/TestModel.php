<?php

namespace framework\models;

class TestModel
{
    private $reqPathParamArray;

    /** @param string $reqPathParamArray */
    function __construct($reqPathParamArray) {
        $this->reqPathParamArray = $reqPathParamArray;
    }

    /** @return string */
    public function getReqPathParamArray() {
        return $this->reqPathParamArray;
    }
}