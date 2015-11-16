<?php

namespace framework\components;

class CleanRequestUrlParser
{
    static private $instance;

    private $explodedCleanRequestUrl;

    /** @return CleanRequestUrlParser */
    static public function instance() {
        if (empty(self::$instance)) {
            self::$instance = new CleanRequestUrlParser();
        }
        return self::$instance;
    }

    private function __construct() {
    }

    /** @return array */
    public function getExplodedCleanRequestUrl() {
        if (empty($this->explodedCleanRequestUrl)) {
            $explodedUrl = explode("/", $_SERVER["REQUEST_URI"]);
            $this->explodedCleanRequestUrl = array();
            foreach ($explodedUrl as $urlVar) {
                if (!empty($urlVar)) {
                    $this->explodedCleanRequestUrl[] = $urlVar;
                }
            }
        }
        return $this->explodedCleanRequestUrl;
    }

    /** @param int $offset */
    public function parseGetVars($offset=0) {
        if ($_SERVER["REQUEST_METHOD"] === "GET") {
            $offset = abs($offset);
            // set request params in the $_GET superglobal
            $explodedCleanRequestUrl = $this->getExplodedCleanRequestUrl();
            $arrayCount = count($explodedCleanRequestUrl);
            for ($i = $offset; $i < $arrayCount; $i+=2) {
                if ($i+1 < $arrayCount) {
                    $_GET[$explodedCleanRequestUrl[$i]]=$explodedCleanRequestUrl[$i+1];
                }
            }
        }
    }

    /** @param int $offset */
    public function parsePostVars($offset=0) {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $offset = abs($offset);
            // set request params in the $_POST superglobal
            $explodedCleanRequestUrl = $this->getExplodedCleanRequestUrl();
            $arrayCount = count($explodedCleanRequestUrl);
            for ($i = $offset; $i < $arrayCount; $i+=2) {
                if ($i+1 < $arrayCount) {
                    $_POST[$explodedCleanRequestUrl[$i]]=$explodedCleanRequestUrl[$i+1];
                }
            }
        }
    }
}