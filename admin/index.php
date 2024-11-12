<?php
include('partials/menu.php');
?>
<!-- Main Content Section Starts -->
<div class="main-content">
    <div class="wrapper">
        <h1>Dashboard</h1>
        <br><br>
        <?php
        if (isset($_SESSION['login'])) {
            echo $_SESSION['login'];  // display session message
            unset($_SESSION['login']); // remove session message
        }
        ?>

        <br><br>
        <div class="col-4 text-center">

            <?php
            $sql = "select * from tbl_category";
            $res = mysqli_query($conn, $sql);
            //Count Rows
            $count = mysqli_num_rows($res);
            ?>
            <h1><?php echo $count; ?></h1>
            <br />
            Categories
        </div>
        <div class="col-4 text-center">
            <?php
            $sql2 = "select * from tbl_food";
            $res2 = mysqli_query($conn, $sql2);
            //Count Rows
            $count2 = mysqli_num_rows($res2);
            ?>
            <h1><?php echo $count2; ?></h1>
            <br />
            Food
        </div>

        <div class="col-4 text-center">
            <?php
            $sql3 = "select * from tbl_order";
            $res3 = mysqli_query($conn, $sql3);
            //Count Rows
            $count3 = mysqli_num_rows($res3);
            ?>
            <h1><?php echo $count3; ?></h1>
            <br />
            Total Order
        </div>
        <div class="col-4 text-center">

            <?php
            //Creat SQL Query to Get Total Revenue Generated
            //Aggregate Function in SQL
            $sql4 = "select SUM(total) as Total from tbl_order";
            $res4 = mysqli_query($conn, $sql4);
            $row4 = mysqli_fetch_assoc($res4);
            $total_revenue = $row4['Total'];
            ?>
            <h1><?php echo $total_revenue; ?></h1>
            <br />
            Revenue Generated
        </div>

        <div class="clearfix"></div>

    </div>
</div>
<!-- Main Content Section Ends -->
<?php
include('partials/footer.php');
?>