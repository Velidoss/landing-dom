<?php

class ControllerMain extends Controller
{

    public function __construct()
    {
    }

    public function actionIndex()
    {
        $this->view->generate('Main.php', 'Layout.php');
    }
}
