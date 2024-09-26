<?php

class EditProfileView extends DefaultView
{
    private $username;
    private $email;
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
    public function setUsername($username)
    {
        $this->username = $username;
    }
    public function setEmail($email)
    {
        $this->email = $email;
    }
    private function setPageTitle()
    {
        $this->page_title = 'Edit Profile';
    }

    public function getHtmlOutput()
    {
        return $this->html_page_output;
    }

    private function insertPageContent()
    {
        $address = APP_ROOT_PATH;
        $html_output = <<< HTML
<div class="edit-profile-container">
<h1>Edit Profile Details</h1>
<form class="edit-profile-form" action="$address" method="post">
<div>
<label for="username">Username:</label>
<input id="edit-username" class="edit-username" required type="text" name="username" value="$this->username">
</div>
<div>
<label for="email">Email:</label>
<input id="edit-username" class="edit-email" required type="email" name="email" value="$this->email">
</div>
<button class="confirm-edit-profile-btn" type="submit" name="route" value="change-profile">Confirm changes</button>
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