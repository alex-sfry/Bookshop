<?php
namespace App\Core;
use App\Model\User;

class UserController
{  
    public function actionLogin()
    {   
        $user_obj = new User();
        
        $email = '';
        $password = '';

        $errors = array();

        $result = false;

        if (isset($_POST['submit'])) {
            $email = $_POST['email'];
            $password = $_POST['password'];

            if (!$user_obj->checkEmail($email)) {
                $errors[] = 'Неправильный email';
            }

            if (!$user_obj->checkPassword($password)) {
                $errors[] = 'Пароль не должен быть короче 6-ти символов';
            }

            $userId = $user_obj->checkUserData($email, $password);

            if ($userId == false) {
                $errors[] = 'Неправильные данные для входа на сайт';
            } else {
                $user_obj->auth($userId);
                header('Location: /account/');
            }
        }

        require_once(ROOT . '/views/user/login.php');

        return true;
    }

    public function actionRegister()
    {   
        $user_obj = new User();

        $name = '';
        $email = '';
        $password = '';

        $errors = array();

        $result = false;
        
        if (isset($_POST['submit'])) {
            $name = $_POST['name'];
            $email = $_POST['email'];
            $password = $_POST['password'];

            if (!$user_obj->checkName($name)) {
                $errors[] = 'Имя не должно быть короче 4-х символов';
            }

            if (!$user_obj->checkEmail($email)) {
                $errors[] = 'Неправильный email';
            }

            if (!$user_obj->checkPassword($password)) {
                $errors[] = 'Пароль не должен быть короче 6-ти символов';
            }

            if ($user_obj->checkEmailExist($email)) {
                $errors[] = 'Такой email уже используется';
            }

            if (count($errors) == 0) {
                $result = $user_obj->register($name, $email, $password);
            }
        }

        require_once(ROOT . '/views/user/register.php');

        return true;
    }
    public function actionLogout()
    {
        session_start();
        unset($_SESSION['user']);
        header('Location: /');
    }
}
