<?php

session_start();

define('SITEURL','');
define('LOCALHOST','localhost');
define('DB_USERNAME','root');
define('DB_PASSWOED','');
define('DB_NAME','');

$conn = mysqli_connect(LOCALHOST,DB_USERNAME,DB_PASSWOED);
$db_select = mysqli_select_db($conn,DB_NAME);


?>