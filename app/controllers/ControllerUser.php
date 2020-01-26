<?php

class ControllerUser extends Controller
{



    public function actionRegister()
    {
        $this->view->generate('Register.php', 'Layout.php');
        
    }
    public function actionLogin()
    {
        $this->view->generate('Login.php', 'Layout.php');
        
    }

}