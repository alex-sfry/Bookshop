<?php
namespace App\Core;
use App\Model\User;

class UserController
{   
    private $user_obj;
    
    public function __construct()
    {   
        $this->user_obj = new User();
    }

    public function actionLogin()
    {   
        $email = '';
        $password = '';

        $errors = array();

        $result = false;

        if (isset($_POST['submit'])) {
            $email = $_POST['email'];
            $password = $_POST['password'];

            if (!$this->user_obj->checkEmail($email)) {
                $errors[] = 'Неправильный email';
            }

            if (!$this->user_obj->checkPassword($password)) {
                $errors[] = 'Пароль не должен быть короче 6-ти символов';
            }

            $userId = $this->user_obj->checkUserData($email, $password);

            if ($userId == false) {
                $errors[] = 'Неправильные данные для входа на сайт';
            } else {
                $this->user_obj->auth($userId);
                header('Location: /account/');
            }
        }

        require_once(ROOT . '/views/user/login.php');

        return true;
    }

    public function actionRegister()
    {   
        $name = '';
        $email = '';
        $password = '';

        $errors = array();

        $result = false;
        
        if (isset($_POST['submit'])) {
            $name = $_POST['name'];
            $email = $_POST['email'];
            $password = $_POST['password'];

            if (!$this->user_obj->checkName($name)) {
                $errors[] = 'Имя не должно быть короче 4-х символов';
            }

            if (!$this->user_obj->checkEmail($email)) {
                $errors[] = 'Неправильный email';
            }

            if (!$this->user_obj->checkPassword($password)) {
                $errors[] = 'Пароль не должен быть короче 6-ти символов';
            }

            if ($this->user_obj->checkEmailExist($email)) {
                $errors[] = 'Такой email уже используется';
            }

            if (count($errors) == 0) {
                $result = $this->user_obj->register($name, $email, $password);
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
