<?php

use app\core\Dbh;

require_once 'app/core/Dbh.php';

class ModelUser extends Dbh
{
    public function registerUser($data)
    {
        $sql = 'SELECT uidUsers FROM users WHERE uidUsers=:username';
        $usercheck = [
            'username' => $data['username']
        ];
        $result = $this->getRow($sql, $usercheck);
        if ($result) {
            die('Пользователь с таким именем уже существует');
        } else {
            $hashedPassword = password_hash($data['password'], PASSWORD_DEFAULT);
            $data['password'] = $hashedPassword;
            $sql = 'INSERT INTO users (uidUsers , emailUsers, pwdUsers) VALUES (:username, :email, :password);';
            $this->query($sql, $data);

            $new_user = $this->db->lastInsertId();
            $userdata_params = [
                'userId' => $new_user,
                'status' => 0
            ];
            $sql = 'INSERT INTO userdata(userId, picStatus) VALUES (:userId, :status)';
            $this->query($sql, $userdata_params);
        }
    }

    public function loginUser($data)
    {
        $sql = 'SELECT * FROM users WHERE uidUsers=:username;';
        $user = $this->getRow($sql, ['username' => $data['username']])[0];
        if ($user) {
            if (password_verify($data['password'], $user['pwdUsers'])) {
                $_SESSION['userId'] = $user['idUsers'];
                $_SESSION['userUid'] = $user['uidUsers'];
                $_SESSION['count'] = 0;
                session_start();
                header('Location: /user/account');
                exit();
            } else {
                die('wrongpwd');
                header('Location:/');
            }
        } else {
            die('wrongUserdb');
        }
    }

    public function requestPwdChange($post)
    {
        $selector = bin2hex(random_bytes(8));
        $token = random_bytes(32);

        $url = 'https://' . $_SERVER['HTTP_HOST'] . '/user/changepwd?selector=' . $selector . '&validator=' . bin2hex($token);
        $expires = date('U') + 1800;

        $userEmail = $post['renew-email'];

        $sql = 'DELETE FROM pwdreset WHERE pwdResetEmail=?;';
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(1, $userEmail);
        $stmt->execute();

        $sql = 'INSERT INTO pwdreset (pwdResetEmail, pwdResetSelector, pwdResetToken, pwdResetExpires) VALUES (?,?,?,?);';
        $stmt = $this->db->prepare($sql);
        $hashedToken = password_hash($token, PASSWORD_DEFAULT);
        $stmt->execute([$userEmail, $selector, $hashedToken, $expires]);

        $to = $userEmail;

        $subject = 'Reset yur password for Velidoss';

        $message = '<p>We received the password reset request . The link to reset your password attached below. Ignore this message if you didnt make this request</p>';
        $message .= '<p>Here is your password reset link: </br>';

        $message .= '<a href="' . $url . '">' . $url . '</a></p>';

        $headers = "From: Velidoss <info@velidoss.fun>\r\n";
        $headers .= "Reply-To:info@velidoss.fun\r\n";
        $headers .= "Content-type: text/html\r\n";

        mail($to, $subject, $message, $headers);
    }

    public function pwdChange($post)
    {
        $selector = $post['selector'];
        $validator = $post['validator'];
        $password = $post['new-pwd'];
        $passwordRepeat = $post['repeat-new-pwd'];
        $currentDate = date('U');

        $sql = 'SELECT * FROM pwdReset WHERE pwdResetSelector=? AND pwdResetExpires >= ?;';
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(1, $selector);
        $stmt->bindParam(2, $currentDate);
        $stmt->execute();
        $result = $stmt->fetchAll();
        if (!count($result) > 0) {
            echo 'There is an error!';
            exit();
        } else {
            $tokenBin = hex2bin($validator);
            $tokenCheck = password_verify($tokenBin, $result['pwdResetToken']);
            if ($tokenCheck === false) {
                echo 'You need to re-submit your reset request.';
                exit();
            } elseif ($tokenCheck === true) {
                $tokenEmail = $result['pwdResetEmail'];
                $sql = 'SELECT * FROM users WHERE emailUsers=?;';
                $stmt = $this->db->prepare($sql);
                $stmt->bindParam(1, $tokenEmail);
                $stmt->execute();
                $result = $stmt->fetchAll();
                if (!count($result) > 0) {
                    echo 'There is an error!';
                    exit();
                } else {
                    $sql = 'UPDATE users SET pwdUsers=? WHERE emailUsers=?';
                    $stmt = $this->db->prepare($sql);
                    $newPwdHash = password_hash($password, PASSWORD_DEFAULT);
                    $stmt->bindParam(1, $newPwdHash);
                    $stmt->bindParam(2, $tokenEmail);
                    $stmt->execute();

                    $sql = 'DELETE FROM pwdReset WHERE pwdResetEmail=?;';
                    $stmt = $this->db->prepare($sql);
                    $stmt->bindParam(1, $tokenEmail);
                    $stmt->execute();
                }
            }
        }
    }

    public function domainRegister($data)
    {
        $sql = 'SELECT domainName FROM domains WHERE domainName=:domainName AND domainZone=:domainZone;';
        $domainCheck = $this->getColumn($sql, ['domainName' => $data['domainName'], 'domainZone' => $data['domainZone']]);
        file_put_contents('contenct_check.json', json_encode([$domainCheck, $data]));
        if ($domainCheck) {
            header('Location: ../user/domainreg');
            echo 'Это доменное имя уже зарегистрировано!';
            exit();
        } else {
            $sql = 'INSERT into domains (domainRegistrantId, domainName, domainZone, domainTimeReg) VALUES (:domainRegistrarId, :domainName, :domainZone, :domainTimeReg);';
            $this->query($sql, $data);
            header('Location: ../user/domainreg');
            echo 'Доменное имя успешно зарегистрировано!';
            exit();
        }
    }

    public function changeUserName($data)
    {
        $sql = 'UPDATE userdata SET userName =:newName WHERE userid=:userId;';
        $this->query($sql, $data);
    }

    public function changeUserBrthDate($data)
    {
        $sql = 'UPDATE userdata SET userBrthDate =:newData WHERE userid=:userId;';
        $this->query($sql, $data);
    }

    public function changeUserInfo($data)
    {
        $sql = 'UPDATE userdata SET userInfo =:newData WHERE userid=:userId;';
        $this->query($sql, $data);
    }

    public function selectUserData($data)
    {
        $sql = 'SELECT * FROM userdata WHERE userId=:userId';
        $result = $this->getRow($sql, $data);
        return $result;
    }

    public function selectDomains($data)
    {
        $sql = 'SELECT domainName, domainZone FROM domains WHERE domainRegistrantId=:userId';
        $result = $this->getRow($sql, $data);
        return $result;
    }

    public function selectUserPosts($data, $limit = [])
    {
        if (!empty($limit)) {
            $sql = 'SELECT * FROM posts WHERE postAuthor=:userUid LIMIT :start, :perpage';
            $data = array_merge($data, $limit);
        } else {
            $sql = 'SELECT * FROM posts WHERE postAuthor=:userUid';
        }

        $result = $this->getRow($sql, $data);
        return $result;
    }

    public function selectUserComments($data, $limit = [])
    {
        if (!empty($limit)) {
            $sql = 'SELECT * FROM comments WHERE commentAuthor=:userId LIMIT :start, :perpage';
            $data = array_merge($data, $limit);
        } else {
            $sql = 'SELECT * FROM comments WHERE commentAuthor=:userId';
        }

        $result = $this->getRow($sql, $data);
        return $result;
    }

    public function countUserPosts($data)
    {
        $sql = 'SELECT COUNT(postId) FROM posts WHERE postAuthorId=:postAuthorId';
        return $this->getColumn($sql, $data);
    }

    public function countUserComments($data)
    {
        $sql = 'SELECT COUNT(commentId) FROM posts WHERE commentAuthor=:commentAuthor';
        return $this->getColumn($sql, $data);
    }

    public function setImg($file)
    {
        $allowed_types = ['image/jpg', 'image/png', 'image/jpeg'];
        $uploadDir = 'img/userimage/';
        if ($file['new-image']['size'] < 5000000) {
            if (in_array($file['new-image']['type'], $allowed_types)) {
                if ($file['new-image']['tmp_name']) {
                    move_uploaded_file($file['new-image']['tmp_name'], $uploadDir . $_SESSION['userId'] . '.jpg');
                    $sql = 'UPDATE userdata SET picStatus =:status WHERE userid=:userId;';
                    $this->query($sql, ['status' => 1, 'userId' => $_SESSION['userId']]);
                    return true;
                } else {
                    return false;
                }
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function unsetImg($data)
    {
        if ($this->checkImg($data['userId'])) {
            $uploadDir = 'img/userimage/';
            unlink($uploadDir . $_SESSION['userId'] . '.jpg');
            $sql = 'UPDATE userdata SET picStatus = :status WHERE userId=:userId;';
            $this->query($sql, ['status' => 0, 'userId' => $_SESSION['userId']]);
            return true;
        } else {
            return false;
        }
    }

    public function checkImg($data)
    {
        $sql = 'SELECT picStatus FROM userdata WHERE userId=:Id; ';
        $result = $this->getColumn($sql, $data);
        if ($result == 1) {
            return true;
        } else {
            return false;
        }
    }
}
