<?php
/**
 * LoginView.php
 *
 */

class RegisteredView
{
    protected $page_title;
    protected $html_page_output;

    public function __construct()
    {
        $this->page_title = '';
        $this->html_page_output = '';
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
        $this->page_title = 'Registered Successfully';
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
<body>
HTML;
        $this->html_page_output .= $html_output;
    }

    private function insertPageContent()
    {
        $address = APP_ROOT_PATH;
        $html_output = <<< HTML
<body class="register-body">
    <div class="register-container">
        <form action="$address" method="POST">
            <label for="login-button">Congratulations, you have successfully registered!</label>
            <button class="login-button" type="submit" name="route" value="login">Login</button>
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

