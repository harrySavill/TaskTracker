<?php
/**
 * SqlQuery.php
 */

class SqlQuery
{

    public function __construct(){}

    public function __destruct(){}

    public static function queryRegisterUser()
    {
        $sql_query_string  = 'INSERT INTO users (username, email, password)';
        $sql_query_string .= ' VALUES (:username, :email, :password)';
        return $sql_query_string;
    }

    public static function queryGetPassword()
    {
        $sql_query_string = 'SELECT password FROM users WHERE username = :username';
        return $sql_query_string;
    }

    public static function queryGetUserDetails()
    {
        $sql_query_string = 'SELECT username, email, created_at FROM users WHERE username=:username';
        return $sql_query_string;
    }

    public static function queryDeleteUser()
    {
        $sql_query_string = 'DELETE FROM users WHERE username=:username';
        return $sql_query_string;
    }

    public static function queryGetUserId()
    {
        $sql_query_string = 'SELECT user_id FROM users WHERE username=:username';
        return $sql_query_string;
    }

    public static function queryCreateTask()
    {
        $sql_query_string = 'INSERT INTO tasks (user_id, task_name, description) VALUES (:user_id, :task_name, :description)';
        return $sql_query_string;
    }

    public static function queryDeleteAllTasks()
    {
        $sql_query_string = 'DELETE FROM tasks WHERE user_id=:user_id';
        return $sql_query_string;
    }

    public static function queryGetAllTasks()
    {
        $sql_query_string = 'SELECT task_id, task_name, status FROM tasks WHERE user_id=:user_id';
        return $sql_query_string;
    }

    public static function queryEditProfile()
    {
        $sql_query_string = 'UPDATE users SET username = :username, email = :email WHERE user_id=:user_id';
        return $sql_query_string;

    }
    public static function queryUpdatePassword()
    {
        $sql_query_string = 'UPDATE users SET password = :new_password WHERE username=:username';
        return $sql_query_string;
    }

    public static function queryDeleteTask()
    {
        $sql_query_string = 'DELETE FROM tasks WHERE task_id=:task_id';
        return $sql_query_string;
    }
    public static function queryReopenTask()
    {
        $sql_query_string = "UPDATE tasks SET status = 'pending' WHERE task_id=:task_id";
        return $sql_query_string;
    }
    public static function queryCompleteTask()
    {
        $sql_query_string = "UPDATE tasks SET status = 'completed' WHERE task_id=:task_id";
        return $sql_query_string;
    }
    public static function queryViewTask()
    {
        $sql_query_string = "SELECT * FROM tasks WHERE task_id=:task_id";
        return $sql_query_string;
    }
}
