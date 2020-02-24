<?php

namespace app\core;

class View
{
    public function generate($contentView, $templateView, $data = null)
    {
        include 'app/views/' . $templateView;
    }
    public static function errorCode($code){
        http_response_code($code);
        $path = 'app/views/' . $code . '.php';
        if (file_exists($path)) {
            require $path;
        }
        exit();
    }
    public function redirect($url){
        header("Location: /");
        exit();
    }

    public function message($status, $message){
        exit(json_encode(['status'=>$status , 'message'=>$message]));
    }

}
