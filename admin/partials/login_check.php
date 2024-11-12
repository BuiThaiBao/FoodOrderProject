<?php
//Authorization : Access Control
//Check whether the user is logged in or not

if (!isset($_SESSION['user'])) { //if user session is not set
    //user is not logged in

    //redirect to login page
    $_SESSION['no-login-message'] = "<div class='error text-center'>Please login to access Admin Panel</div>";
    //Redirect to login page
    header('location:' . SITEURL . 'admin/login.php');
    //stop further execution of the script
}
