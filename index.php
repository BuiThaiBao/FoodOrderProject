<?php include('partials-front/menu.php'); ?>
<?php
if (isset($_SESSION['order'])) {
    echo $_SESSION['order'];
    unset($_SESSION['order']);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Food Order</title>
    <!-- Bootstrap CSS -->
</head>

<body>
    <section class="categories py-5 bg-light">
        <div class="container">
            <h2 class="text-center mb-4">Explore Foods</h2>
            <div class="row">
                <?php
                // SQL Query to Display Categories
                $sql = "SELECT * FROM tbl_category WHERE active='Yes' AND featured='Yes' LIMIT 3";
                $res = mysqli_query($conn, $sql);
                $count = mysqli_num_rows($res);

                if ($count > 0) {
                    while ($row = mysqli_fetch_assoc($res)) {
                        $id = $row['id'];
                        $title = $row['title'];
                        $image_name = $row['image_name'];
                ?>
                        <div class="col-md-4 mb-4">
                            <a href="<?php echo SITEURL; ?>category_foods.php?category_id=<?php echo $id; ?>" class="text-decoration-none">
                                <div class="box-3 float-container text-center">
                                    <?php if ($image_name != "") { ?>
                                        <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name; ?>" alt="Category Image" class="img-fluid img-curve" width="100%">
                                    <?php } else { ?>
                                        <div class="error">Image not Available</div>
                                    <?php } ?>
                                    <h3 style="color=#0d6efd" class="float-text text-white bg-text bg-opacity-75 py-1"><?php echo $title; ?></h3>
                                </div>
                            </a>
                        </div>
                <?php
                    }
                } else {
                    echo "<div class='error text-center'>Category not Added.</div>";
                }
                ?>
            </div>
        </div>
    </section>

    <!-- Featured Foods Section -->
    <section class="food-menu py-5">
        <div class="container food-menu-container">
            <h2 class="text-center mb-4">Featured Foods</h2>
            <div class="row">
                <?php
                // SQL Query to Get Featured Foods
                $sql2 = "SELECT * FROM tbl_food WHERE active='Yes' AND featured='Yes' LIMIT 8";
                $res2 = mysqli_query($conn, $sql2);
                $count2 = mysqli_num_rows($res2);

                if ($count2 > 0) {
                    while ($row = mysqli_fetch_assoc($res2)) {
                        $id = $row['id'];
                        $title = $row['title'];
                        $price = $row['price'];
                        $description = $row['description'];
                        $image_name = $row['image_name'];
                ?>
                        <div class="food-menu-box">
                            <a href="<?php echo SITEURL; ?>food_detail_show.php?food_id=<?php echo $id; ?>">
                                <div class="food-menu-img">
                                    <?php
                                    //Check whether image available or not
                                    if ($image_name == "") {
                                        //Image not Available
                                        echo "<div class='error'>Image not available.</div>";
                                    } else {
                                        //Image Available
                                    ?>
                                        <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" alt="Food Image" class="img-responsive img-curve">
                                    <?php
                                    }
                                    ?>
                                </div>

                                <div class="food-menu-desc">
                                    <h4><?php echo $title; ?></h4>
                                    <p class="food-price"><?php echo $price; ?> VND</p>
                                    <p class="food-detail">
                                        <?php echo $description; ?>
                                    </p>
                                </div>
                            </a>

                            <br>
                            <!-- Add to Cart button -->
                            <form action="<?php echo SITEURL; ?>carts.php?food_id=<?php echo $id; ?>" method="POST" style="display: inline;">
                                <input type="hidden" name="food_id" value="<?php echo $id; ?>">
                                <div class="food_add_qty">
                                    <label for="quantity">Số lượng:</label>
                                    <input type="number" name="quantity" id="quantity" value="1" min="1" style="width: 60px;">
                                </div>
                                <input type="submit" class="btn btn-primary  w-100 mt-auto" value="Add to Cart">
                            </form>

                        </div>
                <?php
                    }
                } else {
                    echo "<div class='error text-center'>Food not available.</div>";
                }
                ?>
            </div>
        </div>
    </section>


    <!-- Bootstrap JS -->
    <script src="asset/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>

</html>
<?php include('partials-front/footer.php'); ?>