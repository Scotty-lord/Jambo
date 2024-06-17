<?php
session_start();

// Include functions file
require_once 'functions.php';

// Check if user is already logged in
if(isset($_SESSION['username'])) {
    header('Location: game.php');
}

// Handle login form submission
if(isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $message = login_user($username, $password);

    if($message === true) {
        // Login successful, redirect to game page
        $_SESSION['username'] = $username;
        header('Location: game.php');
    } else {
        // Login failed, display error message
        $error_message = $message;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Login</title>
  <!-- Add Bootstrap CSS for modal styling -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body>
  <?php if(isset($error_message)): ?>
  <!-- Display error message in a modal -->
  <div class="modal fade" id="errorModal" tabindex="-1" role="dialog" aria-labelledby="errorModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="errorModalLabel">Error</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <?php echo $error_message; ?>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
  <!-- Trigger the modal with JavaScript -->
  <script>
    $(document).ready(function() {
      $('#errorModal').modal('show');
    });
  </script>
  <?php endif; ?>

  <!-- Login form -->
  <form action="login.php" method="post">
    <label for="username">Username:</label><br>
    <input type="text" id="username" name="username"><br>
    <label for="password">Password:</label><br>
    <input type="password" id="password" name="password"><br>
    <input type="submit" name="login" value="Login">
  </form>

  <!-- Add jQuery for modal functionality -->
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
  <!-- Add Bootstrap JS for modal functionality -->
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>
