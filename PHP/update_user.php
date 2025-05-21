<?php include("session.php");?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/project/CSS/style.css?v=<?php echo time(); ?>">
    <title>Update User</title>
</head>
<header class="header">
    <h1>Hi, <?php echo htmlspecialchars($username); ?></h1>
    <div class="search">
        <form method="get">
            <!-- <input type="hidden" name="id" value="<?php echo $user_ID; ?>"> -->
            <input type="text" name="query" placeholder="Search..." class="search-input">
            <button type="submit" class="search-button"><i class="fas fa-search"></i></button>
        </form>
    </div>
    <div class="user-management">
        <a href="admin.php?id=<?php echo $user_ID; ?>" id="user-management">Home</a>
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

    <?php
include("database.php");

    $user_email = $_GET['userEmail'];
    $user_name = $_GET['userName'];
    $user_type = $_GET['userType'];


        echo "<form class='user-info' method='post' id='user-management-form'>";
            echo "User Email:<input type='text' name='user-Email' id='user-email' value='". $user_email ."' placeholder='User email'>";
            echo "User Name:<input type='text' name='user-Name' id='user-name' value='" . $user_name . "' placeholder='User name'>";
            echo "User Type:<input type='text' name='user-Type' id='user-type' value='" . $user_type . "' placeholder='User type'>";
            echo "<input type='hidden' name='update-user' value='1'>"; // Hidden field to indicate update
            echo "<input type='submit' name='update' id='update-user' value='Update'>";
        echo "</form>";



    if (isset($_POST['update'])) {
        $userName = $_POST['user-Name'];
        $userEmail = $_POST['user-Email'];
        $userType = $_POST['user-Type'];

        $updateUser = "UPDATE users SET user_name='$userName', user_type='$userType' WHERE user_email='$userEmail'";
        $result = mysqli_query($conn, $updateUser);
        if ($result) {
            echo "user Update Successfully !";
        } else {
            echo "Error: " . mysqli_error($conn);
        }        
    }


    mysqli_close($conn);
// }
?>
    <script src="/project/JavaScript/index.js?v=<?php echo time(); ?>"></script>
</body>
</html>