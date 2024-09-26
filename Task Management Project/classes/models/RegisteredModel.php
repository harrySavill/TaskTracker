<?php


class RegisteredModel
{
    private $database_handle;
    private $username;
    private $hashedPassword;
    private $email;
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
    public function setHashedPassword(string $hashedPassword)
    {
        $this->hashedPassword = $hashedPassword;
    }
    public function setEmail(string $email)
    {
        $this->email = $email;
    }

    public function registerUser(){
        $sql_query_string = SqlQuery::queryRegisterUser();
        $sql_query_parameters = [':username' => $this->username, ':email' => $this->email,':password' => $this->hashedPassword];
        $this->database_handle->safeQuery($sql_query_string, $sql_query_parameters);
    }


}