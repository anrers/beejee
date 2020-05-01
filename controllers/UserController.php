<?php

class UserController
{

    public function actionLogin() {
        $login = '';
        $password = '';

        if (isset($_POST['submit'])) {
            $login  = $_POST['login'];
            $password = $_POST['password'];

            $errors = false;

            // Проверяем существует ли пользователь
            $userId = User::checkUserData($login, $password);

            if ($userId == false) {
                // Если данные неправильные - показываем ошибку
                $errors[] = 'Неправильные данные для входа на сайт';
            } else {
                // Если данные правильные, запоминаем пользователя (сессия)
                User::auth($userId);

                header("Location: /");
            }
        }

        require_once(ROOT . '/views/user/login.php');

        return true;
    }
    
    public function actionLogout()
    {
        // Удаляем информацию о пользователе из сессии
        unset($_SESSION["user"]);
        
        // Перенаправляем пользователя на главную страницу
        header("Location: /");
    }

}
