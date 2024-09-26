<?php

class ProfileView extends DefaultView
{
    private $username;
    private $email;
    private $created_at;
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
    public function setCreatedAt($created_at)
    {
        $this->created_at = $created_at;
    }
    private function setPageTitle()
    {
        $this->page_title = 'Profile';
    }

    public function getHtmlOutput()
    {
        return $this->html_page_output;
    }

    private function insertPageContent()
    {
        $address = APP_ROOT_PATH;
        $html_output = <<< HTML
<main class="profile-main">
        <div class="profile-container">
            <h1>Your Account</h1>
            <div class="break-line"></div>
            <h3>Your Details</h2>
            <div class="detail-display">
                <div class="detail-left">
                    <p class="detail-desc">Username:</p>
                    <p>$this->username</p>
                </div>
                <div class="detail-right">
                    <form action="$address" method="post">
                        <button class="detail-edit-btn" type="submit" name="route" value="edit-username">Edit</button>
                    </form>
                </div>                
            </div>
            <div class="break-line"></div>
            <div class="detail-display">
                <div class="detail-left">
                    <p class="detail-desc">Email Address:</p>
                    <p>$this->email</p>
                </div>
                <div class="detail-right">
                    <form action="$address" method="post">
                        <button class="detail-edit-btn" type="submit" name="route" value="change-email">Edit</button>
                    </form>
                </div>                
            </div>
            <div class="break-line"></div>
            <div class="detail-display">
                <div class="detail-left">
                    <p class="detail-desc">Account Created:</p>
                    <p>$this->created_at</p>
                </div>               
            </div>
            <h3>Account Management</h3>
            <div class="detail-display">
                <div class="detail-left">
                    <p class="detail-desc">Reset Password</p>
                    <p>Reset the password of your TaskTracker account</p>
                </div>
                <div class="detail-right">
                    <form action="$address" method="post">
                        <button class="change-password-btn" type="submit" name="route" value="change-password">Change Password</button>
                    </form>
                </div>
            </div>
            <div class="break-line"></div>
            <div class="detail-display">
                <div class="detail-left">
                    <p class="detail-desc">Clear Tasklist</p>
                    <p>Delete all tasks from your account</p>
                </div>
                <div class="detail-right">
                    <form action="$address" method="post">
                        <button class="detail-delete-btn" type="submit" name="route" value="delete-tasks">Delete Tasks</button>
                    </form>
                </div>
            </div>
            <div class="break-line"></div>
            <div class="detail-display">
                <div class="detail-left">
                    <p class="detail-desc">Delete Account</p>
                    <p>Permanently delete your TaskTracker account</p>
                </div>
                <div class="detail-right">
                    <form action="$address" method="post">
                        <button class="detail-delete-btn" type="submit" name="route" value="delete-account">Delete Account</button>
                    </form>
                </div>
            </div>
        </div>
    </main>

HTML;
        $this->html_page_output .= $html_output;
    }

    private function finalizePage()
    {
        $this->html_page_output .= '</body></html>';
    }
}