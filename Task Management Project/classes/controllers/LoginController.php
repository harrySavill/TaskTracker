<?php
/**
 * LoginController.php
 *
 */

class LoginController extends ControllerAbstract
{
    public function createHtmlOutput()
    {
        $action = $this->getRoute();
        if ($action == 'login-submit'){
            $this->handleLogin();
        }else{
            $this->showLoginForm();
        }


    }



    /*
     * returns the route from the post array which is later used to decide whether to display the login form or handle login submission, sets a fallback of show as otherwise a warning appears as it is the default page and the post array would be empty
     */
    private function getRoute()
    {
        return $_POST['route'] ?? 'show';
    }

    private function showLoginForm()
    {
        $view = Factory::buildObject('LoginView');
        $view->createPage();
        $this->html_output = $view->getHtmlOutput();
    }

    private function handleLogin()
    {
        $username = $_POST['username'];
        $password = $_POST['password'];

        if($this->authenticate($username, $password)){
            $_SESSION['username'] = $username;
            $_SESSION['loggedIn'] = true;
            $controller = Factory::buildObject('DashboardController');
            $controller->createHtmlOutput();
            $this->html_output= $controller->getHtmlOutput();
        }else{
            $view = Factory::buildObject('LoginView');
            $view->setErrorMessage('Login failed');
            $view->createPage();
            $this->html_output = $view->getHtmlOutput();
        }
    }

    private function authenticate($username, $password)
    {
        $database = Factory::createDatabaseWrapper();
        $model = Factory::buildObject('LoginModel');

        $model->setDatabaseHandle($database);
        $model->setUsername($username);
        $model->setPassword($password);
        return $model->login(); // returns true if login successful
    }

}
