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
    public function actionDomainreg(){
        if(isset($_SESSION['userId'])){
            $this->view->generate('Domainreg.php', 'Layout.php');
        }else{
            header("Location: /");
        }
    }


    public function actionAccount()
    {
        if(isset($_SESSION['userId'])){
            $data = $this->model->selectDomains($_SESSION['userId']);
            $this->view->generate('Account.php', 'AccountLayout.php', $data);
            

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

    public function actionDomainRegAct(){
        if(isset($_POST['domainreg-submit'])){
            $domainNameFull = $_POST['domain-name'];
            $allowed_zones = array("best", "shop", "xyz", "club", "design", "tech", "website", "store" , "online", "fun", "site", "space", "icu", "name", "net", "pro", "com", "top");
            
            if (empty($domainNameFull)){
                header("Location:../user/domainreg?error=domainnameempty");
                exit();
            }else{
                //Проверяем доменное имя на допустимые символы
                if (!preg_match("/^[A-Za-z0-9(\.\-)]*$/", $domainNameFull)){
                    header("Location: ../user/domainreg?error=domainnameforbiddensymbols");
                    exit();
                }else{
                    //разбиваем доменное имя на части между точками
                    $domainNameExp = explode(".", $_POST['domain-name']);
                    //Если больше уровней доменного имени, или меньше, значит оно неправильное.
                    if (count($domainNameExp)>3 or count($domainNameExp)<2 ){
                        header("Location: ../user/domainreg?error=domainnamewrongform");
                        exit();
                    }
                    elseif (count($domainNameExp)==3){
                        if ($domainNameExp[2]=== "ua" and $domainNameExp[1]=== "com" ) {
                            foreach ($domainNameExp as $domainNameLvl) {
                                //Пустой ли домен каждого уровня
                                if (empty($domainNameLvl)) {
                                    header("Location: ../user/domainreg?error=domainnameempty");
                                    exit();
                                } //Или же слишком длинный
                                elseif (strlen($domainNameLvl) > 63) {
                                    header("Location: ../user/domainreg?error=domainnametoomuchsymbols");
                                    exit();
                                }
                            }
                            //Проверяем начинается или заканчивается ли доменное имя на дефис
                            if (preg_match("/^[\-]/", $domainNameExp[0]) or preg_match("/[\-]$/", $domainNameExp[0]) ){
                                header("Location: ../user/domainreg?error=domainnamewrongsign");
                                exit();
                            }else{
                                $domainRegistrarId = $_SESSION['userId'];
                                $domainTimeReg = date("Y-m-d H:i:s");
                                $domainName = $domainNameExp[0];
                                $domainZone = $domainNameExp[1].".".$domainNameExp[2];
                                $this->model->domainRegister($domainRegistrarId,$domainTimeReg , $domainName ,$domainZone);
                            }
                        }
                    }
                    elseif(count($domainNameExp)==2){
                        foreach ($domainNameExp as $domainNameLvl) {
                            //Пустой ли домен каждого уровня
                            if (empty($domainNameLvl)) {
                                header("Location: ../domain-reg.php?error=domainnameempty");
                                exit();
                            } //Или же слишком длинный
                            elseif (strlen($domainNameLvl) > 63) {
                                header("Location: ../domain-reg.php?error=domainnametoomuchsymbols");
                                exit();
                            }
                        }
        
                            if (in_array($domainNameExp[1], $allowed_zones)){
                                if (preg_match("/^[\-]/", $domainNameExp[0]) or preg_match("/[\-]$/", $domainNameExp[0]) ){
                                    header("Location: ../domain-reg.php?error=domainnamewrongsign");
                                    exit();
                                }else{
                                    
                                    //Кладем в базу.
                                    $domainRegistrarId = $_SESSION['userId'];
                                    $domainTimeReg = date("Y-m-d H:i:s");
                                    $domainName = $domainNameExp[0];
                                    $domainZone = $domainNameExp[1];
                                    $this->model->domainRegister($domainRegistrarId,$domainTimeReg , $domainName ,$domainZone);
                                }
                            }
                        }
                }
            }
        
        }
    }



}