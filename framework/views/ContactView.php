<?php

namespace framework\views;

class ContactView extends ModuleView
{
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