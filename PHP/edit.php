<?php include("session.php") ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit</title>
    <link rel="stylesheet" href="/project/CSS/style.css?v=<?php echo time(); ?>">
</head>
<header class="header">
    <h1>Welcome <?php echo htmlspecialchars($username); ?></h1>
    <div class="insert">
        <a href="admin.php?id=<?php echo $user_ID; ?>" id="insert">Home</a>
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
    <form method="post" enctype="multipart/form-data" id="update-form" class="my-form">
    <label for="update_Product_name">Product Name:</label>
    <input type="text" name="update_Product_name" id="update_Product_name" class="data" value="<?php echo $_GET['Product_name']; ?>" placeholder="Enter product name "><br>

    <label for="update_product_description">Product Description:</label>
    <input type="text" name="update_product_description" id="update_product_description" class="data" value="<?php echo $_GET['Product_description']; ?>" placeholder="Enter product description  "><br>

    <label for="update_Product_price">Product Price:</label>
    <input type="number" name="update_Product_price" id="update_Product_price" class="data" value="<?php echo $_GET['Product_price']; ?>" placeholder="Enter product pice  "><br>

    <label for="Product_picture">Product Picture:</label>
    <input type="file" name="Product_picture" id="Product_picture" class="data"><br>

    <input type="submit" name="update_button" value="Update" id="button">
</form>
<script src="/project/JavaScript/index.js?v=<?php echo time(); ?>"></script>
<?php
include("database.php");
$product_id = $_GET['product_id'];
$product_picture = $_GET['Product_picture'];


if (isset($_POST['update_button'])) {
    $Product_name = $_POST['update_Product_name'];
    $Product_description = $_POST['update_product_description'];
    $Product_price = $_POST['update_Product_price']; 

    $target_dir = "../uploads/";
    $uploadOk = 1;

    // Check if file was uploaded
    if (isset($_FILES["Product_picture"]) && $_FILES["Product_picture"]["error"] == 0) {
        $target_file = $target_dir . basename($_FILES["Product_picture"]["name"]);
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Check if image file is an actual image or fake image
        $check = getimagesize($_FILES["Product_picture"]["tmp_name"]);
        if ($check === false) {
            echo "File is not an image.<br>";
            $uploadOk = 0;
        }

        // Check if file already exists
        if (file_exists($target_file)) {
            echo "Sorry, file already exists.<br>";
            $uploadOk = 0;
        }

        // Check file size
        if ($_FILES["Product_picture"]["size"] > 5000000) {
            echo "Sorry, your file is too large.<br>";
            $uploadOk = 0;
        }

        // Allow certain file formats
        if (!in_array($imageFileType, ['jpg', 'png', 'jpeg', 'gif'])) {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.<br>";
            $uploadOk = 0;
        }

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.<br>";
        } else {
            // Upload the file
            if (move_uploaded_file($_FILES["Product_picture"]["tmp_name"], $target_file)) {
                echo "The file " . htmlspecialchars(basename($_FILES["Product_picture"]["name"])) . " has been uploaded.<br>";
                $uploaded_picture = $target_file; // Store the path of the uploaded file
            } else {
                echo "Sorry, there was an error uploading your file.<br>";
            }
        }
    } else {
        // If no new picture uploaded, use the existing one
        $uploaded_picture = $product_picture; // Assuming this is the current picture's path
    }

    // Prepare the SQL update statement
    $update = "UPDATE products SET 
                Product_name = '$Product_name', 
                Product_description = '$Product_description',
                Product_price = $Product_price,
                Product_picture = '$uploaded_picture'
                WHERE Product_id = $product_id";

    $result = mysqli_query($conn, $update);   
    
    if ($result) {
        echo "Updated successfully.";
        echo "<meta http-equiv='refresh' content='2;url=admin.php?id=$user_ID'>";
    } else {
        echo "Update failed: " . mysqli_error($conn);
    }
}
?>
</body>
</html>
