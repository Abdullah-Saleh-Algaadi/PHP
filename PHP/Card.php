<?php include("session.php");?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Card Page</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css" integrity="sha512-5Hs3dF2AEPkpNAR7UiOHba+lRSJNeM2ECkwxUIxC1Q/FLycGTbNapWXB4tP889k5T5Ju8fs4b1P5z/iB4nMfSQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="/project/CSS/style.css?v=<?php echo time(); ?>">
</head>
<header class="header">
    <h1>Welcome <?php echo htmlspecialchars($username); ?></h1>
    <div class="search">
        <form action="search.php" method="get" class="search-form">
            <input type="text" name="query" placeholder="Search..." class="search-input">
            <button type="submit" class="search-button"><i class="fas fa-search"></i></button>
        </form>
    </div>
    <div class="insert">
        <a href="customer.php?id=<?php echo $user_ID; ?>" id="insert">Home</a>
    </div>
    <div class="dropdown">
        <div class="hamburger">
            <span></span>
            <span></span>
            <span></span>
        </div>
        <div class="dropdown-content">
            <form class="logout-form" action="logout.php" method="post">
                <button class="logout-button" type="submit">Logout</button>
            </form>
        </div>
    </div>
</header>
<body>

<?php
include("database.php");

$sql = "SELECT * FROM orders WHERE user_ID=$user_ID";
$result = mysqli_query($conn, $sql);

// Check if there are any results
if (mysqli_num_rows($result) > 0) {
    // Start the container for products
    echo "<div class='product-container'>";
    
    // Loop through all rows and display the data in divs
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<div class='product-card'>";
        echo "<img src='" . $row['product_picture'] . "' alt='Product Image' class='product-image'>";
        echo "<h3 class='product-name'>" . $row['product_name'] . "</h3>";
        echo "<p class='product-description'>" . $row['product_description'] . "</p>";
        echo "<p class='product-price'>$" . number_format($row['product_price'], 2) . "</p>";

        //delete form 
        echo "<form method='post'>";
        echo "<input type='hidden' name='product_id' value='" . $row['order_ID'] . "'>";
        echo "<input type='hidden' name='user_id' value='" . $user_ID . "'>";
        echo "<input type='submit' value='Remove' name='Remove_from_Card_button' id='Remove_from_Card_button'>";
        echo "</form>";
        echo "</div>";
    }
    echo "</div>";
} else {
    echo "<p>No products found in the table.</p>";
}

if (isset($_POST['Remove_from_Card_button'])) {
    $orderID = $_POST['product_id'];

    $deleteOrder = "DELETE  FROM orders WHERE order_ID=$orderID";
    $deleteOrderResult = mysqli_query($conn, $deleteOrder);

    if ($deleteOrderResult) {
        echo "<meta http-equiv='refresh' content='2;url=Card.php?id=$user_ID'>";
    }else{
        echo "Error: " . mysqli_error($conn);
    }
}
?>
</body>
</html>
