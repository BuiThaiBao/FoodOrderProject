<?php include('partials/menu.php')

?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Category</h1>

        <br><br>


        <?php
        if (isset($_SESSION['add'])) {
            echo $_SESSION['add'];
            unset($_SESSION['add']);
        }
        if (isset($_SESSION['upload'])) {
            echo $_SESSION['upload'];
            unset($_SESSION['upload']);
        }


        ?>

        <!-- Add Category form start -->
        <form action="" method="POST" enctype="multipart/form-data">

            <table class="tbl-30">
                <tr>
                    <td>Title: </td>
                    <td>
                        <input type="text" name="title" placeholder="Category Title">

                    </td>

                </tr>


                <tr>
                    <td>Select image:</td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>

                <tr>
                    <td>Featured:</td>
                    <td>
                        <input type="radio" name="featured" value="Yes"> Yes
                        <input type="radio" name="featured" value="No"> No
                    </td>
                </tr>




                <tr>
                    <td>Active:</td>
                    <td>
                        <input type="radio" name="active" value="Yes"> Yes
                        <input type="radio" name="active" value="No"> No
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Category" class="btn-primary">
                    </td>
                </tr>
            </table>
        </form>

        <!-- Add Category form end -->

        <?php
        //Check whether the submit button is clicked or not
        if (isset($_POST['submit'])) {
            $title = $_POST['title'];

            //For radio inputs, we need to check whether the button is selected or not
            if (isset($_POST['featured'])) {
                //get the value of the selected
                $featured = $_POST['featured'];
            } else {
                //set the default value
                $featured = "No";
            }
            if (isset($_POST['active'])) {
                $active = $_POST['active'];
            } else {
                $active = "No";
            }
            //check whether the image is selected
            //print_r($_FILES['image']);

            //die(); //Break the code here
            if (isset($_FILES['image']['name'])) {
                //Upload the image
                //To upload image we need image name, source path and destination path
                $image_name = $_FILES['image']['name'];

                //upload the image ofly if image is selected
                if ($image_name != "") {


                    //Auto rename our image
                    //get the Extension our image (jpg,png ,gf,etc) e.g "special.food1.jpg"
                    $ext = end(explode('.', $image_name));

                    //Rename the image with unique name
                    $image_name = "Food_Category_" . rand(000, 999) . '.' . $ext;

                    $source_path = $_FILES['image']['tmp_name'];

                    $destination = "../images/category/" . $image_name;

                    //Finally upload
                    $upload = move_uploaded_file($source_path, $destination);

                    //Check whether the image 
                    if ($upload == false) {
                        $_SESSION['upload'] = "<div class='error'>Failed to Upload Image</div>";
                        //Redirect to add Category
                        header('location:' . SITEURL . "admin/add_category.php");
                        //stop the process
                        die();
                    }
                }
            } else {
                //Don't upload the image and set the image_name value as blank
                $image_name = "";
            }

            //Create SQl query to insert
            $sql = "INSERT INTO tbl_category SET 
            title='$title', 
            image_name='$image_name',
            featured='$featured', 
            active='$active'
            ";

            // Execute SQL and save in Database
            $res = mysqli_query($conn, $sql);

            //4. Check the whether the query executed ot not
            if ($res == true) {
                // Query execute and category added
                $_SESSION['add'] = "<div class='success'>Category added successfully</div>";
                header('location:' . SITEURL . 'admin/manage_category.php');
            } else {
                //fail
                $_SESSION['add'] = "<div class='error'>Fail to add successfully</div>";
                header('location:' . SITEURL . 'admin/add_category.php');
            }
        }



        ?>


    </div>
</div>


<?php include('partials/footer.php')

?>