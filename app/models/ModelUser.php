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

            $sql = "SELECT idUsers FROM users WHERE uidUsers=? ";
            $stmt = $this->db->prepare($sql);   
            $stmt->bindParam(1, $username ); 
            $stmt->execute();
            $result = $stmt->fetch();
            
            $sql = "INSERT INTO userdata(userId, picStatus) VALUES (?,?)";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([$result['idUsers'], 1]);
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
    public function domainRegister($domainRegistrarId, $domainTimeReg, $domainName, $domainZone){
        $sql = "SELECT domainName FROM domains WHERE domainName=?;";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(1, $domainName);
        $stmt->execute();
        
        $domainCheck = $stmt->fetch();
        if($domainCheck){
            header("Location: ../user/domainreg");
            echo 'Это доменное имя уже зарегистрировано!';
            exit();
        }else{
            $sql = "INSERT into domains (domainRegistrantId, domainName, domainZone, domainTimeReg) VALUES (?,?,?,?);";
            $stmt= $this->db->prepare($sql);
            $stmt->execute([$domainRegistrarId, $domainName, $domainZone,  $domainTimeReg]);
            header("Location: ../user/domainreg");
            echo 'Доменное имя успешно зарегистрировано!';
            exit();
        }
    }

    public function changeUserName($newName, $userId ){
        $sql = "UPDATE userdata SET userName =? WHERE userid=?;";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$newName, $userId]);
        header("Location: ../user/account/success");
        echo 'Имя пользователя успешно изменено!';
        exit();
    }

    public function changeUserBrthDate($newData, $userId ){
        $sql = "UPDATE userdata SET userBrthDate =? WHERE userid=?;";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$newData, $userId]);
        header("Location: ../user/account/success");
        echo 'Дата рождения пользователя успешно изменена!';
        exit();
    }

    public function changeUserInfo($newData, $userId ){
        $sql = "UPDATE userdata SET userInfo =? WHERE userid=?;";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$newData, $userId]);
        header("Location: ../user/account/success");
        echo 'Информация пользователя успешно изменена!';
        exit();
    }

    public function selectUserData($userId){
        $sql = "SELECT * FROM userdata WHERE userId=?";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(1, $userId);
        $stmt->execute([$userId]);
        $result = $stmt->fetchAll();
        return $result;
    }


    public function selectDomains($userId){
        $sql = "SELECT domainName, domainZone FROM domains WHERE domainRegistrantId=?";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(1, $userId);
        $stmt->execute([$userId]);
        $result = $stmt->fetchAll();
        return $result;
    }

    public function selectUserPosts($userUid){
        $sql = "SELECT postTitle, postCategory, postContent, postDateTime FROM posts WHERE postAuthor=?";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(1, $userUid);
        $stmt->execute([$userUid]);
        $result = $stmt->fetchAll();
        return $result;
    }
}