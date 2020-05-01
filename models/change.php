<?php

class change {
    
    public static function createTask($options)
    {
        // Соединение с БД
        $db = Db::getConnection();

        // Текст запроса к БД
        $sql = 'INSERT INTO task '
                . '(name, email, task, checked, edit)'
                . 'VALUES '
                . '(:name, :email, :task, 0, 0)';

        // Получение и возврат результатов. Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':name', $options['name'], PDO::PARAM_STR);
        $result->bindParam(':email', $options['email'], PDO::PARAM_STR);
        $result->bindParam(':task', $options['task'], PDO::PARAM_STR);
        if ($result->execute()) {
            // Если запрос выполенен успешно, возвращаем id добавленной записи
            return $db->lastInsertId();
        }
        // Иначе возвращаем 0
        return 0;
    }
    
    public static function updateTask($id, $options)
        {
            // Соединение с БД
            $db = Db::getConnection();

            // Текст запроса к БД
            $sql = "UPDATE task
                SET 
                    task = :task, 
                    checked = :checked,
                    edit = 1
                WHERE id = :id";

            // Получение и возврат результатов. Используется подготовленный запрос
            $result = $db->prepare($sql);
            $result->bindParam(':id', $id, PDO::PARAM_INT);
            $result->bindParam(':task', $options["task"], PDO::PARAM_STR);
            $result->bindParam(':checked', $options["checked"], PDO::PARAM_STR);
            return $result->execute();
        }

}