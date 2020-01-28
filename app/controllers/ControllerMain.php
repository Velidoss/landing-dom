<?php

class ControllerMain extends Controller
{



    public function actionIndex()
    {
        $this->view->generate('Main.php', 'Layout.php');
        
    }
    public function actionAbout()
    {
        $this->view->generate('About.php', 'Layout.php');
        
    }
}
