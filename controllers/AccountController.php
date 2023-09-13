<?php
namespace App\Core;
use App\Model\User;

class AccountController
{
    public function actionIndex()
    {
        $userId = User::checkLogged();

        $user = User::getUserById($userId);

        require_once(ROOT . '/views/account/index.php');

        return true;
    }

    public function actionEdit()
    {   
        $userId = User::checkLogged();
        $user = User::getUserById($userId);

        $name = $user['name'];
        $password = $user['password'];

        $errors = array();

        $result = false;
        
        if (isset($_POST['submit'])) {
            $name = $_POST['name'];
            $password = $_POST['password'];

            if (!User::checkName($name)) {
                $errors[] = 'Имя не должно быть короче 4-х символов';
            }

            if (!User::checkPassword($password)) {
                $errors[] = 'Пароль не должен быть короче 6-ти символов';
            }

            if (count($errors) == 0) {
                $result = User::edit($userId, $name, $password);
            }
        }

        require_once(ROOT . '/views/account/edit.php');
        
        return true;
    }
}