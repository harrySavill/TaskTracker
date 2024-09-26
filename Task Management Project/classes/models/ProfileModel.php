<?php

class ProfileModel
{
    private $database_handle;
    private $username;
    private $email;
    private $created_at;
    private $userId;

    public function __construct()
    {
        $this->database_handle = null;
    }
    public function __destruct(){}
    public function setDatabaseHandle($obj_database_handle)
    {
        $this->database_handle = $obj_database_handle;
    }
    public function setUsername(string $username)
    {
        $this->username = $username;
    }
    public function setEmail(string $email)
    {
        $this->email = $email;
    }
    public function setCreatedAt(string $created_at)
    {
        $this->created_at = $created_at;
    }

    public function getUserDetails()
    {
        $sql_query_string = SqlQuery::queryGetUserDetails();
        $sql_query_parameters = [':username' => $this->username];
        $this->database_handle->safeQuery($sql_query_string, $sql_query_parameters);
        $result = $this->database_handle->safeFetchArray();

        return $result;
    }
    public function setUserId()
    {
        $sql_query_string = SqlQuery::queryGetUserId();
        $sql_query_parameters = [':username' => $this->username];
        $this->database_handle->safeQuery($sql_query_string, $sql_query_parameters);
        $this->userId = $this->database_handle->safeFetchArray()['user_id'];

    }

    public function deleteUser()
    {
        $sql_query_string = SqlQuery::queryDeleteUser();
        $sql_query_parameters = [':username' => $this->username];
        $this->database_handle->safeQuery($sql_query_string, $sql_query_parameters);

    }

    public function deleteAllTasks()
    {
        $sql_query_string = SqlQuery::queryDeleteAllTasks();
        $sql_query_parameters = [':user_id' => $this->userId];
        $this->database_handle->safeQuery($sql_query_string, $sql_query_parameters);
    }


}