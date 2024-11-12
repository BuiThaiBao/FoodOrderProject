<?php include('partials-front/menu.php'); ?>

<!-- fOOD sEARCH Section Starts Here -->
<section class="food-search text-center">
    <div class="container">

        <form action="<?php echo SITEURL; ?>food-search.php" method="POST">
            <input type="search" name="search" placeholder="Search for Food.." required>
            <input type="submit" name="submit" value="Search" class="btn btn-primary">
        </form>
    </div>
</section>
<style>
    .btn_add {
        padding-left: 20px;
    }
</style>

<!-- fOOD sEARCH Section Ends Here -->
<!-- fOOD MEnu Section Starts Here -->
<section class="food-menu">
    <div class="container">
        <h2 class="text-center">Food Menu</h2>

        <?php
        //Display Foods that are Active
        $sql = "SELECT * FROM tbl_food WHERE active='Yes'";

        //Execute the Query
        $res = mysqli_query($conn, $sql);

        //Count Rows
        $count = mysqli_num_rows($res);

        //CHeck whether the foods are availalable or not
        if ($count > 0) {
            //Foods Available
            while ($row = mysqli_fetch_assoc($res)) {
                //Get the Values
                $id = $row['id'];
                $title = $row['title'];
                $description = $row['description'];
                $price = $row['price'];
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
                                <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" alt="Chicke Hawain Pizza" class="img-responsive img-curve">
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
                        <input type="submit" class="btn btn-primary" value="Add to Cart">
                    </form>
                    <a href="<?php echo SITEURL; ?>order.php?food_id=<?php echo $id; ?>" class="btn btn-primary">Order Now</a>
                </div>
        <?php
            }
        } else {
            //Food not Available
            echo "<div class='error'>Food not found.</div>";
        }
        ?>





        <div class="clearfix"></div>



    </div>
    <?php include('partials-front/menu.php'); ?>

    <!-- fOOD SEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            <form action="<?php echo SITEURL; ?>food-search.php" method="POST">
                <input type="search" name="search" placeholder="Search for Food.." required>
                <input type="submit" name="submit" value="Search" class="btn btn-primary">
            </form>
        </div>
    </section>
    <!-- fOOD SEARCH Section Ends Here -->

    <!-- fOOD MENU Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>

            <?php
            //Display Foods that are Active
            $sql = "SELECT * FROM tbl_food WHERE active='Yes'";

            //Execute the Query
            $res = mysqli_query($conn, $sql);

            //Count Rows
            $count = mysqli_num_rows($res);

            //Check whether the foods are available or not
            if ($count > 0) {
                //Foods Available
                while ($row = mysqli_fetch_assoc($res)) {
                    //Get the Values
                    $id = $row['id'];
                    $title = $row['title'];
                    $description = $row['description'];
                    $price = $row['price'];
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
                                    <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" alt="Chicke Hawain Pizza" class="img-responsive img-curve">
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
                            <input type="submit" class="btn btn-primary btn_add" value="Add to Cart">
                        </form>
                        <a href="<?php echo SITEURL; ?>order.php?food_id=<?php echo $id; ?>" class="btn btn-primary">Order Now</a>
                    </div>
            <?php
                }
            } else {
                //Food not Available
                echo "<div class='error'>Food not found.</div>";
            }
            ?>

            <div class="clearfix"></div>
        </div>

    </section>
    <!-- fOOD MENU Section Ends Here -->

    <?php include('partials-front/footer.php'); ?>