<?php
include('../config/constants.php');
if (isset($_GET['id']) and isset($_GET['image_name'])) {
    //get the value and delete 
    $id = $_GET['id'];
    $image_name = $_GET['image_name'];

    //remove the image
    if ($image_name != "") {
        //image is available. so remove it
        $path = "../images/category/" . $image_name;
        //remote the image
        $remove = unlink($path);

        if ($remove == false) {
            $_SESSION['remove'] = "<div class='error'> Failed to remove</div>";
            header('location:' . SITEURL . 'admin/manage_category.php');
            die();
        }
    }
    $sql = "DELETE FROM tbl_category WHERE id = $id ";

    $res = mysqli_query($conn, $sql);

    if ($res == true) {
        $_SESSION['delete'] = "<div class='success'>Delete successfully.</div>";
        header('location:' . SITEURL . 'admin/manage_category.php');
    } else {
        $_SESSION['delete'] = "<div class='error'>Failed to delete.</div>";
        header('location:' . SITEURL . 'admin/manage_category.php');
    }



    // Delete data from database

    // redirect to manage category page 
} else {
    //redirect to manage category page
    header('location:' . SITEURL . 'admin/manage_category.php');
}
