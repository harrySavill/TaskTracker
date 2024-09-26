<?php

class ProfileController extends ControllerAbstract
{

    public function createHtmlOutput()
    {
        $action = $this->getRoute();
        if ($action == 'delete-account'){
            $this->deleteUser();
            $_SESSION['loggedIn'] = false;
            $_SESSION['username'] = null;
            $this->createLoginView();
        }
        elseif ($action == 'edit-username' || $action == 'change-email') {
            $this->createEditProfileView();
        }
        elseif($action == 'change-profile'){
            $this->editProfile();
            $this->createProfileView();
        }
        elseif ($action == 'delete-tasks'){
            $this->deleteAllTasks();
            $this->createDashboardView();
        }
        else{
            $this->createProfileView();
        }
    }

    public function createProfileView()
    {
        $database = Factory::createDatabaseWrapper();
        $model = Factory::buildObject('ProfileModel');

        $model->setDatabaseHandle($database);
        $model->setUsername($_SESSION['username']);
        $userDetails = $model->getUserDetails();


        $view = Factory::buildObject('ProfileView');
        $view->setUsername($userDetails['username']);
        $view->setEmail($userDetails['email']);
        $view->setCreatedAt($userDetails['created_at']);
        $view->createPage();
        $this->html_output = $view->getHtmlOutput();
    }

    public function createEditProfileView()
    {
        $database = Factory::createDatabaseWrapper();
        $model = Factory::buildObject('ProfileModel');

        $model->setDatabaseHandle($database);
        $model->setUsername($_SESSION['username']);
        $userDetails = $model->getUserDetails();

        $view = Factory::buildObject('EditProfileView');
        $view->setUsername($userDetails['username']);
        $view->setEmail($userDetails['email']);
        $view->createPage();
        $this->html_output = $view->getHtmlOutput();
    }


    public function createDashboardView(){
        $view = Factory::buildObject('DashboardView');
        $view->createPage();
        $this->html_output = $view->getHtmlOutput();
    }
public function createLoginView(){
        $view = Factory::buildObject('LoginView');
        $view->createPage();
        $this->html_output = $view->getHtmlOutput();
}
    private function getRoute()
    {
        return $_POST['route'] ?? 'show';
    }

    public function deleteUser(){
        $database = Factory::createDatabaseWrapper();
        $model = Factory::buildObject('ProfileModel');
        $model->setDatabaseHandle($database);
        $model->setUsername($_SESSION['username']);
        $model->deleteUser();
    }

    public function deleteAllTasks()
    {
        $database = Factory::createDatabaseWrapper();
        $model = Factory::buildObject('ProfileModel');
        $model->setDatabaseHandle($database);
        $model->setUsername($_SESSION['username']);
        $model->setUserId();
        $model->deleteAllTasks();

    }

    public function editProfile(){
        $database = Factory::createDatabaseWrapper();
        $model = Factory::buildObject('EditProfileModel');
        $model->setDatabaseHandle($database);
        $model->setUsername($_SESSION['username']);
        $model->setUserId();
        $model->setUsername($_POST['username']);
        $_SESSION['username'] = $_POST['username'];
        $model->setEmail($_POST['email']);

        $model->editProfile();
    }


}