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
                $_SESSION['userId'] = $user['idUsers'];
                $_SESSION['userUid'] = $user['uidUsers'];
                $_SESSION['count'] = 0;
                session_start();
                header('Location: /user/account');
                
                exit();
            }else{
                header("Location:/");
                exit();
            }
        }
    }

    public function requestPwdChange($post){
        $selector = bin2hex(random_bytes(8));
        $token = random_bytes(32);
    
        $url = "https://".$_SERVER['HTTP_HOST']."/user/changepwd?selector=".$selector."&validator=".bin2hex($token);
        $expires = date("U") + 1800;

        $userEmail = $post["renew-email"];

        $sql = "DELETE FROM pwdreset WHERE pwdResetEmail=?;";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(1, $userEmail);
        $stmt->execute();

        $sql = "INSERT INTO pwdreset (pwdResetEmail, pwdResetSelector, pwdResetToken, pwdResetExpires) VALUES (?,?,?,?);";
        $stmt = $this->db->prepare($sql);
        $hashedToken = password_hash($token, PASSWORD_DEFAULT);
        $stmt->execute([$userEmail, $selector, $hashedToken, $expires]);

        $to = $userEmail;


        $subject = 'Reset yur password for Velidoss';

        $message = '<p>We received the password reset request . The link to reset your password attached below. Ignore this message if you didnt make this request</p>';
        $message .= '<p>Here is your password reset link: </br>';

        $message .= '<a href="' .$url.'">'.$url.'</a></p>';

        $headers = "From: Velidoss <info@velidoss.fun>\r\n";
        $headers .= "Reply-To:info@velidoss.fun\r\n";
        $headers .= "Content-type: text/html\r\n";
        
        mail($to, $subject, $message, $headers);

         
    }

    public function pwdChange($post){
        $selector = $post["selector"];
        $validator = $post["validator"];
        $password = $post["new-pwd"];
        $passwordRepeat = $post["repeat-new-pwd"];
        $currentDate = date("U");

        $sql = "SELECT * FROM pwdReset WHERE pwdResetSelector=? AND pwdResetExpires >= ?;"; 
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(1, $selector);
        $stmt->bindParam(2, $currentDate );
        $stmt->execute();
        $result = $stmt->fetchAll();
        if(!count($result)>0){
            echo 'There is an error!';
            exit();
        }else{
            $tokenBin = hex2bin($validator);
            $tokenCheck = password_verify($tokenBin, $result["pwdResetToken"]);
            if ($tokenCheck === false) {
        		echo "You need to re-submit your reset request.";
        		exit();
        	}elseif($tokenCheck === true){
                $tokenEmail =$result['pwdResetEmail'];
                $sql ="SELECT * FROM users WHERE emailUsers=?;";
                $stmt = $this->db->prepare($sql);
                $stmt->bindParam(1, $tokenEmail );
                $stmt->execute();
                $result = $stmt->fetchAll();
                if(!count($result)>0){
                    echo 'There is an error!';
                    exit();
                }else{
                    $sql = "UPDATE users SET pwdUsers=? WHERE emailUsers=?";
                    $stmt = $this->db->prepare($sql);
                    $newPwdHash = password_hash($password, PASSWORD_DEFAULT);
                    $stmt->bindParam(1, $newPwdHash );
                    $stmt->bindParam(2, $tokenEmail );
                    $stmt->execute();

                    $sql = "DELETE FROM pwdReset WHERE pwdResetEmail=?;";
                    $stmt = $this->db->prepare($sql);
                    $stmt->bindParam(1, $tokenEmail );
                    $stmt->execute();
                }
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
    }

    public function changeUserBrthDate($newData, $userId ){
        $sql = "UPDATE userdata SET userBrthDate =? WHERE userid=?;";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$newData, $userId]);
    }

    public function changeUserInfo($newData, $userId ){
        $sql = "UPDATE userdata SET userInfo =? WHERE userid=?;";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$newData, $userId]);
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
    public function setImg($file){
        $allowed_types = ['image/jpg', 'image/png', 'image/jpeg'];
        $uploadDir = "img/userimage/";
        if($file["new-image"]["size"] < 5000000){
            if(in_array($file["new-image"]["type"] , $allowed_types)){
                if($file["new-image"]["tmp_name"]){
                    move_uploaded_file($file["new-image"]["tmp_name"], $uploadDir.$_SESSION['userId'].".jpg" );
                    $sql = "UPDATE userdata SET picStatus =0 WHERE userid=:sessionId;";
                    $stmt = $this->db->prepare($sql);
                    $stmt->bindValue(':sessionId',$_SESSION['userId'] );
                    $stmt->execute();
                    return true;
                }else{
                    return false;
                }
            }else{
                return false;
            }
        }else{
            return false;
        }
    }
    public function unsetImg(){
        if($this->checkImg()){
            $uploadDir = "img/userimage/";
            unlink($uploadDir.$_SESSION['userId'].".jpg");
            $sql = "UPDATE userdata SET picStatus = 1 WHERE userId=:sessionId;";
            $stmt = $this->db->prepare($sql);
            $stmt->bindValue(':sessionId',$_SESSION['userId'] );
            $stmt->execute();
            return true;
        }else{
            return false;
        }

    }

    public function checkImg(){
        $sql = "SELECT picStatus FROM userdata WHERE userId=:sessionId; ";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':sessionId',$_SESSION['userId'] );
        $stmt->execute();
        $result = $stmt->fetch();
        if ($result['picStatus'] == 0){
            return true;
        }else{
            return false;
        }
    }
}