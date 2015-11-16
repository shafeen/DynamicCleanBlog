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

    function __construct(&$model) {
        $this->initDependencyPaths();
        $this->extractInfoFromModel($model);
    }

    function initDependencyPaths() {
        $this->dependencyPaths = array(
            "jQuery" => "bower_components/jquery/dist/jquery.min.js",
            "bootstrapCss" => "bower_components/bootstrap/dist/css/bootstrap.min.css",
            "bootstrapOptionalThemeCss" => "bower_components/bootstrap/dist/css/bootstrap-theme.min.css",
            "bootstrapJavascript" => "bower_components/bootstrap/dist/js/bootstrap.min.js"
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