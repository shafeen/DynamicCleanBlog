<?php

namespace framework\components;

abstract class Singleton
{
    static private $instance;

    /** @return Singleton */
    static public function instance() {
        if (empty(self::$instance)) {
            self::$instance = new CleanRequestUrlParser();
        }
        return self::$instance;
    }

    private function __construct() {
    }
}