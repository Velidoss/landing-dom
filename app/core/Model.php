<?php

require 'Dbh.php';

class Model extends Dbh
{
    public $db;
    public function __construct()
    {
        $this->db = new Dbh;
        var_dump($this->db);
    }
}
