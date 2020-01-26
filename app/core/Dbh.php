<?php


class Dbh{

    protected $db ;
    public function __construct()
    {
        require 'app/config/db.php';
        try{
            $this->db = new PDO('mysql:host='.$dbhost.';dbname='.$dbname.'','root', '');
            $this->db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            $this->db->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );  
        }catch(PDOException $ex){
            echo 'Невозможно установить соединение с базой данных'.$ex->getMessage();
            file_put_contents('PDOErrors.txt', $e->getMessage(), FILE_APPEND);  
        }
    }

}