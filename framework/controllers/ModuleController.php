<?php

namespace framework\controllers;

use framework\components\CleanRequestUrlParser;
require_once("components/CleanRequestUrlParser.php");

abstract class ModuleController
{
    protected $explodedPathToModule;
    protected $moduleView;
    protected $moduleModel;

    /** @param array $explodedPathToModule */
    public function __construct($explodedPathToModule) {
        $this->explodedPathToModule = $explodedPathToModule;
        $this->parseRequestVars(count($this->explodedPathToModule));
    }

    /** @param int $offset */
    protected function parseRequestVars($offset) {
        if ($_SERVER["REQUEST_METHOD"] === "GET") {
            CleanRequestUrlParser::instance()->parseGetVars($offset);
        } else { // assume it is a "POST"
            CleanRequestUrlParser::instance()->parsePostVars($offset);
        }
    }

    abstract function run();
}
