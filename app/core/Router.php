<?php

namespace app\core;

use app\core\View;

class Router{
    
    public $routes=[];
    public $params=[];
    

    public function __construct()
    {
        $arr = require_once('app/config/routes.php');
        foreach($arr as $key => $val){
            $this->addRoute($key, $val);
        }
    }

    public function addRoute($route, $params)
    {
        $route = preg_replace('/{([a-z]+):([^\}]+)}/', '(?P<\1>\2)', $route);
        $route = '#^'.$route.'$#';
        $this->routes[$route] = $params;
    }

    public function match() {
        $url = trim($_SERVER['REQUEST_URI'], '/');
        foreach ($this->routes as $route => $params) {
            if (preg_match($route, $url, $matches)) {
                foreach ($matches as $key => $match) {
                    if (is_string($key)) {
                        if (is_numeric($match)) {
                            $match = (int) $match;
                        }
                        $params[$key] = $match;
                    }
                }
                $this->params = $params;
                return true;
            }
        }
        return false;
    }

    public function run(){
        if ($this->match()) {
            $path = 'app\controllers\\Controller'.ucfirst($this->params['controller']); 
            file_put_contents('123.json', $path);
            if (class_exists($path)) {
                $action = 'action'.ucfirst($this->params['action']);
               
                if (method_exists($path, $action)) {
                    $controller = new $path($this->params);
                    $controller->$action();
                } else {
                    //View::errorCode(404);
                die('no method');}
            } else {
                //View::errorCode(404);
            die('no class');}
        } else {
            //View::errorCode(404);
        die('no match');}
    }

}