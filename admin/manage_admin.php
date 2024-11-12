<?php
include("partials/menu.php");
?>
<!-- Main Content Section Starts -->
<div class="main-content">
    <div class="wrapper">
        <h1>Manage Admin</h1>
        <br />


        <?php
        if (isset($_SESSION['add'])) {
            echo $_SESSION['add'];  // display session message
            unset($_SESSION['add']); //removing session message
        }
        if (isset($_SESSION['delete'])) {
            echo $_SESSION['delete'];  // display session message
            unset($_SESSION['delete']); //removing session message
        }
        if (isset($_SESSION['update'])) {
            echo $_SESSION['update'];  // display session message
            unset($_SESSION['update']); //removing session message
        }
        if (isset($_SESSION['user-not-found'])) {
            echo $_SESSION['user-not-found'];  // display session message
            unset($_SESSION['user-not-found']); //removing session message
        }
        if (isset($_SESSION['pwd-not-match'])) {
            echo $_SESSION['pwd-not-match'];  // display session message
            unset($_SESSION['pwd-not-match']); //removing session message
        }
        if (isset($_SESSION['change-pwd'])) {
            echo $_SESSION['change-pwd'];  // display session message
            unset($_SESSION['change-pwd']); //removing session message
        }
        ?>


        <br><br><br>
        <!-- Button to ADD Admin -->
        <a href="add_admin.php" class="btn-primary">Add Admin</a>

        <br /> <br /> <br />
        <table class="tbl-full">
            <tr>
                <th>S.N.</th>
                <th>Full Name</th>
                <th>Username</th>
                <th>Actions</th>
            </tr>



            <?php
            //Query to get all admin
            $sql = "SELECT * FROM tbl_admin";
            //Query to get
            $res = mysqli_query($conn, $sql);

            if ($res == true) {
                //count rows to check whether we have in database or not
                $count = mysqli_num_rows($res); //funtion go get all the rows in database
                $sn = 1;
                //check num of rows
                if ($count > 0) {
                    //We have data in database
                    while ($row = mysqli_fetch_assoc($res)) {
                        //using while loop to get all the data
                        //and while loop will run as long as we have data ion database
                        //Get individual Data
                        $id = $row['id'];
                        $full_name = $row['full_name'];
                        $username = $row['username'];
                        //display the value
            ?>
                        <tr>
                            <td><?php echo $sn++; ?></td>
                            <td><?php echo $full_name; ?></td>
                            <td><?php echo $username; ?></td>
                            <td>
                                <a href="<?php echo SITEURL; ?>admin/update_password.php?id=<?php echo $id; ?>" class="btn-primary">Change Password</a>
                                <a href="<?php echo SITEURL; ?>admin/update_admin.php?id=<?php echo $id; ?>" class="btn-secondary">Update</a>
                                <a href="<?php echo SITEURL; ?>admin/delete_admin.php?id=<?php echo $id; ?>" class="btn-danger">Delete </a>
                            </td>
                        </tr>
            <?php
                    }
                } else {
                    //No data in database
                }
            }





            ?>

        </table>


    </div>
</div>
<!-- Main Content Section Ends -->

<?php
include("partials/footer.php");
?>