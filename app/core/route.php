<?php

class Route
{

    static function run()
    {
        //контроллер по умолчанию
        $controllerName = 'Main';
        $actionName = 'Index';

        $routes = explode('/', $_SERVER['REQUEST_URI']);

        if (!empty($routes[1])) {
            $controllerName = $routes[1];
        }
        if (!empty($routes[2])) {
            $actionName = $routes[2];
        }

        $modelName = 'Model' . ucfirst($controllerName);
        $controllerName = 'Controller' . ucfirst($controllerName);
        $actionName = 'action' . ucfirst($actionName);
        var_dump($actionName);

        $modelFile = ucfirst($modelName) . '.php';
        $modelPath = "app/models/" . ucfirst($modelFile);
        if (file_exists($modelPath)) {
            include_once 'app/models/' . ucfirst($modelFile);
        }

        $controllerFile = ucfirst($controllerName) . '.php';
        $controllerPath = "app/controllers/" . ucfirst($controllerFile);

        if (file_exists($controllerPath)) {
            include_once 'app/controllers/' . ucfirst($controllerFile);
        } else {
            Route::errorPage404();
        }
        $controller = new $controllerName;
        $action = $actionName;
        if (method_exists($controller, $action)) {
            $controller->$action();
        } else {
            Route::errorPage404();
        }
    }
    function errorPage404()
    {
        $host = 'http://' . $_SERVER['HTTP_HOST'] . '/';
        header('HTTP/1.1 404 Not Found');
        header("Status: 404 Not Found");
        header('Location' . $host . '404');
    }
}
