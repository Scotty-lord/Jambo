<?php
session_start();

if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
    // User is logged in, assign them to player 1
    $_SESSION["player_number"] = 1;
} else {
    // User is not logged in, redirect them to the login page
    header("Location: login.php");
    exit;
}

// Rest of your index.php code here
?>