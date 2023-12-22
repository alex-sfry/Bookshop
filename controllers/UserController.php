<?php

namespace App\Core;

use App\Model\User;
use App\Cart\Cart;

/**
 * [Class UserController]
 */
class UserController extends Controller
{
    /**
     * @return bool
     */
    public function actionLogin(): bool
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

            $userId = $user_obj->checkUserData($email, $password);

            if ($userId == false) {
                $errors[] = 'Неправильные данные для входа на сайт';
            } else {
                $user_obj->auth($userId);
                header('Location: /account/');
            }
        }

        $data = [
            'vars' => [
                'email' => $email,
                'password' => $password,
                'errors' => $errors,
                'result' => $result
            ],
            'objects' => [
                'cart' => new Cart(),
            ]
        ];

        $view = ROOT . '/views/user/login.php';
        $title = 'Bookshop';

        $this->render($view, $data, $title);

        return true;
    }

    /**
     * @return bool
     */
    public function actionRegister(): bool
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

        $data = [
            'vars' => [
                'name' => $name,
                'email' => $email,
                'password' => $password,
                'errors' => $errors,
                'result' => $result
            ],
            'objects' => [
                'cart' => new Cart(),
            ]
        ];

        $view = ROOT . '/views/user/register.php';
        $title = 'Bookshop';

        $this->render($view, $data, $title);

        return true;
    }

    /**
     * @return void
     */
    public function actionLogout(): void
    {
        session_start();
        unset($_SESSION['user']);
        header('Location: /');
    }
}
