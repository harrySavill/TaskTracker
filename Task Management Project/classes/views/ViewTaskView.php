<?php

class ViewTaskView extends DefaultView
{
    private $taskData;

    public function __construct()
    {
        parent::__construct();
    }

    public function __destruct() {}

    public function createPage()
    {
        $this->setPageTitle();
        $this->createDefaultPage();
        $this->insertPageContent();
        $this->finalizePage();
    }

    public function setTaskData($taskData)
    {
        $this->taskData = $taskData;
    }

    private function setPageTitle()
    {
        $this->page_title = 'View Task';
    }

    public function getHtmlOutput()
    {
        return $this->html_page_output;
    }

    private function insertPageContent()
    {
        $address = APP_ROOT_PATH;
        $taskName = htmlspecialchars($this->taskData['task_name']);
        $description = htmlspecialchars($this->taskData['description']);
        $status = htmlspecialchars($this->taskData['status']);
        $createdAt = htmlspecialchars($this->taskData['created_at']);
        $updatedAt = htmlspecialchars($this->taskData['updated_at']);

        $html_output = <<<HTML
        <div class="view-task-container">
            <h1 class="task-title">Task: $taskName</h1>
            <div class="task-details">
                <p class="task-description"><strong>Description:</strong> $description</p>
                <p class="task-status"><strong>Status:</strong> $status</p>
                <p class="task-created"><strong>Created:</strong> $createdAt</p>
                <p class="task-updated"><strong>Last Updated:</strong> $updatedAt</p>
                <form class="view-task-form" action="$address" method="post">
                    <button class="back-to-dashboard-btn" type="submit" name="route" value="dashboard">Back to Dashboard</button>
                </form>
            </div>
        </div>
HTML;

        $this->html_page_output .= $html_output;
    }

    private function finalizePage()
    {
        $this->html_page_output .= '</body></html>';
    }
}
