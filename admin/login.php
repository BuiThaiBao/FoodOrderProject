<?php
include('../config/constants.php');
?>
<html>

<head>
    <title>Login - Food Order system</title>
    <link rel="stylesheet" href="../css/admin.css">
</head>

<body>


    <div class="login">
        <h1 class="text-center">Login</h1>
        <br><br>

        <?php
        if (isset($_SESSION['login'])) {
            echo $_SESSION['login'];  // display session message
            unset($_SESSION['login']); // remove session message
        }
        if (isset($_SESSION['no-login-message'])) {
            echo $_SESSION['no-login-message'];
            unset($_SESSION['no-login-message']); // remove session message
        }
        ?>

        <br><br>

        <!-- Login form start  -->
        <form action="" method="POST" class="text-center">
            Username: <br>
            <input type="text" name="username" placeholder="Username"><br><br>

            Password: <br>
            <input type="text" name="password" placeholder="Password"><br><br>

            <input type="submit" name="submit" value="Login" class="btn-primary">
            <br><br>

        </form>
        <!-- Login form end  -->

        <p class="text-center">Created By - <a href="#">Bao</a></p>
    </div>


</body>

</html>
<?php
// Check whether the submit button
if (isset($_POST['submit'])) {
    //Process login
    //Get the data from login form
    $username = $_POST['username'];
    $password = md5($_POST['password']); //Password encryption with md5


    //2. SQL to check whether the user with username and password exists
    $sql = "SELECT * FROM tbl_admin WHERE username = '$username' AND password = '$password'";

    // Execute SQL
    $res = mysqli_query($conn, $sql);


    //count rows to check
    $count = mysqli_num_rows($res);

    if ($count == 1) {
        //user available and login successfully
        $_SESSION['login'] = "<div class='success'>Login Success</div>";
        $_SESSION['user'] = $username; // TO check whether the user is logged in or not and logout will unset it

        // Redirect to login page
        header("location:" . SITEURL . 'admin/');
    } else {
        //user not available
        $_SESSION['login'] = "<div class='error text-center'>Login failed</div>";
        header("location:" . SITEURL . 'admin/login.php');
    }
}



?>