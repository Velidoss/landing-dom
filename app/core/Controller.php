<?php

namespace app\core;

use app\core\View;

class Controller
{
    public $model;
    public $view;

    public function __construct()
    {
        
        $this->view = new View();
    }

}
