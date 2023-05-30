<?php
session_start();
require_once '../database/db_connection.php';

if (isset($_POST['addcustomer'])) {
  $username = $_POST['username'];
  $email = $_POST['email'];
  $password = $_POST['password'];
  $role = $_POST['role'];

  // Validate the form data (you can add more validation if needed)
  if (empty($username) || empty($email) || empty($password) || empty($role)) {
    $_SESSION['error_msg'] = "Please fill in all fields";
    header("Location: ../addcustomer.php");
    exit();
  }

  // Avoid SQL injection
  $username = mysqli_real_escape_string($conn, $username);
  $email = mysqli_real_escape_string($conn, $email);
  $password = mysqli_real_escape_string($conn, $password);
  $role = mysqli_real_escape_string($conn, $role);

  // Check if the username already exists
  $check_query = "SELECT * FROM users WHERE username = '$username'";
  $check_result = mysqli_query($conn, $check_query);

  if (mysqli_num_rows($check_result) > 0) {
    $_SESSION['error_msg'] = "Username already exists. Please choose a different username";
    header("Location: ../addcustomer.php");
    exit();
  }

  // Hash the password
  $hashed_password = password_hash($password, PASSWORD_DEFAULT);

  // Insert the new member into the database
  $insert_query = "INSERT INTO users (username, email, password, role) VALUES ('$username', '$email', '$hashed_password', '$role')";
  $insert_result = mysqli_query($conn, $insert_query);

  if ($insert_result) {
    $_SESSION['success_msg'] = "New member added successfully";
    header("Location: ../dashboard_admin.php");
    exit();
  } else {
    $_SESSION['error_msg'] = "Failed to add new member";
    header("Location: ../addcustomer.php");
    exit();
  }
} else {
  $_SESSION['error_msg'] = "Invalid request";
  header("Location: ../addcustomer.php");
  exit();
}
?>
