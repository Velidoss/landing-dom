<?php

require_once 'app/models/ModelUser.php';

class ControllerUser extends Controller
{

    public function __construct()
    {
        $this->model = new ModelUser;
        $this->view = new View;
    }


    public function actionRegister()
    {
        $this->view->generate('Register.php', 'Layout.php');
        
    }
    public function actionLogin()
    {
        $this->view->generate('Login.php', 'Layout.php');
        
    }

    public function actionRegisterUser(){
        $errors=[];
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['pwd'];
        $passwordRepeat = $_POST['pwd-repeat'];
        var_dump([$username,$email ,$password]);
        $this->model->registerUser($username,$email ,$password );
    }

}