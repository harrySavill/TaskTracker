<?php

class DashboardController extends ControllerAbstract
{

    public function createHtmlOutput()
    {
        $action = $this->getRoute();
        if ($action == 'view-task') {
            $this->viewTask();
        }
        elseif($action == 'complete-task') {
            $this->completeTask();
            $this->buildDashboardView();
        }
        elseif($action == 'reopen-task') {
            $this->reopenTask();
            $this->buildDashboardView();
        }
        elseif($action == 'delete-task') {
            $this->deleteTask();
            $this->buildDashboardView();
        }
        else{
            $this->buildDashboardView();
        }
    }

    private function buildDashboardView()
    {
        $database = Factory::createDatabaseWrapper();
        $model = Factory::buildObject('DashboardModel');
        $model->setDatabaseHandle($database);
        $model->setUsername($_SESSION['username']);
        $model->setUserId();
        $taskArray = $model->getAllTasks();



        $view = Factory::buildObject('DashboardView');
        $view->setTaskArray($taskArray);
        $view->createPage();
        $this->html_output= $view->getHtmlOutput();
    }
    private function deleteTask()
    {
        $database = Factory::createDatabaseWrapper();
        $model = Factory::buildObject('DashboardModel');

        $model->setDatabaseHandle($database);
        $model->setTaskId($_POST['task-id']);
        $model->deleteTask();
    }
    private function completeTask()
    {
        $database = Factory::createDatabaseWrapper();
        $model = Factory::buildObject('DashboardModel');

        $model->setDatabaseHandle($database);
        $model->setTaskId($_POST['task-id']);
        $model->completeTask();
    }
    private function reopenTask()
    {
        $database = Factory::createDatabaseWrapper();
        $model = Factory::buildObject('DashboardModel');

        $model->setDatabaseHandle($database);
        $model->setTaskId($_POST['task-id']);
        $model->reopenTask();
    }
    private function viewTask()
    {
        $database = Factory::createDatabaseWrapper();
        $model = Factory::buildObject('DashboardModel');

        $model->setDatabaseHandle($database);
        $model->setTaskId($_POST['task-id']);
        $model->viewTask();
        $taskData = $model->getTaskData();

        $view = Factory::buildObject('ViewTaskView');
        $view->setTaskData($taskData);
        $view->createPage();
        $this->html_output= $view->getHtmlOutput();

    }
    private function getRoute()
    {
        return $_POST['route'] ?? 'show';
    }
}