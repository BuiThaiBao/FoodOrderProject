<?php

include('../config/constants.php');
//1. Destroy the SESSION

// 2. Redirect to the login page
session_destroy(); // UNsets $_SESSION['user']
header('location:' . SITEURL . 'admin/login.php');
