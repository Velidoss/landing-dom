<?php


use app\core\View;
class Route
{

    static function run()
    {
        //контроллер по умолчанию
        $controllerName = 'Main';
        $actionName = 'Index';
        $itemnum = '';

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
            View::errorCode(404);
        }
        $controller = new $controllerName;
        $action = $actionName;
        if (method_exists($controller, $action)) {        
            if (!empty($routes[3])) {
                $itemnum = $routes[3];
                $controller->$action($itemnum);
            }else{
                $controller->$action();
            }
            
        } else {
            View::errorCode(404);
        }
    }

}
