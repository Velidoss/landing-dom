<?php

use app\core\View;

class ControllerMain extends Controller
{



    public function actionIndex()
    {
        $this->view->generate('Main.php', 'Layout.php');
        
    }
    public function actionError404()
    {
        $this->view->generate('404.php', 'Layout.php');
        
    }
}
