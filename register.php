<?php
// Start the session
session_start();

// Check if the user is already logged in, redirect to dashboard
if (isset($_SESSION['user_id'])) {
  header("Location: dashboard.php");
  exit();
}

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Retrieve form data
  $username = $_POST['username'];
  $password = $_POST['password'];
  $email = $_POST['email'];
  $role = $_POST['role']; // New line to retrieve the role value

  // Validate the form data (you can add more validation if needed)
  if (empty($username) || empty($password) || empty($email)) {
    $error = "Please fill in all fields";
  } else {
    // Database connection
    $conn = new mysqli('localhost', 'root', '', 'ASIC10');
    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }

    // Check if the username or email already exists in the database
    $query = "SELECT * FROM users WHERE username = '$username' OR email = '$email'";
    $result = $conn->query($query);
    if ($result->num_rows > 0) {
      $error = "Username or email already exists";
    } else {
      // Generate a random user ID
      $user_id = 'ASIC' . rand(1, 999);

      // Insert user data into the database
      $query = "INSERT INTO users (user_id, username, password, email, role, registration_date) VALUES ('$user_id', '$username', '$password', '$email', '$role', NOW())";
      if ($conn->query($query) === TRUE) {
        // Registration successful, redirect to dashboard
        $_SESSION['user_id'] = $user_id;
        header("Location: dashboard.php");
        exit();
      } else {
        $error = "Error occurred during registration";
      }
    }

    // Close the database connection
    $conn->close();
  }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Registration</title>
   <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
   
</head>

<body>
  <div class="container mt-5">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="card">
          <div class="card-body">
            <div class="text-center">
              <img src="images/user2.png" alt="Avatar" class="avatar img-fluid rounded-circle">
            </div>
            <form method="POST" action="register.php" autocomplete="off">
              <div class="form-group">
                <label for="username">Username</label>
                <input type="text" class="form-control" id="username" name="username" placeholder="Enter Username" required>
              </div>
              <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Enter Password" required>
              </div>
              <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Enter Email" required>
              </div>
              <div class="form-group">
                <label for="role">Role</label>
                <select class="form-control" id="role" name="role" required>
                  <option value="">Select Role</option>
                  <option value="Member">Member</option>
                  <option value="Admin">Admin</option>
                </select>
              </div>
              <div class="text-center">
               <p class="text-center mt-3">Already a member? <a href="login.php">Sign In</a></p>
                <button type="submit" class="btn btn-primary">Register</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
</body>

</html>
