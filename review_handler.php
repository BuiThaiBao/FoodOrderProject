<?php
include 'config/constants.php'; // Assuming you have this for database connection

// Start the session to get user ID

// Check if the user is logged in
if (!isset($_SESSION['u_id'])) {
    // Redirect to login page if not logged in
    header("Location: login.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the food_id, comment, and rating from the form
    $food_id = mysqli_real_escape_string($conn, $_POST['food_id']);
    $user_id = $_SESSION['user_id']; // Get the logged-in user's ID
    $comment = mysqli_real_escape_string($conn, $_POST['comment']);
    $rating = mysqli_real_escape_string($conn, $_POST['rating']);
    $create_at = date('Y-m-d H:i:s');

    // Insert the review into the database
    $sql = "INSERT INTO tbl_review (f_id, u_id, comment, rating, create_at) 
            VALUES ('$food_id', '$user_id', '$comment', '$rating', '$create_at')";

    if (mysqli_query($conn, $sql)) {
        // Successfully inserted the review, redirect back to the product details page
        header("Location: food_detail_show.php?food_id=" . $food_id);
        exit;
    } else {
        // Failed to insert the review
        echo "Error: " . mysqli_error($conn);
    }
}
