<?php
include('partials/menu.php')
?>


<div class="main-content">
    <div class="wrapper">
        <h1>Add Food</h1>

        <br><br>

        <?php
        if (isset($_SESSION['upload'])) {
            echo $_SESSION['upload'];
            unset($_SESSION['upload']);
        }
        ?>


        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title: </td>
                    <td>
                        <input type="text" name="title" placeholder="Title">
                    </td>
                </tr>
                <tr>
                    <td>Description:</td>
                    <td>
                        <textarea name="description" cols="30" rows="5" placeholder="Description of the food"></textarea>
                    </td>
                </tr>
                <tr>
                    <td>Price :</td>
                    <td>
                        <input type="number" name="price">
                    </td>
                </tr>
                <tr>
                    <td>Select Image: </td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>
                <tr>
                    <td>Category: </td>
                    <td>
                        <select name="category">

                            <?php
                            //Create PHP Code to display category from database
                            $sql = "SELECT * FROM tbl_category WHERE active='Yes'";
                            $res = mysqli_query($conn, $sql);
                            $count = mysqli_num_rows($res);

                            if ($count > 0) {
                                while ($row = mysqli_fetch_assoc($res)) {
                                    $id = $row['id'];
                                    $title = $row['title'];
                            ?>
                                    <option value="<?php echo $id; ?>"><?php echo $title; ?></option>
                                <?php
                                }
                            } else {
                                ?>
                                <option value="0">No Category Found</option>
                            <?php
                            }

                            ?>
                        </select>
                    </td>
                </tr>

                <tr>
                    <td>Featured: </td>
                    <td>
                        <input type="radio" name="featured" value="Yes"> Yes
                        <input type="radio" name="featured" value="No"> No
                    </td>
                </tr>
                <tr>
                    <td>Active: </td>
                    <td>
                        <input type="radio" name="active" value="Yes"> Yes
                        <input type="radio" name="active" value="No"> No
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Food" class="btn-primary">
                    </td>
                </tr>

            </table>



        </form>

        <?php
        //CHeck whether button is clicked
        if (isset($_POST['submit'])) {
            //echo 'clicked';
            //Get the data from form
            $title = $_POST['title'];
            $description = $_POST['description'];
            $price = $_POST['price'];
            $category  = $_POST['category'];

            //check whether radion button for featured and active
            if (isset($_POST['featured'])) {
                $featured = $_POST['featured'];
            } else {
                $featured = "No"; //default
            }
            if (isset($_POST["active"])) {
                $active = $_POST["active"];
            } else {
                $active = "No"; //default
            }

            //upload the image 
            //Check whether the select image is clicked or not and upload
            if (isset($_FILES['image']['name'])) {
                //get the details
                $image_name = $_FILES['image']['name'];
                //check whether the image is selected
                if ($image_name != "") {
                    // Rename the image
                    $ext = end(explode('.', $image_name));

                    $image_name = "Food_Name_" . rand(0000, 9999) . '.' . $ext;

                    $src = $_FILES['image']['tmp_name'];

                    $dst =  "../images/food/" . $image_name;

                    $upload = move_uploaded_file($src, $dst);

                    if ($upload == false) {
                        $_SESSION['upload'] = "<div class='error'>Failed to Upload Image</div>";
                        //Redirect to add Category
                        header('location:' . SITEURL . "admin/add_food.php");
                        //stop the process
                        die();
                    }

                    //Upload
                }
            } else {
                $image_name = ""; //default
            }


            //insert into database
            $sql2 = "INSERT INTO tbl_food SET
                title='$title',
                description='$description',
                price= '$price',
                image_name='$image_name',
                category_id='$category',
                featured='$featured',
                active='$active'

            ";

            $res2 = mysqli_query($conn, $sql2);


            if ($res2 == true) {
                $_SESSION['add'] = "<div class='success'>Food added successfully</div>";
                header('location:' . SITEURL . 'admin/manage_food.php');
            } else {
                $_SESSION['add'] = "<div class='error'>Failed to add food</div>";
                header('location:' . SITEURL . 'admin/add_food.php');
            }


            //redirect to with message to manage food
        }

        ?>
    </div>
</div>

<?php
include('partials/footer.php');
?>