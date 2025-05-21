<?php include("session.php");?>
<!-- html -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert page</title>
    <link rel="stylesheet" href="/project/CSS/style.css?v=<?php echo time(); ?>">
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
</head>
<body>
<form name="insert_form" class="my-form" method="post" id="insert-form" enctype="multipart/form-data">
    Product Name: <input type="text" name="Product_name" id="insert_product_name" class="data" placeholder="Enter product name "><br>
    Product Description: <input type="text" name="Product_description" id="insert_Product_description" class="data" placeholder="Enter product description "><br>
    Product Price: <input type="number" name="Product_price" id="insert_Product_price" class="data" placeholder="Enter product price "><br>
    Product Picture: <input type="file" name="Product_picture" id="insert_Product_picture" class="data" placeholder="Enter product picture "><br>
    <input type="submit" value="Insert" name="insert_button" id="button">
</form>
<!-- <script src="index.js"></script> -->

<script src="/project/JavaScript/index.js?v=<?php echo time(); ?>"></script>
<?php
include("database.php");

if (isset($_POST['insert_button'])) {
    // Retrieve form data
    $name = $_POST['Product_name'];
    $description = $_POST['Product_description'];
    $price = $_POST['Product_price'];

    // Process the uploaded file
    $target_dir = "../uploads/";
    $target_file = $target_dir . basename($_FILES["Product_picture"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Check if image file is an actual image or fake image
    $check = getimagesize($_FILES["Product_picture"]["tmp_name"]);
    if ($check !== false) {
        $uploadOk = 1;
    } else {
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
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
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
        } else {
            echo "Sorry, there was an error uploading your file.<br>";
        }
    }

    if ($uploadOk == 1) {
        // Insert data into the database
        $sql = "INSERT INTO products (Product_name, Product_description, Product_price, Product_picture) 
                VALUES ('$name', '$description', $price, '$target_file')";

        if (mysqli_query($conn, $sql)) {
        echo "New record created successfully<br>";
        echo "<meta http-equiv='refresh' content='2;url=admin.php?id=$user_ID'>";
    }else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
    }else{
        echo "Image is not correct ";
    }
}
    // Close the database connection
    mysqli_close($conn);
?>
</body>
</html>
