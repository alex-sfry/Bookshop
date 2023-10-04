<?php
namespace App\Core;
use App\Model\User;

class AccountController
{
    public function actionIndex()
    {   
        $user_obj = new User();

        $userId = $user_obj->checkLogged();
        $user = $user_obj->getUserById($userId);

        require_once(ROOT . '/views/account/index.php');

        return true;
    }

    public function actionEdit()
    {   
        $user_obj = new User();

        $userId =$user_obj->checkLogged();
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
                $result =$user_obj->edit($userId, $name, $password);
            }
        }

        require_once(ROOT . '/views/account/edit.php');
        
        return true;
    }
}