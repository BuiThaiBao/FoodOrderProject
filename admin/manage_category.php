<?php
include("partials/menu.php");
?>

<div class="main-content">
    <div class="wrapper">
        <h1>Manage Category</h1>

        <br /> <br />
        <?php
        if (isset($_SESSION['add'])) {
            echo $_SESSION['add'];
            unset($_SESSION['add']);
        }
        if (isset($_SESSION['remove'])) {
            echo $_SESSION['remove'];
            unset($_SESSION['remove']);
        }
        if (isset($_SESSION['delete'])) {
            echo $_SESSION['delete'];
            unset($_SESSION['delete']);
        }
        if (isset($_SESSION['no-category-found'])) {
            echo $_SESSION['no-category-found'];
            unset($_SESSION['no-category-found']);
        }
        if (isset($_SESSION['update'])) {
            echo $_SESSION['update'];
            unset($_SESSION['update']);
        }
        if (isset($_SESSION['upload'])) {
            echo $_SESSION['upload'];
            unset($_SESSION['upload']);
        }
        if (isset($_SESSION['fail-remove'])) {
            echo $_SESSION['fail-remove'];
            unset($_SESSION['fail-remove']);
        }


        ?>
        <br><br>


        <!-- Button to ADD Admin -->
        <a href="<?php echo SITEURL; ?>admin/add_category.php" class="btn-primary">Add Category</a>

        <br /> <br /> <br />
        <table class="tbl-full">
            <tr>
                <th>S.N.</th>
                <th>Title</th>
                <th>Image</th>
                <th>Featured</th>
                <th>Active</th>
                <th>Actions</th>
            </tr>

            <?php
            //Query to get all categories
            $sql = "SELECT * FROM tbl_category ";

            $res = mysqli_query($conn, $sql);

            $count = mysqli_num_rows($res);

            $sn = 1;

            //check whether we have data ion database or not
            if ($count > 0) {
                //we have data in data base
                while ($row = mysqli_fetch_assoc($res)) {
                    $id = $row['id'];
                    $title = $row['title'];
                    $image_name = $row['image_name'];
                    $featured = $row['featured'];
                    $active = $row['active'];

            ?>
                    <tr>
                        <td><?php echo $sn++ ?></td>
                        <td><?php echo $title; ?></td>

                        <td>
                            <?php
                            //check whether image name available
                            if ($image_name != "") {
                            ?>

                                <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name; ?>" width=150px>

                            <?php
                            } else {
                                echo "<div class='error'>Image not added</div>";
                            }

                            ?>
                        </td>

                        <td><?php echo $featured; ?></td>
                        <td><?php echo $active; ?></td>
                        <td>
                            <a href="<?php echo SITEURL; ?>admin/update_category.php?id=<?php echo $id; ?>" class="btn-secondary">Update</a>
                            <a href="<?php echo SITEURL; ?>admin/delete_category.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>" class="btn-danger">Delete </a>
                        </td>
                    </tr>
                <?php

                }
            } else {
                //we do not have data
                //We'll display the message inside table
                ?>
                <tr>
                    <td colspan="6">
                        <div class="error">No Category Added.</div>
                    </td>
                </tr>
            <?php
            }



            ?>





        </table>
    </div>

</div>

<?php
include("partials/footer.php");
?>