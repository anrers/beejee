<?php

class SiteController {

    public function actionIndex($page = 1, $order = 'name_DESC') {
        
        $_SESSION['page'] = $page;
        $total = task::getTotalTask();
        if ((ceil($total / task::SHOW_BY_DEFAULT) - $page) < 0) {
            die('Данной страницы не существует');
            
        }
        if (isset($_SESSION['order'])){
            $order = $_SESSION['order'];
        }
        $task = array();
        $task = task::getLatestTask($page, $order);
        // Создаем объект Pagination - постраничная навигация
        $pagination = new Pagination($total, $page, task::SHOW_BY_DEFAULT, 'page-');


        require_once ROOT . '/views/index.php';

        return true;
    }

    public function actionAjax () {
        
        $options['name'] = $_POST['name'];
        $options['email'] = $_POST['email'];
        $options['task'] = $_POST['task'];
        
        $errors = false;
            
        if (!task::checkName($options['name'])) {
            $errors[] = 'Имя не должно быть короче 2-х символов';
        }

        if (!task::checkEmail($options['email'])) {
            $errors[] = 'Неправильный email';
        }

        if (!task::checkTask($options['task'])) {
            $errors[] = 'Задача не должна быть пустой';
        }

        if ($errors == false) {
            change::createTask($options);
            $status = array(
                'status' => 'ok',
            ); 
            echo json_encode($status);
        } else echo json_encode($errors);

        return true;
    }

    public function actionSort ($method) {
        
        $_SESSION['order'] = $method;
        header("Location: /page-".$_SESSION['page']);
        return true;
    }
    
    public function actionChange ($id) {
        
        if (!isset($_SESSION['user'])) {
            header("Location: /");
        }
        $task = task::getTask($id);
        require_once ROOT . '/views/change/task.php';

        return true;
    }
    
    public function actionUpdate ($id) {
        
        if (!isset($_SESSION['user'])) {
            header("Location:".ROOT);
        } else {
        $options['task'] = $_POST['task'];
        if (isset($_POST['checked'])) {
            $options['checked'] = 1;
        } else {
            $options['checked'] = 0;}
            
        change::updateTask($id, $options);
        header("Location: /");
        }
        return true;
    }
}
