<?php

class DashboardModel
{
    private $database_handle;
    private $username;
    private $userId;
    private $taskId;
    private $taskData;

    public function __construct()
    {
        $this->database_handle = null;
    }
    public function __destruct(){}
    public function setDatabaseHandle($obj_database_handle)
    {
        $this->database_handle = $obj_database_handle;
    }

    public function setUsername($username)
    {
        $this->username = $username;
    }
    public function setTaskId($taskId)
    {
        $this->taskId = $taskId;
    }
    private function setTaskData($taskData)
    {
        $this->taskData = $taskData;
    }
    public function getTaskData()
    {
        return $this->taskData;
    }
    public function setUserId()
    {
        $sql_query_string = SqlQuery::queryGetUserId();
        $sql_query_parameters = [':username' => $this->username];
        $this->database_handle->safeQuery($sql_query_string, $sql_query_parameters);
        $this->userId = $this->database_handle->safeFetchArray()['user_id'];

    }
    public function deleteTask(){
        $sql_query_string = SqlQuery::queryDeleteTask();
        $sql_query_parameters = [':task_id' => $this->taskId];
        $this->database_handle->safeQuery($sql_query_string, $sql_query_parameters);
    }
    public function completeTask(){
        $sql_query_string = SqlQuery::queryCompleteTask();
        $sql_query_parameters = [':task_id' => $this->taskId];
        $this->database_handle->safeQuery($sql_query_string, $sql_query_parameters);
    }
    public function viewTask(){
        $sql_query_string = SqlQuery::queryViewTask();
        $sql_query_parameters = [':task_id' => $this->taskId];
        $this->database_handle->safeQuery($sql_query_string, $sql_query_parameters);
        $this->taskData = $this->database_handle->safeFetchArray();

    }
    public function reopenTask(){
        $sql_query_string = SqlQuery::queryReopenTask();
        $sql_query_parameters = [':task_id' => $this->taskId];
        $this->database_handle->safeQuery($sql_query_string, $sql_query_parameters);
    }

    public function getAllTasks()
    {
        $tasks =[];
        $sql_query_string = SqlQuery::queryGetAllTasks();
        $sql_query_parameters = [':user_id' => $this->userId];
        $this->database_handle->safeQuery($sql_query_string, $sql_query_parameters);

        while ($row = $this->database_handle->safeFetchArray()) {
            $tasks[] = [
                'task-id' => $row['task_id'],
                'task-name' => $row['task_name'],
                'status' => $row['status']
            ];
        }
        return $tasks;
    }
}