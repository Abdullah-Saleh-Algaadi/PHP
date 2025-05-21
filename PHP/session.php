<?php
session_start(); // Start the session

// Check if the user is logged in by verifying the session
if (!isset($_SESSION['user_name'])) {
    // Redirect to the login page if the username is not set
    header("Location: index.php");
    exit;
}

// Retrieve the username from the session
$username = $_SESSION['user_name'];
$user_ID = $_GET['id'];
?>