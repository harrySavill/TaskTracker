<?php

class ChangePasswordView extends DefaultView
{
    private $error_msg;
    public function __construct()
    {
        parent::__construct();
    }
    public function __destruct(){}
    public function createPage()
    {
        $this->setPageTitle();
        $this->createDefaultPage();
        $this->insertPageContent();
        $this->finalizePage();
    }
    public function setErrorMessage($error_msg)
    {
        $this->error_msg = $error_msg;
    }
    private function setPageTitle()
    {
        $this->page_title = 'Change Password';
    }

    public function getHtmlOutput()
    {
        return $this->html_page_output;
    }

    private function insertPageContent()
    {
        $address = APP_ROOT_PATH;
        $html_output = <<< HTML
<div class="change-password-container">
<h1>Change Password</h1>
<form class="change-password-form" action="$address" method="post">
<div>
<label for="current-password">Current Password:</label>
<input id="current-password" class="current-password" required type="password" name="current-password">
</div>
<div>
<label for="new-password">New Password:</label>
<input id="new-password" class="new-password" required type="password" name="new-password">
</div>
<div>
<label for="confirm-password">Confirm New Password:</label>
<input id="confirm-password" class="confirm-password" required type="password" name="confirm-password">
</div>
<button class="confirm-change-password-btn" type="submit" name="route" value="change-password-confirm">Confirm changes</button>
<p class="error-message">$this->error_msg</p>
</form>
</div>
HTML;
        $this->html_page_output .= $html_output;
    }
    private function finalizePage()
    {
        $this->html_page_output .= '</body></html>';
    }
}