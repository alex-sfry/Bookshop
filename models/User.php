<?php

namespace App\Model;

use DBConnect\DBConnect;

/**
 * [class User]
 */
class User
{
    /**
     * @param string $name
     * @param string $email
     * @param string $password
     *
     * @return bool
     */
    public function register(string $name, string $email, string $password): bool
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

    /**
     * @param int $id
     * @param string $name
     * @param string $password
     *
     * @return bool
     */
    public function edit(int $id, string $name, string $password): bool
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

    /**
     * @param string $email
     * @param string $password
     *
     * @return int
     * @return bool
     */
    public function checkUserData(string $email, string $password): int | bool
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
        } else {
            return false;
        }
    }

    /**
     * @param int $userId
     *
     * @return void
     */
    public function auth(int $userId): void
    {
        $_SESSION['user'] = $userId;
    }

    /**
     * @return int
     */
    public function checkLogged(): int
    {
        if (isset($_SESSION['user'])) {
            return $_SESSION['user'];
        }

        header("Location: /user/login");
    }

    /**
     * @return bool
     */
    public static function isGuest(): bool
    {
        if (isset($_SESSION['user'])) {
            return false;
        } else {
            return true;
        }
    }


    /**
     * @param string $name
     *
     * @return bool
     */
    public function checkName(string $name): bool
    {
        if (strlen($name) >= 4) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * @param string $email
     *
     * @return bool
     */
    public function checkEmail(string $email): bool
    {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * @param string $password
     *
     * @return bool
     */
    public function checkPassword(string $password): bool
    {
        if (strlen($password) >= 6) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * @param string $email
     *
     * @return bool
     */
    public function checkEmailExist(string $email): bool
    {
        $db = new DBConnect();
        $conn = $db->getConnection();

        $sql = 'SELECT COUNT(*)
                FROM user
                WHERE email = :email';

        $result = $conn->prepare($sql);
        $result->bindParam(':email', $email, \PDO::PARAM_STR);

        $result->execute();

        if ($result->fetchColumn()) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * @param int $id
     *
     * @return bool
     */
    public function getUserById(int $id): bool
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
