<?php
include("database.php");

if (isset($_POST['product_id']) && isset($_POST['user_id'])) {
    $product_id = $_POST['product_id'];
    $user_id = $_POST['user_id'];

    // Delete the product from the orders table
    $deleteQuery = "DELETE FROM orders WHERE product_id='$product_id' AND user_ID='$user_id'";
    if (mysqli_query($conn, $deleteQuery)) {
        // Redirect back to the card page after deletion
        header("Location: card_page.php");
    } else {
        echo "Error: " . mysqli_error($conn);
    }

    // Close the database connection
    mysqli_close($conn);
}
?>
