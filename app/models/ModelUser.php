<?php

require_once 'app/core/Dbh.php';

class ModelUser extends Dbh{

    public function registerUser($username, $email, $password )
    {
        $sql = "INSERT INTO users (uidUsers , emailUsers, pwdUsers) VALUES (?, ?, ?);";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$username, $email, $password]);
    }

}