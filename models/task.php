<?php

class task {

    const SHOW_BY_DEFAULT = 3;

    public static function getLatestTask($page = 1, $order = 'name_DESC') { 
        $order = explode('_', $order);
        $page = intval($page);      //номер страницы сайта
        $offset = ($page - 1) * self::SHOW_BY_DEFAULT; //отступ выборки в базе данных
        $db = Db::getConnection();
        $taskList = array();
        $result = $db->query("SELECT id, name, email, task, checked, edit FROM task ORDER BY $order[0] $order[1] LIMIT "
                . self::SHOW_BY_DEFAULT . " OFFSET $offset");
        $i = 0;
        while ($row = $result->fetch()) {
            $taskList[$i]['id'] = $row['id'];
            $taskList[$i]['name'] = $row['name'];
            $taskList[$i]['email'] = $row['email'];
            $taskList[$i]['task'] = $row['task'];
            $taskList[$i]['checked'] = $row['checked'];
            $taskList[$i]['edit'] = $row['edit'];
            $i++;
        }
        return $taskList;
    }


    public static function getTask($id) { //получаем конкретную задачу

        $id = intval($id);
        if ($id) {
            $db = Db::getConnection();
            $result = $db->query("SELECT * FROM task WHERE id='$id'");
            $result->setFetchMode(PDO::FETCH_ASSOC);
            return $result->fetch();
        }
    }

       public static function getTotalTask() {                                               
        $db = Db::getConnection();

        $result = $db->query('SELECT count(id) AS count FROM task');
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $row = $result->fetch();
        return $row['count'];
    }
    
    public static function checkName($name) {
        if (strlen($name) >= 2) {
            return true;
        }
        return false;
    }
    
    public static function checkEmail($email) {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return true;
        }
        return false;
    }
    
    public static function checkTask($task) {
        if (strlen($task) >= 2) {
            return true;
        }
        return false;
    }

}
