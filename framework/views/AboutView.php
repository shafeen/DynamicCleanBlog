<?php

namespace framework\views;

class AboutView extends ModuleView
{
    protected function initStaticInfo() {
        $this->headerInfo = array(
            "mainHeading" => "About Me",
            "subHeading"  => "This is what I do.",
            "bgndImgAddr" => "/images/about-bg.jpg"
        );
    }

    protected function extractInfoFromModel(&$model) {
        // TODO: Implement extractInfoFromModel() method.
    }

}