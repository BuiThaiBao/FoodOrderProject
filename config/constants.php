<?php

//start SESSION
session_start();

//create constants to non value
define('SITEURL', 'http://localhost/FoodOrderProject/');
define('LOCALHOST', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'foodorder6');
$conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_error($conn)); //databse connection
$db_select = mysqli_select_db($conn, DB_NAME) or die(mysqli_error($conn));//selecting database
