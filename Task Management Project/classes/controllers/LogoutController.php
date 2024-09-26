<?php

class LogoutController extends ControllerAbstract
{

    public function createHtmlOutput()
    {
        $_SESSION['loggedIn'] = false;
        $_SESSION['username'] = null;

        $view = Factory::buildObject('LoginView');
        $view->createPage();
        $this->html_output = $view->getHtmlOutput();
    }
}