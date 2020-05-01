<?php

class User {

    /**
     * Проверяем существует ли пользователь с заданными $login и $password
     * @param string $login
     * @param string $password
     * @return mixed : ingeger user id or false
     */
    public static function checkUserData($login, $password) {
        $db = Db::getConnection();

        $sql = 'SELECT * FROM user WHERE login = :login AND password = :password';

        $result = $db->prepare($sql);
        $result->bindParam(':login', $login, PDO::PARAM_INT);
        $result->bindParam(':password', $password, PDO::PARAM_INT);
        $result->execute();

        $user = $result->fetch();
        if ($user) {
            return $user['id'];
        }

        return false;
    }

    /**
     * Запоминаем пользователя
     * @param string $email
     * @param string $password
     */
    public static function auth($userId) {

        $_SESSION['user'] = $userId;
    }


}
