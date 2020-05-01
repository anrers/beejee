<?php

class router {

    private $routes;

    public function __construct() {
        $routesPath = ROOT . '/config/routes.php';
        $this->routes = include ($routesPath);
    }

    private function getUri() {                 //возвращает строку запроса
        if (!empty($_SERVER['REQUEST_URI'])) {
            return $uri = trim($_SERVER['REQUEST_URI'], '/'); //возвращаем запрос
        }
    }

    public function run() {
        $uri = $this->getUri();
        foreach ($this->routes as $uriPattern => $path) {   //получаем пути из routes
            if (preg_match("~$uriPattern~", $uri)) {      //проверяет совподение запроса с путем
                $internalRoute = preg_replace("~$uriPattern~", $path, $uri); //возвращает адрес запрошенной страницы
                $segments = explode('/', $internalRoute);
                $controllerName = array_shift($segments) . 'Controller'; //получение имени controller`a(класса), удаление его из массива
                $controllerName = ucfirst($controllerName);
                $actionName = 'action' . ucfirst(array_shift($segments)); //получение метода action(варианта отображения)
                $parameters = $segments;
                $controllerFile = ROOT . '/controllers/' . $controllerName . '.php'; //получение пути к файлу
                if (file_exists($controllerFile)) {
                    include_once ($controllerFile); //подключение найденного файла
                }
                $controllerObject = new $controllerName; // создание объекта класса, соответсвующего нашему запросу
                if (!method_exists($controllerObject, $actionName)) { // перенаправление при ошибке пути
                    header("Location: /");
                }
                $result = call_user_func_array(array($controllerObject, $actionName), $parameters); //запрос метода у созданного объекта класса
                if ($result != null) {                                                              // с передаче параметров $parameters
                    break;
                }
            }
        }
    }

}
