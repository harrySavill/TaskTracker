<?php

class CreateTaskModel
{
    private $database_handle;
    private $username;
    private $userId;
    private $taskName;
    private $taskDescription;

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
    public function setTaskName($taskName)
    {
        $this->taskName = $taskName;
    }
    public function setTaskDescription($taskDescription)
    {
        $this->taskDescription = $taskDescription;
    }
    public function setUserId()
    {
        $sql_query_string = SqlQuery::queryGetUserId();
        $sql_query_parameters = [':username' => $this->username];
        $this->database_handle->safeQuery($sql_query_string, $sql_query_parameters);
        $this->userId = $this->database_handle->safeFetchArray()['user_id'];

    }

    public function createTask(){
        $sql_query_string = SqlQuery::queryCreateTask();
        $sql_query_parameters = [':user_id' => $this->userId, ':task_name' => $this->taskName, ':description' => $this->taskDescription];
        $this->database_handle->safeQuery($sql_query_string, $sql_query_parameters);

    }
}