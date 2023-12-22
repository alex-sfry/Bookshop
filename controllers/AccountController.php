<?php

namespace App\Core;

use App\Model\User;
use App\Cart\Cart;

/**
 * [class AccountController]
 */
class AccountController extends Controller
{
    /**
     * @return bool
     */
    public function actionIndex(): bool
    {
        $user_obj = new User();

        $userId = $user_obj->checkLogged();

        $data = [
            'vars' => [
                'user' => $user_obj->getUserById($userId)
            ],
            'objects' => [
                'cart' => new Cart(),
            ]
        ];

        $view = ROOT . '/views/account/index.php';
        $title = 'Bookshop';

        $this->render($view, $data, $title);

        return true;
    }

    /**
     * @return bool
     */
    public function actionEdit(): bool
    {
        $user_obj = new User();

        $userId = $user_obj->checkLogged();
        $user = $user_obj->getUserById($userId);

        $name = $user['name'];
        $password = $user['password'];

        $errors = array();

        $result = false;

        if (isset($_POST['submit'])) {
            $name = $_POST['name'];
            $password = $_POST['password'];

            if (!$user_obj->checkName($name)) {
                $errors[] = 'Имя не должно быть короче 4-х символов';
            }

            if (!$user_obj->checkPassword($password)) {
                $errors[] = 'Пароль не должен быть короче 6-ти символов';
            }

            if (count($errors) == 0) {
                $result = $user_obj->edit($userId, $name, $password);
            }
        }

        $data = [
            'vars' => [
                'user' => $user_obj->getUserById($userId),
                'name' => $name,
                'password' => $password,
                'errors' => $errors,
                'result' => $result
            ],
            'objects' => [
                'cart' => new Cart(),
            ]
        ];

        $view = ROOT . '/views/account/edit.php';
        $title = 'Bookshop';

        $this->render($view, $data, $title);


        return true;
    }
}
