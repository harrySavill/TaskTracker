<?php
/**
 * Router.php
 *
 * Used for redirecting submissions to the correct place.
 * Routes need to be allowed in framework\Validate.php
 *
 */

class Router
{
    private $html_output;

    public function __construct()
    {
        $this->html_output = '';
    }

    public function __destruct(){}

    public function routing()
    {
        $html_output = '';

        // Set the selected route based on form submission or default
        $selected_route = $this->setRouteName();
        $route_exists = $this->validateRouteName($selected_route);

        // Check if the route exists and dispatch to the appropriate controller
        if ($route_exists == true)
        {
            $html_output = $this->selectController($selected_route);
        }

        // Process the HTML output
        $this->html_output = $this->processOutput($html_output);
    }

    /**
     * Set the default route to be login
     * Read the name of the selected route from the magic global POST array and overwrite the default if necessary
     *
     * @return mixed|string
     */
    private function setRouteName()
    {
        $selected_route = 'login';

        // Check if the form is submitted and set the route accordingly
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['route']))
        {
            $selected_route = $_POST['route'];
        }

        return $selected_route;
    }

    /**
     * Check to see that the route name passed from the client is valid.
     * If not valid, chances are that a user is attempting something malicious.
     * In which case, kill the app's execution.
     */
    private function validateRouteName($selected_route)
    {
        $route_exists = false;
        $validate = Factory::buildObject('Validate');
        $route_exists = $validate->validateRoute($selected_route);
        return $route_exists;
    }

    /**
     * Select the appropriate controller based on the selected route
     */
    public function selectController($selected_route)
    {
        switch ($selected_route)
        {
            case 'home':
                $controller = Factory::buildObject('HomepageController');
                break;
            case 'register':
                $controller = Factory::buildObject('RegisterController');
                break;
            case 'register-submit':
                $controller = Factory::buildObject('RegisteredController');
                break;
            case 'logout':
                $controller = Factory::buildObject('LogoutController');
                break;
            case 'profile':
            case 'delete-tasks':
            case 'delete-account':
            case 'edit-username':
            case 'change-email':
            case 'change-profile':
                $controller = Factory::buildObject('ProfileController');
                break;
            case 'change-password':
            case 'change-password-confirm':
                $controller = Factory::buildObject('ChangePasswordController');
                break;
            case 'dashboard':
            case 'view-task':
            case 'reopen-task':
            case 'delete-task':
            case 'complete-task':
                $controller = Factory::buildObject('DashboardController');
                break;
            case 'create-task':
            case 'new-task':
                $controller = Factory::buildObject('CreateTaskController');
                break;
            case 'login':
            case 'login-submit':
            default:
                $controller = Factory::buildObject('LoginController');
                break;
        }

        $controller->createHtmlOutput();

        $html_output = $controller->getHtmlOutput();
        return $html_output;
    }

    /**
     * Process the HTML output
     */
    private function processOutput(string $html_output)
    {
        $processed_html_output = '';
        $process_output = Factory::buildObject('ProcessOutput');
        $processed_html_output = $process_output->assembleOutput($html_output);
        return $processed_html_output;
    }

    public function getHtmlOutput()
    {
        return $this->html_output;
    }


}
