<?php

class RegisterController extends ControllerAbstract
{

    public function createHtmlOutput()
    {
        $view = Factory::buildObject('RegisterView');
        $view->createPage();
        $this->html_output = $view->getHtmlOutput();
    }
}