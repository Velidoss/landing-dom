<?php

class Controller
{
    public $model;
    public $view;

    public function __construct()
    {
        $this->view = new View();
        echo 'создан обект класса view';
    }
    public function actionIndex()
    {
    }
}
