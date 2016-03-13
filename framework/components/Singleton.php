<?php

namespace framework\components;

require_once("components/CleanRequestUrlParser.php");
require_once("components/DbAccessor.php");

abstract class Singleton
{
    static protected $instances;

    /** @return Singleton */
    public static function instance() {
        // workaround for the late static binding problem (for static functions)
        $calledClassName = get_called_class();
        if (empty(self::$instances[$calledClassName])) {
            self::$instances[$calledClassName] = new static();
        }
        return self::$instances[$calledClassName];
    }

    private function __construct() {
    }

    /** Forget all instances saved.
     *  This function is for PHPUnit use ONLY!! */
    public static function resetInstances() {
        self::$instances = null;
    }
}