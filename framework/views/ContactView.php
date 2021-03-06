<?php

namespace framework\views;

require_once("views/ModuleView.php");

class ContactView extends ModuleView
{
    /** @var array */
    protected $headerInfo;

    protected function initStaticInfo() {
        $this->headerInfo = array(
            "mainHeading" => "Contact Me",
            "subHeading"  => "Have questions? I have answers (maybe).",
            "bgndImgAddr" => "/images/contact-bg.jpg"
        );
    }

    protected function extractInfoFromModel(&$model) {
        // no (dynamic) data expected from model
    }

}