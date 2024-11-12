<?php
include('../config/constants.php');
if (isset($_GET['id']) and isset($_GET['image_name'])) {
    //get the value and delete 
    $id = $_GET['id'];
    $image_name = $_GET['image_name'];

    //remove the image
    if ($image_name != "") {
        //image is available. so remove it
        $path = "../images/food/" . $image_name;
        //remote the image
        $remove = unlink($path);

        if ($remove == false) {
            $_SESSION['upload'] = "<div class='error'> Failed to remove</div>";
            header('location:' . SITEURL . 'admin/manage_food.php');
            die();
        }
    }
    $sql = "DELETE FROM tbl_food WHERE id = $id ";

    $res = mysqli_query($conn, $sql);

    if ($res == true) {
        $_SESSION['delete'] = "<div class='success'>Delete successfully.</div>";
        header('location:' . SITEURL . 'admin/manage_food.php');
    } else {
        $_SESSION['delete'] = "<div class='error'>Failed to delete.</div>";
        header('location:' . SITEURL . 'admin/manage_food.php');
    }



    // Delete data from database

    // redirect to manage category page 
} else {
    //redirect to manage category page
    $_SESSION['unauthorize'] = "<div class='success'>Unauthorized access.</div>";
    header('location:' . SITEURL . 'admin/manage_food.php');
}
