<?php

class UserController
{
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

            if (!USER::checkName($name)) {
                $errors[] = 'Имя не должно быть короче 4-х символов';
            }

            if (!USER::checkEmail($email)) {
                $errors[] = 'Неправильный email';
            }

            if (!USER::checkPassword($password)) {
                $errors[] = 'Пароль не должен быть короче 6-ти символов';
            }

            if (USER::checkEmailExist($email)) {
                $errors[] = 'Такой email уже используется';
            }

            if (count($errors) == 0) {
                $result = User::register($name, $email, $password);
            }
        }

        

        require_once(ROOT . '/views/user/register.php');

        return true;
    }
}
