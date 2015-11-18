<?php

namespace framework\views;

abstract class ModuleView
{
    // map of common dependencies required by most rendered pages
    // for example: jQuery, lodash/underscore, bootstrap, etc.
    protected $dependencyPaths;

    // $mainHtmlFile should take care and only access
    // variables through the ModelView class that "include"s it
    protected $mainHtmlFile;

    function __construct(&$model, $useLocalDependencyPaths=false) {
        $this->initDependencyPaths($useLocalDependencyPaths);
        $this->extractInfoFromModel($model);
    }

    /** @param bool $useLocalDependencyPaths */
    function initDependencyPaths($useLocalDependencyPaths) {

        $this->dependencyPaths = array(
            "jQuery" => $useLocalDependencyPaths?
                "/bower_components/jquery/dist/jquery.min.js" :
                "https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js",
            "bootstrapCss" => $useLocalDependencyPaths?
                "/bower_components/bootstrap/dist/css/bootstrap.min.css" :
                "https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css",
            "bootstrapOptionalThemeCss" => $useLocalDependencyPaths?
                "/bower_components/bootstrap/dist/css/bootstrap-theme.min.css" :
                "https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css",
            "bootstrapJavascript" => $useLocalDependencyPaths?
                "/bower_components/bootstrap/dist/js/bootstrap.min.js" :
                "https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"
        );
    }

    /** @param string $filename */
    function setMainHtmlFile($filename) {
        $this->mainHtmlFile = $filename;
    }

    abstract protected function extractInfoFromModel(&$model);

    function displayContent() {
        include("views/main-html/".$this->mainHtmlFile);
    }

}