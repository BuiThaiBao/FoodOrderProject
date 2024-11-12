<?php
include 'partials-front/menu.php';

// Get the food ID from URL
$food_id = $_GET['food_id'];

// Retrieve product details from the `tbl_food` table
$sql = "SELECT * FROM tbl_food WHERE id = $food_id";
$res = mysqli_query($conn, $sql);
$count = mysqli_num_rows($res);
if ($count == 1) {
    $row = mysqli_fetch_assoc($res);
    $id = $row['id'];
    $title = $row['title'];
    $price = $row['price'];
    $description = $row['description'];
    $image_name = $row['image_name'];
}

// Fetch reviews from the `tbl_review` table based on `f_id`
$review_query = "SELECT tbl_review.*, users.username FROM tbl_review JOIN users ON tbl_review.u_id = users.id WHERE tbl_review.f_id = $food_id";
$review_result = mysqli_query($conn, $review_query);
?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chi tiết sản phẩm</title>
    <style>
        /* CSS styling */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        .container {
            width: 80%;
            margin: 0 auto;
            padding: 20px;
        }

        .food-detail {
            display: flex;
            border: 1px solid #eaeaea;
            padding: 20px;
            margin-bottom: 20px;
        }

        .food-img img {
            max-width: 300px;
            border-radius: 8px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
        }

        .food-info {
            padding-left: 20px;
        }

        .food-info h1 {
            font-size: 24px;
            color: #333;
            margin-bottom: 10px;
        }

        .food-info .price {
            font-size: 20px;
            color: #ff5722;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .food-info .description {
            font-size: 16px;
            color: #666;
            line-height: 1.5;
        }

        .food-reviews {
            border-top: 1px solid #eaeaea;
            padding-top: 20px;
        }

        .food-reviews h2 {
            font-size: 20px;
            color: #333;
            margin-bottom: 15px;
        }

        .food-reviews ul {
            list-style: none;
        }

        .food-reviews .review {
            border-bottom: 1px solid #eaeaea;
            padding: 15px 0;
        }

        .food-reviews .review p {
            font-size: 16px;
            color: #555;
            margin: 5px 0;
        }

        .food-reviews .review p strong {
            color: #333;
        }

        .review-rating {
            color: #ffa500;
            font-weight: bold;
        }
    </style>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="container">
        <!-- Product Details Section -->
        <div class="food-detail">
            <div class="food-img">
                <?php if ($image_name == ""): ?>
                    <div class='error'>Image not Available.</div>
                <?php else: ?>
                    <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" alt="<?php echo $title; ?>" class="img-responsive img-curve">
                <?php endif; ?>
            </div>
            <div class="food-info">
                <h1><?php echo $title ?></h1>
                <p class="price"><?php echo $price ?> VND</p>
                <p class="description"><?php echo $description ?></p>
            </div>
        </div>

        <!-- Reviews Section -->
        <div class="food-reviews">
            <h2>Đánh giá sản phẩm</h2>
            <?php
            $sql2 = "
                SELECT tbl_review.*, users.username 
                FROM tbl_review 
                JOIN users ON tbl_review.u_id = users.id 
                WHERE tbl_review.f_id = $food_id
                ORDER BY tbl_review.create_at DESC
            ";
            $res2 = mysqli_query($conn, $sql2);
            if (mysqli_num_rows($review_result) > 0) {
                // Nếu có review, lặp qua các bản ghi và hiển thị
                while ($row2 = mysqli_fetch_assoc($review_result)) {
                    // Lấy thông tin từ kết quả truy vấn
                    $username = $row2['username'];
                    $comment = $row2['comment'];
                    $rating = $row2['rating'];
                    $create_at = $row2['create_at'];
                }
            } else {
                // Nếu không có review nào
                echo "<p>No reviews yet. Be the first to review!</p>";
            }
            ?>
            // Hiển thị thông tin đánh giá
            <li class='review'>
                <p><strong><?php echo $username; ?></strong>: <?php echo $comment; ?></p>
                <p class='review-rating'>Rating: <?php echo $rating; ?></p>
                <p class='review-time'>Posted on: <?php echo $create_at ?></p>
            </li>;



        </div>

        <!-- Comment Form Section -->
        <div class="comment-form">
            <h2>Leave a Comment</h2>
            <form action="review_handler.php" method="POST">
                <input type="hidden" name="food_id" value="<?php echo $food_id; ?>" />
                <textarea name="comment" id="comment" placeholder="Your comment here..." required></textarea>
                <br>
                <label for="rating">Rating: </label>
                <select name="rating" id="rating" required>
                    <option value="1">1 - Poor</option>
                    <option value="2">2 - Fair</option>
                    <option value="3">3 - Good</option>
                    <option value="4">4 - Very Good</option>
                    <option value="5">5 - Excellent</option>
                </select>
                <br><br>
                <input type="submit" class="btn btn-primary" value="Submit Review">
            </form>
        </div>
    </div>

</body>

</html>

<?php include 'partials-front/footer.php'; ?>