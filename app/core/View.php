<?php

class View
{
    function generate($contentView, $templateView, $data = null)
    {
        // if(is_array($data)) {
        // 	// преобразуем элементы массива в переменные
        // 	extract($data);
        // }
        // $viewPath = 'app/views/' . $templateView;
        // // $contentPath = 'app/views/' . $contentView;
        // var_dump($viewPath);
        // if (file_exists($viewPath)) {
        //     include $viewPath;
        //     echo 'есть такое';
        // } else {
        //     echo 'хуй тебе';
        // }
        include 'app/views/' . $templateView;
    }
}
