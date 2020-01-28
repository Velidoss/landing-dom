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
    public function actionAccount()
    {
        if(isset($_SESSION['userUid'])){
            $this->view->generate('Account.php', 'Layout.php');
        }else{
            header("Location: /");
        }
        
        
    }

    public function actionRegisterUser(){
        if (isset($_POST['register-submit'])){
            
            $username = trim($_POST['username']);
            $email = trim($_POST['email']);
            $password = trim($_POST['pwd']);
            $passwordRepeat = trim($_POST['pwd-repeat']);
            if(empty($username) || empty($email) || empty($password) || empty($passwordRepeat)){
                die("Заполните все поля.") ;
            }
            elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                die("Некоретное название почтового ящика.") ;
            }
            elseif( !preg_match("/^[a-zA-Z0-9]*$/", $username)){
                die("Некоректное имя пользователя (допустимы только буквы и цифры).") ;
            }
            elseif( $password !== $passwordRepeat ){
                
                die("Пароли не совпадают.") ;
            }else{
                $this->model->registerUser($username,$email ,$password );
            }
            
        }
        echo 'Вы успешно зарегистрировались';

    }
    public function actionLoginUser(){
        if(isset($_POST['login-submit'])){
            $username = trim($_POST['username']);
            $password = trim($_POST['pwd']);
            if(empty($username) || empty($password)){
                die("Для входа введите логин и пароль.") ;
            }else{
                $this->model->loginUser($username,$password );
            }
        }
    }
    public function actionLogout(){
        if(isset($_POST['logout-submit'])){
            $_SESSION = [];
            session_destroy();
            header("Location: /");
        }

    }

}