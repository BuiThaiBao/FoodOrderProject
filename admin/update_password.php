<?php
include('partials/menu.php');
?>

<div class="main-content">
    <h1>Change Password</h1>
    <br><br>

    <?php
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
    }
    ?>

    <form action="" method="POST">
        <table class="tbl-30">
            <tr>
                <td>Old Password: </td>
                <td><input type="password" name="current_password" placeholder="Current Password"></td>
            </tr>
            <tr>
                <td>New Password: </td>
                <td>
                    <input type="password" name="new_password" placeholder="New Password">
                </td>
            </tr>
            <tr>
                <td>Confirm Password: </td>
                <td>
                    <input type="password" name="confirm_password" placeholder="Confirm Password">
                </td>
            </tr>

            <tr>
                <td colspan="2">
                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                    <input type="submit" name="submit" value="Change Password" class="btn-primary">
                </td>
            </tr>

        </table>
    </form>
</div>

<?php
//check the whether the submit button
if (isset($_POST['submit'])) {
    $id = $_POST['id'];
    $current_password = md5($_POST['current_password']);
    $new_password = md5($_POST['new_password']);
    $confirm_password = md5($_POST['confirm_password']);

    $sql = "SELECT * FROM tbl_admin WHERE id=$id AND password='$current_password'";
    $res = mysqli_query($conn, $sql);
    if ($res == true) {
        $count = mysqli_num_rows($res);
        if ($count == 1) {
            //echo "User Found";
            if ($new_password == $confirm_password) {
                //Update password
                $sql2 = "UPDATE tbl_admin SET
                    password='$new_password'
                    WHERE id=$id
                ";
                //execute
                $res2 = mysqli_query($conn, $sql2);
                //Check weather the query executed or not
                if ($res2 == true) {
                    //Display success message
                    $_SESSION['change-pwd'] = "<div class='success'>Password changed successfully.</div>";
                    header('location:' . SITEURL . 'admin/manage_admin.php');
                } else {
                    $_SESSION['change-pwd'] = "<div class='error'>Failed to change password. </div>";
                    header('location:' . SITEURL . 'admin/manage_admin.php');
                }
            } else {
                //Redirect to manage admin page with error message
                $_SESSION['pwd-not-match'] = "<div class='error'>Password not match </div>";
                header('location:' . SITEURL . 'admin/manage_admin.php');
            }
        } else {
            $_SESSION['user-not-found'] = "<div class='error'>User Not Found </div>";
            header('location:' . SITEURL . 'admin/manage_admin.php');
        }
    }
}


?>
<?php
include('partials/footer.php');
?>