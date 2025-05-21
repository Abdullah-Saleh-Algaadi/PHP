<?php include("session.php");?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin </title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css" integrity="sha512-5Hs3dF2AEPkpNAR7UiOHba+lRSJNeM2ECkwxUIxC1Q/FLycGTbNapWXB4tP889k5T5Ju8fs4b1P5z/iB4nMfSQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="/project/CSS/style.css?v=<?php echo time(); ?>">
</head>
<header class="header">
    <h1>Hi, <?php echo htmlspecialchars($username); ?></h1>
<div class="search"> 
    <form method="get" id="search-form"> 
        <input type="hidden" name="id" value="<?php echo $user_ID; ?>"> 
        <input type="text" name="query" placeholder="Search..." class="search-input"> 
        <button type="submit" class="search-button"><i class="fas fa-search"></i></button> 
    </form> 
</div>
    <div class="user-management">
        <a href="userManagement.php?id=<?php echo $user_ID; ?>" id="user-management">User Management</a>
    </div>
    <div class="insert">
        <a href="insert.php?id=<?php echo $user_ID; ?>" id="insert">Insert</a>
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

<script src="/project/JavaScript/index.js?v=<?php echo time(); ?>"></script>
<?php
include("database.php");

// Check if search query is present
if (isset($_GET['id']) && isset($_GET['query'])) {
    $id = htmlspecialchars($_GET['id']); // Sanitize the id
    $query = htmlspecialchars($_GET['query']); // Sanitize the query

    // Properly format the SQL query by adding single quotes around the query
    $search = "SELECT * FROM products WHERE Product_name like '%$query%'";
    $search_Result = mysqli_query($conn, $search);

    if (mysqli_num_rows($search_Result) > 0) {
        // Display search results
        echo "<div class='product-container'>";
        while ($row = mysqli_fetch_assoc($search_Result)) {
            echo "<div class='product-card'>";
            echo "<img src='" . $row['Product_picture'] . "' alt='Product Image' class='product-image'>";
            echo "<h3 class='product-name'>" . $row['Product_name'] . "</h3>";
            echo "<p class='product-description'>" . $row['Product_description'] . "</p>";
            echo "<p class='product-price'>$" . number_format($row['Product_price'], 2) . "</p>";
            echo "<button class='add-to-cart' id='Add_To_Card_button'>Add-To-Cart</button>";
            echo "<div class='button-container'>";
            // Delete Form
            echo "<form method='post' id='delete-form' class='icon-form'>";
            echo "<input type='hidden' name='product_id' value='" . $row['Product_id'] . "'>";
            echo "<button type='submit' name='trash' class='trash-icon'><i class='fa-solid fa-trash'></i></button>";
            echo "</form>";
            // Edit Form
            echo "<form method='post' action='edit.php?id=" . $user_ID . "&product_id=" . $row['Product_id'] . "&Product_picture=" . $row['Product_picture'] . "&Product_name=" . $row['Product_name'] . "&Product_description=" . $row['Product_description'] . "&Product_price=" . $row['Product_price'] . "' class='icon-form'>";
            echo "<button type='submit' name='edit' class='edit-icon'><i id='edit' class='fas fa-edit'></i></button>";
            echo "</form>";
            echo "</div>";
            echo "</div>";
        }
        echo "</div>";
    } else {
        echo "<p>No products found matching your search.</p>";
    }
} else {
    // SQL query to fetch all products if no search query is present
    $sql = "SELECT * FROM products";
    $result = mysqli_query($conn, $sql);

    // Check if there are any results
    if (mysqli_num_rows($result) > 0) {
        // Start the container for products
        echo "<div class='product-container'>";
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<div class='product-card'>";
            echo "<img src='" . $row['Product_picture'] . "' alt='Product Image' class='product-image'>";
            echo "<h3 class='product-name'>" . $row['Product_name'] . "</h3>";
            echo "<p class='product-description'>" . $row['Product_description'] . "</p>";
            echo "<p class='product-price'>$" . number_format($row['Product_price'], 2) . "</p>";
            echo "<button class='add-to-cart' id='Add_To_Card_button'>Add-To-Cart</button>";
            echo "<div class='button-container'>";
            // Delete Form
            echo "<form method='post' class='icon-form'>";
            echo "<input type='hidden' name='product_id' value='" . $row['Product_id'] . "'>";
            echo "<button type='submit' name='trash' class='trash-icon'><i class='fa-solid fa-trash'></i></button>";
            echo "</form>";
            // Edit Form
            echo "<form method='post' action='edit.php?id=" . $user_ID . "&product_id=" . $row['Product_id'] . "&Product_picture=" . $row['Product_picture'] . "&Product_name=" . $row['Product_name'] . "&Product_description=" . $row['Product_description'] . "&Product_price=" . $row['Product_price'] . "' class='icon-form'>";
            echo "<button type='submit' name='edit' class='edit-icon'><i id='edit' class='fas fa-edit'></i></button>";
            echo "</form>";
            echo "</div>";
            echo "</div>";
        }
        echo "</div>";
    } else {
        echo "<p>No products found in the table.</p>";
    }
}

if (isset($_POST['trash'])) {
    $product_ID = $_POST['product_id'];

    $delete = "DELETE FROM products WHERE Product_id=$product_ID";

    if (mysqli_query($conn, $delete)) {
        echo "Product deleted successfully.";
        echo "<meta http-equiv='refresh' content='2;url=admin.php?id=$user_ID'>";
    } else {
        echo "Error deleting product: " . mysqli_error($conn);
    }
}

// Close the database connection
mysqli_close($conn);
?>
</body>
</html>
