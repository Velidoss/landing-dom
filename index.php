<?php
session_start();

$_SESSION['count'] = $_SESSION['count'] +1;


require_once 'app/boot.php';
ini_set('display_errors', 1);

$arr = [];
if (isset($arr)){
    echo true;
}else{
    echo false;
}
