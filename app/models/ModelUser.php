<?php

require_once 'app/core/Dbh.php';

class ModelUser extends Dbh{

    public function registerUser($username, $email, $password )
    {
       
        $sql = "SELECT uidUsers FROM users WHERE uidUsers=?";
        $stmt = $this->db->prepare($sql);   
        $stmt->bindParam(1, $username ); 
        $stmt->execute();
        $result = $stmt->fetch();
        if ($result){
            
            die("Пользователь с таким именем уже существует");
        }
        else{
            $sql = "INSERT INTO users (uidUsers , emailUsers, pwdUsers) VALUES (?, ?, ?);";
            $stmt = $this->db->prepare($sql);
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            $stmt->execute([$username, $email, $hashedPassword]);
        }


    }
    public function loginUser($username, $password ){
        $sql = "SELECT * FROM users WHERE uidUsers=?;";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(1, $username );
        $stmt->execute();
        $user = $stmt->fetch();
        if($user){

            if(password_verify($password, $user['pwdUsers'])){
                session_start();
                $_SESSION['userId'] = $user['idUsers'];
                $_SESSION['userUid'] = $user['uidUsers'];
                $_SESSION['count'] = 0;
                header('Location: /user/account');
                echo "Вы авторизованы в системе!";
                exit();
            }else{
                header("Location:/");
                exit();
            }
        }
    }


}