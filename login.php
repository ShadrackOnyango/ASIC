<?php
session_start();
require_once 'database/db_connection.php';

// Check if the user is already logged in
if (isset($_SESSION['user_id'])) {
  // Redirect to dashboard based on role
  if ($_SESSION['role'] === 'admin') {
    header("Location: dashboard_admin.php");
    exit();
  } else {
    header("Location: dashboard.php");
    exit();
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/3.1.0/css/adminlte.min.css">
</head>

<body class="hold-transition login-page">
  <div class="login-box">

    <div class="card">
      <div class="card-body login-card-body">
        <h3 class="card-title text-center">Login</h3>
        <form action="app/loginHandler.php" method="post" autocomplete="off"><br>
          <div class="form-group">
            <label for="uname">Full Name</label>
            <input type="text" class="form-control" id="uname" name="uname" placeholder="Enter Full Name" required>
          </div>
          <div class="form-group">
            <label for="psw">Password</label>
            <input type="password" class="form-control" id="psw" name="psw" placeholder="Enter Password" required>
          </div>
          <div class="form-group form-check">
            <input type="checkbox" class="form-check-input" id="remember" name="remember" checked>
            <label class="form-check-label" for="remember">Remember me</label>
          </div>
          <button type="submit" class="btn btn-primary btn-block" name="login">Sign In</button>
          <p class="text-center mt-3">Not a member? <a href="register.php">Register</a></p>
          <p class="text-center"><a href="#">Forgot password?</a></p>
        </form>
      </div>
    </div>
  </div>

  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/3.1.0/js/adminlte.min.js"></script>
</body>

</html>
