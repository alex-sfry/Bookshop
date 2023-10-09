<?php
namespace App\Model;
use DBConnect\DBConnect;

class User
{
    public function register($name, $email, $password)
    {
        $db = new DBConnect();
        $conn = $db->getConnection();

        $name = htmlspecialchars($name);
        $email = htmlspecialchars($email);
        $password = htmlspecialchars($password);
        $password = password_hash($password, PASSWORD_BCRYPT);

        $sql = 'INSERT INTO user (name, email, password)
                VALUES (:name, :email, :password)';

        $result = $conn->prepare($sql);
        $result->bindParam(':name', $name, \PDO::PARAM_STR);
        $result->bindParam(':email', $email, \PDO::PARAM_STR);
        $result->bindParam(':password', $password, \PDO::PARAM_STR);

        return $result->execute();
    }

    public function edit($id, $name, $password)
    {
        $db = new DBConnect();
        $conn = $db->getConnection();

        $id = htmlspecialchars($id);
        $name = htmlspecialchars($name);
        $password = htmlspecialchars($password);

        $sql = 'UPDATE user
                SET `name` = :name, `password` = :password
                WHERE id = :id';

        $result = $conn->prepare($sql);
        $result->bindParam(':id', $id, \PDO::PARAM_INT);
        $result->bindParam(':name', $name, \PDO::PARAM_STR);
        $result->bindParam(':password', $password, \PDO::PARAM_STR);

        return $result->execute();
    }

    public function checkUserData($email, $password)
    {
        $db = new DBConnect();
        $conn = $db->getConnection();

        $email = htmlspecialchars($email);
        $password = htmlspecialchars($password);

        $sql = 'SELECT * 
                FROM user
                WHERE email = :email
                ';

        $result = $conn->prepare($sql);
        $result->bindParam(':email', $email, \PDO::PARAM_STR);
        $result->execute();

        $user = $result->fetch();

        if ($user && password_verify($password, $user['password'])) {
            return $user['id'];
        } else return false;
    }

    public function auth($userId)
    {
        $_SESSION['user'] = $userId;    
    }

    public function checkLogged()
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


    public function checkName($name)
    {
        if (strlen($name) >=4) {
            return true;
        } else return false;
    }

    public function checkEmail($email)
    {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return true;
        } else return false;
    }

    public function checkPassword($password)
    {
        if (strlen($password) >=6) {
            return true;
        } else return false;
    }

    public function checkEmailExist($email) 
    {
        $db = new DBConnect();
        $conn = $db->getConnection();

        $sql = 'SELECT COUNT(*)
                FROM user
                WHERE email = :email';

        $result = $conn->prepare($sql);
        $result->bindParam(':email', $email, \PDO::PARAM_STR);

        $result->execute();

        if($result->fetchColumn()) {
            return true;
        } else return false;
    }

    public function getUserById($id) 
    {
        $db = new DBConnect();
        $conn = $db->getConnection();

        $sql = 'SELECT *
                FROM user
                WHERE id = :id';

        $result = $conn->prepare($sql);
        $result->bindParam(':id', $id, \PDO::PARAM_INT);

        $result->execute();

        return $result->fetch();
    }
}