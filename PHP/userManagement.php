<?php include("session.php");?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Management </title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css" integrity="sha512-5Hs3dF2AEPkpNAR7UiOHba+lRSJNeM2ECkwxUIxC1Q/FLycGTbNapWXB4tP889k5T5Ju8fs4b1P5z/iB4nMfSQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="/project/CSS/style.css?v=<?php echo time(); ?>">
</head>
<header class="header">
    <h1>Hi, <?php echo htmlspecialchars($username); ?></h1>
    <div class="search">
        <form method="get">
            <input type="hidden" name="id" value="<?php echo $user_ID; ?>">
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

<form class="user-info" method="post" id='search-by-user-email'>
    <input type="text" name="user-Email" id="user-Email" placeholder="Enter email">
    <input type="submit" name="search-user" id="search-user" value="Search">
</form>

<script src="/project/JavaScript/index.js?v=<?php echo time(); ?>"></script>
<?php
include("database.php");

if (isset($_POST['search-user'])) {
    $user_email = $_POST['user-Email'];
    
    $selectUser = "SELECT user_name, user_email, user_type FROM users WHERE user_email='$user_email'";
    $result = mysqli_query($conn, $selectUser);
    if ($result) {
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result); 
            $user_name = htmlspecialchars($row['user_name']);
            $user_type = htmlspecialchars($row['user_type']);
            echo "<meta http-equiv='refresh' content='2;url=update_user.php?id=$user_ID&userEmail=$user_email&userName=$user_name&userType=$user_type'>";
        } else {
            echo "No user found.";
        }
    } else {
        echo mysqli_error($conn);
    }
}


?>
</body>
</html>
