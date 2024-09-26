<?php

class CreateTaskController extends ControllerAbstract
{

    public function createHtmlOutput()
    {
        $action = $this->getRoute();
        if ($action == 'create-task'){
            $this->createTask();
        }else{
            $this->buildCreateTaskView();
        }
    }

    public function buildCreateTaskView()
    {
        $view = Factory::buildObject('CreateTaskView');
        $view->createPage();
        $this->html_output = $view->getHtmlOutput();
    }

    public function createTask()
    {
        $database = Factory::createDatabaseWrapper();
        $model = Factory::buildObject('CreateTaskModel');
        $model->setDatabaseHandle($database);
        $model->setUsername($_SESSION['username']);
        $model->setUserId();
        $model->setTaskName($_POST['task-name']);
        $model->setTaskDescription($_POST['task-desc']);
        $model->createTask();

        $controller = Factory::buildObject('DashboardController');
        $controller->createHtmlOutput();
        $this->html_output= $controller->getHtmlOutput();
    }
    private function getRoute()
    {
        return $_POST['route'] ?? 'show';
    }
}