<?php

class ChangePasswordModel
{
 private $database_handle;
 private $username;
 private $current_password;
 private $new_password;

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
 public function setCurrentPassword($current_password)
 {
     $this->current_password = $current_password;
 }
 public function setNewPassword($new_password)
 {
     $this->new_password = $new_password;
 }

 public function verifyCurrentPassword(){
     $sql_query_string = SqlQuery::queryGetPassword();
     $sql_query_parameters = [':username' => $this->username];
     $this->database_handle->safeQuery($sql_query_string, $sql_query_parameters);
     $result = $this->database_handle->safeFetchArray();

     if ($result){
         $storedPasswordHashed = $result["password"];
         if (password_verify($this->current_password, $storedPasswordHashed)){
             return true;
         }
         else return false;
 }
 }

 public function updatePassword()
 {
     $sql_query_string = SqlQuery::queryUpdatePassword();
     $sql_query_parameters = [':username' => $this->username, ':new_password' => $this->new_password];
     $this->database_handle->safeQuery($sql_query_string, $sql_query_parameters);
     $result = $this->database_handle->safeFetchArray();
 }
}