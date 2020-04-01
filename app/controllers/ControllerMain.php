<?php

use app\core\Controller;
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

    public function actionContact()
    {
        $this->view->generate('Contact.php', 'Layout.php');
    }
}
