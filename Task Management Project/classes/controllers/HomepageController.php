<?php

class HomepageController extends ControllerAbstract
{

    public function createHtmlOutput()
    {
        $view = Factory::buildObject('DashboardView');
        $view->createPage();
        $this->html_output = $view->getHtmlOutput();
    }
}