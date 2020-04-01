<?php

namespace app\core;

use PDO;
use PDOException;

class Dbh
{
    protected $db;

    public function __construct()
    {
        require 'app/config/db.php';
        try {
            $this->db = new PDO('mysql:host=' . $dbhost . ';dbname=' . $dbname . '', $username, $password);
            $this->db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $ex) {
            echo 'Невозможно установить соединение с базой данных' . $ex->getMessage();
            file_put_contents('PDOErrors.txt', $ex->getMessage(), FILE_APPEND);
        }
    }

    public function query($sql, $params = [])
    {
        $stmt = $this->db->prepare($sql);
        if (!empty($params)) {
            foreach ($params as $key => $param) {
                if (is_int($param)) {
                    $type = PDO::PARAM_INT;
                } else {
                    $type = PDO::PARAM_STR;
                }
                $stmt->bindValue(':' . $key, $param, $type);
            }
        }
        $stmt->execute();
        return $stmt;
    }

    public function getRow($sql, $params = [])
    {
        $result = $this->query($sql, $params);
        return $result->fetchAll();
    }

    public function getColumn($sql, $params = [])
    {
        $result = $this->query($sql, $params);
        return $result->fetchColumn();
    }
}
