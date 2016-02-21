<?php

namespace framework\components;

abstract class Singleton
{
    static private $instance;

    /** @return Singleton */
    public static function instance() {
        if (empty(self::$instance)) {
            $calledClassName = static::getClassName();
            self::$instance = $calledClassName();
        }
        return self::$instance;
    }

    private function __construct() {
    }

    /** @return string */
    abstract protected function getClassName();
}