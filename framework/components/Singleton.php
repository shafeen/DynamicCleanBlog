<?php

namespace framework\components;

abstract class Singleton
{
    static private $instance;

    /** @return Singleton */
    public static function instance() {
        if (empty(self::$instance)) {
            $calledClassName = get_called_class();
            self::$instance = $calledClassName();
        }
        return self::$instance;
    }

    private function __construct() {
    }
}