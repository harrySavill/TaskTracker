<?php

class ChangePasswordController extends ControllerAbstract
{

    public function createHtmlOutput()
    {
        $action = $this->getRoute();
        if($action == "change-password"){
            $this->buildChangePasswordView('');
        }elseif ($action == "change-password-confirm"){
            $database = Factory::createDatabaseWrapper();
            $model = Factory::buildObject('ChangePasswordModel');

//            confirm old password
            $inp_current_password = $_POST['current-password'];

            $model->setUsername($_SESSION['username']);
            $model->setCurrentPassword($inp_current_password);
            $model->setDatabaseHandle($database);
            if($model->verifyCurrentPassword()){
                if($_POST['new-password'] == $_POST['confirm-password']){
                    $passwordManager = Factory::buildObject('PasswordManager');
                    $newHashedPassword = $passwordManager->hashPassword($_POST['new-password']);
                    $model->setNewPassword($newHashedPassword);
                    $model->updatePassword();
                    $this->buildProfileView('');
                }
                else $this->buildChangePasswordView('new passwords do not match');
            }
            else $this->buildChangePasswordView('old password incorrect');


        }



    }

    private function buildProfileView()
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

    private function buildChangePasswordView($error_msg)
    {
        $view = Factory::buildObject('ChangePasswordView');
        if($error_msg != ""){
            $view->setErrorMessage($error_msg);
        }
        $view->createPage();
        $this->html_output = $view->getHtmlOutput();
    }
    private function getRoute()
    {
        return $_POST['route'];
    }

}
