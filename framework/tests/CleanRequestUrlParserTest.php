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
        if (substr(getcwd(), -9) != 'framework') {
            chdir('..');
            $this->assertEquals(substr(getcwd(), -9), 'framework');
        }
    }

    public function test_getExplodedCleanRequestUrl() {
        $_SERVER['REQUEST_METHOD'] = 'GET';
        $_SERVER['REQUEST_URI'] = '/home/page/1';

        /** @var CleanRequestUrlParser $cleanRequestUrlParser */
        require_once('components/CleanRequestUrlParser.php');
        $cleanRequestUrlParser = CleanRequestUrlParser::instance();
        $explodedCleanRequestUrl_actual = $cleanRequestUrlParser->getExplodedCleanRequestUrl();
        $explodedCleanRequestUrl_expected = ['home', 'page', '1'];

        $this->assertEquals(count($explodedCleanRequestUrl_actual),
                            count($explodedCleanRequestUrl_expected));

        for ($i = 0; $i < count($explodedCleanRequestUrl_expected); $i++) {
            $this->assertEquals($explodedCleanRequestUrl_expected[$i],
                                $explodedCleanRequestUrl_actual[$i]);
        }
    }

    public function test_getCleanRequestUrl() {
        $_SERVER['REQUEST_METHOD'] = 'GET';
        $_SERVER['REQUEST_URI'] = '/home/page/1';

        /** @var CleanRequestUrlParser $cleanRequestUrlParser */
        require_once('components/CleanRequestUrlParser.php');
        $cleanRequestUrlParser = CleanRequestUrlParser::instance();
        $cleanRequestUrl_expected = 'home/page/1';
        $cleanRequestUrl_actual = $cleanRequestUrlParser->getCleanRequestUrl();

        $this->assertEquals($cleanRequestUrl_expected, $cleanRequestUrl_actual);
    }

    public function test_parseGetVars() {
        $_SERVER['REQUEST_METHOD'] = 'GET';
        $_SERVER['REQUEST_URI'] = '/home/page/1';

        /** @var CleanRequestUrlParser $cleanRequestUrlParser */
        require_once('components/CleanRequestUrlParser.php');
        $cleanRequestUrlParser = CleanRequestUrlParser::instance();
        $cleanRequestUrlParser->parseGetVars(1);

        $this->assertEquals(count($_GET), 1);
        $this->assertArrayHasKey('page', $_GET);
        $this->assertEquals($_GET['page'], '1');
    }

    public function test_parsePostVars() {
        $_SERVER['REQUEST_METHOD'] = 'POST';
        $_SERVER['REQUEST_URI'] = '/home/page/1';

        /** @var CleanRequestUrlParser $cleanRequestUrlParser */
        require_once('components/CleanRequestUrlParser.php');
        $cleanRequestUrlParser = CleanRequestUrlParser::instance();
        $cleanRequestUrlParser->parsePostVars(1);

        $this->assertEquals(count($_POST), 1);
        $this->assertArrayHasKey('page', $_POST);
        $this->assertEquals($_POST['page'], '1');
    }
}
