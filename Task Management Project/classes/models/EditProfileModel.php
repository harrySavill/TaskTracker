<?php

class EditProfileModel
{
    private $database_handle;
    private $username;
    private $email;
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

    public function setUserId()
    {
        $sql_query_string = SqlQuery::queryGetUserId();
        $sql_query_parameters = [':username' => $this->username];
        $this->database_handle->safeQuery($sql_query_string, $sql_query_parameters);
        $this->userId = $this->database_handle->safeFetchArray()['user_id'];

    }

    public function editProfile()
    {
        $sql_query_string = SqlQuery::queryEditProfile();
        $sql_query_parameters = [':username' => $this->username, ':email' => $this->email,':user_id' => $this->userId];
        $this->database_handle->safeQuery($sql_query_string, $sql_query_parameters);
    }
}