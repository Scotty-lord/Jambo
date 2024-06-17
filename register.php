<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background: linear-gradient(to right, #00b894, #dd5e89, #f09819);
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

        label, p {
            color: #fff;
            font-weight: bold;
            margin-top: 10px;
            transition: color 0.3s ease;
        }

        input {
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

        input:focus {
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);
        }

        input[type="submit"] {
            background-color: #00b894;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        input[type="submit"]:hover {
            background-color: #009688;
        }

        a {
            color: #00b894;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        a:hover {
            color: #009688;
        }
    </style>
</head>
<body>
    <h1>créez votre compte et jouez au jambo!!!</h1>
    <form action="register.php" method="post">
        <label for="username">Username:</label>
        <input type="text" name="username" id="username"><br>
        <label for="password">Password:</label>
        <input type="password" name="password" id="password"><br>
        <label for="confirm_password">Confirm Password:</label>
        <input type="password" name="confirm_password" id="confirm_password"><br>
        <input type="submit" value="Register">
        <p>
            Vous avez deja un compte? <a href="login.php">Login</a>
        </p>
    </form>
</body>
</html>
<?php
// Vérifiez si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérez les données du formulaire
    $username = $_POST["username"];
    $password = $_POST["password"];
    $confirm_password = $_POST["confirm_password"];

    // Vérifiez les données
    if (empty($username) || empty($password) || empty($confirm_password)) {
        // Gérez les données manquantes ici
        exit();
    }

    if ($password != $confirm_password) {
        // Gérez les mots de passe qui ne correspondent pas ici
        exit();
    }

    // Sécurisez le mot de passe
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Ici, vous enregistrez les données dans une base de données
    $db->query("INSERT INTO users (username, password) VALUES (?, ?)", [$username, $hashed_password]);

    // Une fois l'enregistrement effectué, redirigez l'utilisateur vers la page de connexion
    header("Location: login.php");
    exit();
}
?>

