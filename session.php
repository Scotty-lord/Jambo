<?php
session_start();

// Database connection
$db = new mysqli('localhost', 'root', 'root', 'game_session');

// Check connection
if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}

// Register user
if(isset($_POST['register'])) {
    $username = $db->real_escape_string($_POST['username']);
    $password = $db->real_escape_string($_POST['password']);

    // Check if user already exists
    $result = $db->query("SELECT * FROM users WHERE username='$username'");

    if ($result->num_rows > 0) {
        echo "User already exists";
    } else {
        // Hash the password
        $password = password_hash($password, PASSWORD_DEFAULT);

        // Insert user into the database
        $db->query("INSERT INTO users (username, password) VALUES ('$username', '$password')");

        echo "User registered successfully";
    }
}

// Login user
if(isset($_POST['login'])) {
    $username = $db->real_escape_string($_POST['username']);
    $password = $db->real_escape_string($_POST['password']);

    // Check if user exists
    $result = $db->query("SELECT * FROM users WHERE username='$username'");

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        // Verify the password
        if (password_verify($password, $user['password'])) {
            // Store user information in session variables
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['score'] = $user['score'];

            header('Location: game.php');
        } else {
            echo "Incorrect password";
        }
    } else {
        echo "User not found";
    }
}

$db->close();
?>

