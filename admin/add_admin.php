<?php
include('partials/menu.php');
?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Admin</h1>

        <br><br>
        <?php
        if (isset($_SESSION['add'])) { //cehcking whether the session is set or not
            echo $_SESSION['add']; //display the session message is SEt
            unset($_SESSION['add']); // Remove the session message

        }
        ?>



        <form action="" method="POST">

            <table class="tbl-30">

                <tr>
                    <td>Full Name: </td>
                    <td><input type="text" name="full_name" placeholder="Enter your name"></td>
                </tr>
                <tr>
                    <td>User Name: </td>
                    <td>
                        <input type="text" name="username" placeholder="Username">
                    </td>

                </tr>
                <tr>
                    <td>Password: </td>
                    <td>
                        <input type="password" name="password" placeholder="Password">
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Admin" class="btn-secondary">
                    </td>
                </tr>



            </table>



        </form>


    </div>
</div>

<?php
include('partials/footer.php');
?>

<?php

// Process the value from form and save it in database
//Check whether the submit button is clicked or not
if (isset($_POST['submit'])) {
    //BUtton is clicked
    //echo "Button clicked";
    //get the data from the form
    $full_name = $_POST['full_name'];
    $username = $_POST['username'];
    $password = md5($_POST['password']); //Password encryption with md5

    //SQL Query to save the data to the database
    $sql = "insert into tbl_admin set 
        full_name='$full_name',
        username='$username',
        password='$password'
    
    ";

    //Execute SQL Query
    $res = mysqli_query($conn, $sql) or die(mysqli_error($conn));

    //Check whether the data is inserted or not
    if ($res == true) {
        //Data inserted successfully
        //echo "Admin added successfully";
        //Create the session variable display message
        $_SESSION['add'] = "<div class='success' >Admin added successfully</div>";
        //Redirect to manage admin page
        header("location:" . SITEURL . 'admin/manage_admin.php');
    } else {
        //Failed to insert data
        echo "Failed to add admin";
        $_SESSION['add'] = "<div class='error'>Failed to add admin</div>";
        //Redirect to add admin page
        header("location:" . SITEURL . 'admin/add_admin.php');
    }
}

?>