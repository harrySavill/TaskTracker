<?php
class DashboardView extends DefaultView
{
    private $taskArray;

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

    public function setTaskArray($taskArray)
    {
        $this->taskArray = $taskArray;
    }

    private function setPageTitle()
    {
        $this->page_title = 'Dashboard';
    }

    public function getHtmlOutput()
    {
        return $this->html_page_output;
    }

    private function insertPageContent()
    {
        $address = APP_ROOT_PATH;
        $username = $_SESSION['username'];
        $html_output = "<h1 class='welcome-msg'>Welcome, $username</h1>";

        $html_output .= '<div class="dashboard-container">';
        $html_output .= '<div class="tasks-section"><h2>Pending Tasks</h2>';

        if (is_array($this->taskArray) && !empty($this->taskArray)) {
            $pendingTasksExist = false;
            foreach ($this->taskArray as $task) {
                if ($task['status'] === 'pending') {
                    $pendingTasksExist = true;
                    $html_output .= '<div class="task pending-task">';
                    $html_output .= '<span class="task-name">' . htmlspecialchars($task['task-name']) . '</span>';
                    $html_output .= '<form action="' . $address . '" method="POST">';
                    $html_output .= '<input type="hidden" name="task-id" value="' . $task['task-id'] . '">';
                    $html_output .= '<button class="view-btn" name="route" value="view-task"> View</button>';
                    $html_output .= '<button class="complete-btn" name="route" value="complete-task">Complete</button>';
                    $html_output .= '<button class="delete-btn" name="route" value="delete-task">Delete</button>';
                    $html_output .= '</form></div>';
                }
            }
            if (!$pendingTasksExist) {
                $html_output .= '<p>You have no pending tasks.</p>';
            }
        } else {
            $html_output .= '<p>You have no pending tasks.</p>';
        }

        $html_output .= '</div>';
        $html_output .= '<div class="tasks-section"><h2>Completed Tasks</h2>';

        if (is_array($this->taskArray) && !empty($this->taskArray)) {
            $completedTasksExist = false;
            foreach ($this->taskArray as $task) {
                if ($task['status'] === 'completed') {
                    $completedTasksExist = true;
                    $html_output .= '<div class="task completed-task">';
                    $html_output .= '<span class="task-name">' . htmlspecialchars($task['task-name']) . '</span>';
                    $html_output .= '<form action="' . $address . '" method="POST">';
                    $html_output .= '<input type="hidden" name="task-id" value="' . $task['task-id'] . '">';
                    $html_output .= '<button class="view-btn" name="route" value="view-task">View</button>';
                    $html_output .= '<button class="reopen-btn" name="route" value="reopen-task">Reopen</button>';
                    $html_output .= '<button class="delete-btn" name="route" value="delete-task">Delete</button>';
                    $html_output .= '</form></div>';
                }
            }
            if (!$completedTasksExist) {
                $html_output .= '<p>You have no completed tasks.</p>';
            }
        } else {
            $html_output .= '<p>You have no completed tasks.</p>';
        }

        $html_output .= '</div>';
        $html_output .= '</div>';

        $this->html_page_output .= $html_output;
    }

    private function finalizePage()
    {
        $this->html_page_output .= '</body></html>';
    }
}