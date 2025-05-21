<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login/Signup</title>
    <link rel="stylesheet" href="/project/CSS/login.css">
</head>
<body>
    
</body>
</html>
<?php
session_start(); // Start the session
include("database.php");

function handleException($message) {
    echo "<p class='error-message'>" . htmlspecialchars($message) . "</p>";
}

$error_message = "";

mysqli_report(MYSQLI_REPORT_OFF);

try {
    // Handle Signup
    if (isset($_POST['Signup'])) {
        $username = trim($_POST['username']);
        $email = trim($_POST['signupEmail']);
        $password = trim($_POST['signupPassword']);

        // Hash the password
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Insert user into the database
        $insert = "INSERT INTO users (user_name, user_email, user_password) VALUES ('$username', '$email', '$hashed_password')";
        $result = mysqli_query($conn, $insert);

        if ($result) {
            echo "<p class='success-message'>User registered successfully!</p>";
        } else {
            if (mysqli_errno($conn) == 1062) {
                throw new Exception("A record with this email or username already exists. Please use a different email or username.");
            } else {
                throw new Exception("An error occurred while registering the user: " . mysqli_error($conn));
            }
        }
    }

    // Handle Login
    
    if (isset($_POST['login'])) {
        $email = trim($_POST['loginEmail']);
        $password = trim($_POST['loginPassword']);

        // Sanitize email
        // $email = mysqli_real_escape_string($conn, $email);

        // Query the database for the user
        $query = "SELECT * FROM users WHERE user_email = '$email'";
        $result = mysqli_query($conn, $query);

        // Check if the user exists
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $db_password = $row['user_password'];
            $name = $row['user_name']; 
            $user_ID = $row['user_id']; 
            $user_type = $row['user_type'];

            // Verify the password
            if (password_verify($password, $db_password)) {
                // Store username in the session
                $_SESSION['user_name'] = $name;

                // Redirect based on user type
                if ($user_type == "customer") { 
                    echo "<meta http-equiv='refresh' content='2;url=customer.php?id=$user_ID'>";
                    exit; 
                } else { 
                    echo "<meta http-equiv='refresh' content='2;url=admin.php?id=$user_ID'>";
                    exit; 
                }
            } else {
                echo "<p class='error-message'>Invalid password.</p>";
            }
        } else {
            echo "<p class='error-message'>No user found with this email.</p>";
        }
    }
}catch (Exception $e) {
    handleException($e->getMessage());
}

mysqli_close($conn);

?>

<?php

include('../HTML/login.html'); // If `HTML` folder is one level up
//include($_SERVER['DOCUMENT_ROOT'] . '/Project/HTML/login.html');

?>

