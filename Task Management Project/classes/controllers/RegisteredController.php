<?php

class RegisteredController extends ControllerAbstract
{

    public function createHtmlOutput()
    {
        $view = Factory::buildObject('RegisteredView');
        $view->createPage();
        $this->html_output = $view->getHtmlOutput();
        $this->processInput();;
    }

    public function processInput()
    {

        $passwordManager = Factory::buildObject('PasswordManager');
        $Username = $_POST['username'];
        $inpPassword = $_POST['password'];
        $Email = $_POST['email'];
        $hashedPassword = $passwordManager->hashPassword($inpPassword);

        $database = Factory::createDatabaseWrapper();
        $model = Factory::buildObject('RegisteredModel');

        $model->setDatabaseHandle($database);
        $model->setUsername($Username);
        $model->setHashedPassword($hashedPassword);
        $model->setEmail($Email);
        $model->registerUser();

    }


}