<?php
session_start();
var_dump($_SERVER);
$_SESSION['count'] = $_SESSION['count'] +1;

require_once 'app/boot.php';
ini_set('display_errors', 1);


