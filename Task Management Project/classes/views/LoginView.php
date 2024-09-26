<?php
/**
 * LoginView.php
 *
 */

class LoginView
{
    protected $page_title;
    protected $html_page_output;
    protected $error_message;

    public function __construct()
    {
        $this->page_title = '';
        $this->html_page_output = '';
        $this->error_message = '';
    }

    public function createPage()
    {
        $this->setPageTitle();
        $this->createWebPageMetaHeadings();
        $this->insertPageContent();
        $this->createWebPageFooter();
    }

    public function getHtmlOutput()
    {
        return $this->html_page_output;
    }

    private function setPageTitle()
    {
        $this->page_title = 'Task Management Login';
    }
    public function setErrorMessage($error_message)
    {
        $this->error_message = $error_message;
    }

    private function createWebPageMetaHeadings()
    {
        $css_filename = CSS_PATH . CSS_FILE_NAME;
        $html_output = <<< HTML
<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" href="$css_filename" type="text/css" />
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>$this->page_title</title>
</head>
<body class="login-body">
HTML;
        $this->html_page_output .= $html_output;
    }

    private function insertPageContent()
    {
        $address = APP_ROOT_PATH;
        $html_output = <<< HTML
<body class="login-body">
    <div class="login-container">
        <h1>Login</h1>
        <form action="$address" method="POST">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>
            
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
            
            <button class="login-button" type="submit" name="route" value="login-submit">Login</button>
        </form>
        <br>
        <p class="error-message">$this->error_message</p>
        <br>
        <form action="$address" method="POST">
        <p>Don't have an account?</p>
        <button class ="register-button" type="submit" name="route" value="register">Register</button>
</form>
    </div>
HTML;
        $this->html_page_output .= $html_output;
    }

    private function createWebPageFooter()
    {
        $html_output = <<< HTML
</body>
</html>
HTML;
        $this->html_page_output .= $html_output;
    }
}

