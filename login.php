<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-image: url('images/dé.jpg');
            -webkit-background-size: cover;
            -moz-background-size: cover;
            -o-background-size: cover;
            background-size: cover;
            padding: 50px;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        h1 {
            color: #fff;
            text-shadow: 2px 2px #000;
            text-align: center;
            margin-bottom: 20px;
        }

        form {
            background-color: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.1);
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            backdrop-filter: blur(10px);
            display: flex;
            flex-direction: column;
            width: 300px;
        }

        label {
            color: #fff;
            font-weight: bold;
            margin-top: 10px;
            transition: color 0.3s ease;
        }

        input[type="text"], input[type="password"] {
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 5px;
            margin-top: 5px;
            background-color: rgba(255, 255, 255, 0.1);
            color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            transition: box-shadow 0.3s ease;
        }

        input[type="text"]:focus, input[type="password"]:focus {
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);
        }

        input[type="submit"] {
            background-color: #fff;
            color: #00b09b;
            padding: 14px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            margin-top: 10px;
            transition: background-color 0.3s ease;
        }

        input[type="submit"]:hover {
            background-color: rgba(255, 255, 255, 0.8);
        }
    </style>
  <script>
        function login() {
            // Get the form data
            var username = document.getElementById("username").value;
            var password = document.getElementById("password").value;

            // Validate the form data
            if (username == "" || password == "") {
                // Display an error message
                alert("All fields are required.");
            } else {
                // Submit the form
                document.getElementById("login_form").submit();
            }
        }
    </script>
</head>
<body>
    <h1>Bienvenue dans le Jambo </h1>
    <form action="game.php" method="post">
        <label for="username">Username:</label>
        <input type="text" name="username" id="username"><br>
        <label for="password">Password:</label>
        <input type="password" name="password" id="password"><br>
        <label for="remember">
            <input type="checkbox" name="remember" id="remember">
            se souvenir de moi
        </label><br>
        <input type="button" value="Login" onclick="login()">
        <p>
            Vous n'avez pas de compte? <a href="register.php">Sign up</a>
        </p>
    </form>
    <!-- JavaScript code here -->
</body>
</html>

<?php
session_start();

// Database connection code here

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the form data
    $username = $_POST["username"];
    $password = $_POST["password"];
    $remember = isset($_POST["remember"]);

    // Prepare the SQL query
    $sql = "SELECT * FROM users WHERE username = :username";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(":username", $username, PDO::PARAM_STR);
    $stmt->execute();

    // Check if the user exists
    if ($stmt->rowCount() > 0) {
        // Get the user data
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        // Check if the password is correct
        if (password_verify($password, $user["password"])) {
            // Set the session variables
            $_SESSION["loggedin"] = true;
            $_SESSION["username"] = $username;

            // Set a cookie if "remember me" is checked
            if ($remember) {
                setcookie("username", $username, time() + 60 * 60 * 24 * 7);
                setcookie("password", $password, time() + 60 * 60 * 24 * 7);
            }

            // Redirect the user to index.php
            header("Location: index.php");
            exit;
        } else {
            // Display an error message
            echo "<p>Incorrect password.</p>";
        }
    } else {
        // Display an error message
        echo "<p>Username does not exist.</p>";
    }

    // Close the statement
    unset($stmt);
}

// Check if the user is logged in or has a valid cookie
if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
    // Redirect the user to index.php
    header("Location: index.php");
    exit;
} elseif (isset($_COOKIE["username"]) && isset($_COOKIE["password"])) {
    // Get the cookie data
    $username = $_COOKIE["username"];
    $password = $_COOKIE["password"];

    // Prepare the SQL query
    $sql = "SELECT * FROM users WHERE username = :username";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(":username", $username, PDO::PARAM_STR);
    $stmt->execute();

    // Check if the user exists
    if ($stmt->rowCount() > 0) {
        // Get the user data
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        // Check if the password is correct
        if (password_verify($password, $user["password"])) {
            // Set the session variables
            $_SESSION["loggedin"] = true;
            $_SESSION["username"] = $username;

            // Redirect the user to index.php
            header("Location: index.php");
            exit;
        }
    }

    // Close the statement
    unset($stmt);
}

// Close the database connection
unset($pdo);
?>
