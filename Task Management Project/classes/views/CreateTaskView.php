<?php

class CreateTaskView extends DefaultView
{
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

    private function setPageTitle()
    {
        $this->page_title = 'Create Task';
    }

    public function getHtmlOutput()
    {
        return $this->html_page_output;
    }

    private function insertPageContent()
    {
        $address = APP_ROOT_PATH;
        $html_output = <<< HTML
    <main class="new-task-main">
        <div class="create-task-div">
        <h2>Create Task</h2>
            <form class="create-task-form" action="$address" method="post">
                <div class="task-name-div">
                    <label for="task-name">Task Name: </label>
                    <input required type="text" name="task-name" id="task-name">
                </div>
                <div class="task-desc-div">
                    <label for="task-desc">Task Description: </label>
                    <textarea placeholder="Optional (write desctiption here)" name="task-desc" id="task-desc" cols="30" rows="10"></textarea>
                </div>
                <button type="submit" name="route" value="create-task">Create</button>
            </form>
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