<?php
// Include database file
require_once 'database.php';

// Register user
function register_user($username, $password) {
    global $conn; // Use $conn instead of $db

    // Check if user already exists
    $result = $conn->query("SELECT * FROM users WHERE username='$username'");

    if ($result->num_rows > 0) {
        return "User already exists";
    } else {
        // Hash the password
        $password = password_hash($password, PASSWORD_DEFAULT);

        // Insert user into the database
        $conn->query("INSERT INTO users (username, password) VALUES ('$username', '$password')");

        return "User registered successfully";
    }
}

// Login user
function login_user($username, $password) {
    global $conn; // Use $conn instead of $db

    // Check if user exists
    $result = $conn->query("SELECT * FROM users WHERE username='$username'");

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        // Verify the password
        if (password_verify($password, $user['password'])) {
            // Store user information in session variables
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['score'] = $user['score'];

            return true;
        } else {
            return "Incorrect password";
        }
    } else {
        return "User not found";
    }
}

// Logout user
function logout_user() {
    // Destroy session variables
    session_destroy();

    // Redirect to login page
    header('Location: login.php');
}

// Update user's score
function update_score($score) {
    global $conn; // Use $conn instead of $db

    // Update the score in the database
    $user_id = intval($_SESSION['user_id']);
    $conn->query("UPDATE users SET score=$score WHERE id=$user_id");
}
