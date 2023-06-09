<?php

class User
{
    public static function register($name, $email, $password)
    {
        $db = DBConnect::getConnection();

        $name = htmlspecialchars($name);
        $email = htmlspecialchars($email);
        $password = htmlspecialchars($password);

        $sql = 'INSERT INTO user (name, email, password)
                VALUES (:name, :email, :password)';

        $result = $db->prepare($sql);
        $result->bindParam(':name', $name, PDO::PARAM_STR);
        $result->bindParam(':email', $email, PDO::PARAM_STR);
        $result->bindParam(':password', $password, PDO::PARAM_STR);

        return $result->execute();
    }

    public static function edit($id, $name, $password)
    {
        $db = DBConnect::getConnection();

        $id = htmlspecialchars($id);
        $name = htmlspecialchars($name);
        $password = htmlspecialchars($password);

        $sql = 'UPDATE user
                SET `name` = :name, `password` = :password
                WHERE id = :id';

        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->bindParam(':name', $name, PDO::PARAM_STR);
        $result->bindParam(':password', $password, PDO::PARAM_STR);

        return $result->execute();
    }

    public static function checkUserData($email, $password)
    {
        $db = DBConnect::getConnection();

        $email = htmlspecialchars($email);
        $password = htmlspecialchars($password);

        $sql = 'SELECT * 
                FROM user
                WHERE email = :email
                AND password = :password';

        $result = $db->prepare($sql);
        $result->bindParam(':email', $email, PDO::PARAM_STR);
        $result->bindParam(':password', $password, PDO::PARAM_STR);
        $result->execute();

        $user = $result->fetch();

        if ($user) {
            return $user['id'];
        } else return false;
    }

    public static function auth($userId)
    {
        $_SESSION['user'] = $userId;    
    }

    public static function checkLogged()
    {
        if (isset($_SESSION['user'])) {
            return $_SESSION['user'];
        }

        header("Location: /user/login");
    }

    public static function isGuest()
    {
        
        
        if (isset($_SESSION['user'])) {
            return false;
        } else return true;
    }


    public static function checkName($name)
    {
        if (strlen($name) >=4) {
            return true;
        } else return false;
    }

    public static function checkEmail($email)
    {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return true;
        } else return false;
    }

    public static function checkPassword($password)
    {
        if (strlen($password) >=6) {
            return true;
        } else return false;
    }

    public static function checkEmailExist($email) 
    {
        $db = DBConnect::getConnection();

        $sql = 'SELECT COUNT(*)
                FROM user
                WHERE email = :email';

        $result = $db->prepare($sql);
        $result->bindParam(':email', $email, PDO::PARAM_STR);

        $result->execute();

        if($result->fetchColumn()) {
            return true;
        } else return false;
    }

    public static function getUserById($id) 
    {
        $db = DBConnect::getConnection();

        $sql = 'SELECT *
                FROM user
                WHERE id = :id';

        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);

        $result->execute();

        return $result->fetch();
    }
}