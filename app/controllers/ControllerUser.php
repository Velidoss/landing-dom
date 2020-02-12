<?php

require_once 'app/models/ModelUser.php';

use app\core\View;

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
            $data=[];
            $data['domains'] = $this->model->selectDomains($_SESSION['userId']);
            $data['userData'] = $this->model->selectUserData($_SESSION['userId']);
            $data['userPosts'] = $this->model->selectUserPosts($_SESSION['userUid']);
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
        echo 'Вы зарегистрированы';

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
                                header("Location: ../domainreg?error=domainnameempty");
                                exit();
                            } //Или же слишком длинный
                            elseif (strlen($domainNameLvl) > 63) {
                                header("Location: ../domainreg?error=domainnametoomuchsymbols");
                                exit();
                            }
                        }
        
                            if (in_array($domainNameExp[1], $allowed_zones)){
                                if (preg_match("/^[\-]/", $domainNameExp[0]) or preg_match("/[\-]$/", $domainNameExp[0]) ){
                                    header("Location: ../domainreg?error=domainnamewrongsign");
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

    public function actionChangeName(){
        if(isset($_POST['changeName-submit'])){
            $newName = $_POST['new-name'];
            $userId = $_SESSION['userId'];
            if(empty($newName)){
                header("Location: ../user/account");
                exit();
            }
            elseif( !preg_match("/^[a-zA-Z0-9]*$/", $newName)){
                header("Location: ../user/account");
                exit();
            }
            else{
                $this->model->changeUserName($newName, $userId );
            }
        }else{
            header("Location: ../user/account");
            exit();
        }
    }

    public function actionChangeDateBirth(){
        if(isset($_POST['changeDateBirth-submit'])){
            $newData = $_POST['new-birthdate'];
            $userId = $_SESSION['userId'];
            if(empty($newData)){
                header("Location: ../user/account");
                exit();
            }
            elseif( !preg_match("/(0[1-9]|[12][0-9]|3[01])[-\/.](0[1-9]|1[012])[-\/.](19|20)\d\d/", $newData)){
                header("Location: ../user/account?error=dontmatch");
                exit();
            }
            else{
                $this->model->changeUserBrthDate($newData, $userId );
            }
        }else{
            header("Location: ../user/account");
            exit();
        }
    }

    public function actionChangeData(){
        if(isset($_POST['changeData-submit'])){
            $newData = $_POST['new-userdata'];
            $userId = $_SESSION['userId'];
            if(empty($newData)){
                header("Location: ../user/account");
                exit();
            }
            elseif( !preg_match("/^[a-zA-Z0-9(\.,\-?!\s\\%\/$\#;)]*$/", $newData)){
                header("Location: ../user/account?error=dontmatch");
                exit();
            }
            else{
                $this->model->changeUserInfo($newData, $userId );
            }
        }else{
            header("Location: ../user/account");
            exit();
        }
    }
    public function actionForgotpwd(){
        $this->view->generate('forgotpwd.php', 'AccountLayout.php');
        if(isset($_POST['renew-submit'])){
            if(!empty($_POST['renew-email'])){
                $this->model->requestPwdChange($_POST);
                echo 'The password reset letter was sent on your email!';
            }else{            
                echo 'Type your email!';
                exit();
            }
            
        }
    }

    public function actionChangepwd(){
        $this->view->generate('changepwd.php', 'AccountLayout.php');
        if(isset($_POST['changepwd-submit'])){
            if(empty($_POST['new-pwd']) || empty($_POST['repeat-new-pwd'])){
                echo 'fill all the fields!';
                exit();
            }else{            
                if($_POST['new-pwd'] != $_POST['repeat-new-pwd']){
                    echo 'Your passwords dont match!';
                    exit();
                }else{
                    $this->model->pwdChange($_POST);
                    header('Location: /user/login');
                    exit();
                }
            }
            
        }else{
            header('Location: /');
        }
    }

}