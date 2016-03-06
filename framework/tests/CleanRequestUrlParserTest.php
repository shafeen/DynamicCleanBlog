<?php

namespace framework\tests;

use framework\components\CleanRequestUrlParser;
use PHPUnit_Framework_TestCase;

class CleanRequestUrlParserTest extends PHPUnit_Framework_TestCase
{
    protected function setUp() {
        $this->initRootDir();
    }

    protected function initRootDir() {
        // before testing -> 'framework/' should be the root directory
        chdir('..');
        $this->assertEquals(substr(getcwd(), -9), 'framework');
    }


    public function test_getExplodedCleanRequestUrl() {
        require_once('components/CleanRequestUrlParser.php');
        $_SERVER['REQUEST_URI'] = '/home/page/1';
        $_SERVER['REQUEST_METHOD'] = 'GET';
        echo $_SERVER['REQUEST_URI'];


        /** @var CleanRequestUrlParser $cleanRequestUrlParser */
        $cleanRequestUrlParser = CleanRequestUrlParser::instance();
        print_r($cleanRequestUrlParser->getExplodedCleanRequestUrl());
        $cleanRequestUrlParser->parseGetVars(1);
        print_r($_GET);

        // TODO: complete this
    }

    public function test_parseGetVars() {
        // TODO: complete this
    }

    public function test_parsePostVars() {
        // TODO: complete this
    }
}
