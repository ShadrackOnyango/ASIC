<?php
session_start();
require_once '../database/db_connection.php';

$username = $_POST['uname'];
$password = $_POST['psw'];

// Avoid SQL injection
$username = mysqli_real_escape_string($conn, $username);
$password = mysqli_real_escape_string($conn, $password);

$access = "SELECT * FROM users WHERE username = '$username'";
$result = mysqli_query($conn, $access);
$count = mysqli_num_rows($result);

if ($count == 1) {
   $row = mysqli_fetch_assoc($result);
   
   if ($password == $row['password']) {
      $_SESSION['user_id'] = $row['user_id'];
      $_SESSION['role'] = $row['role'];
      
      // Redirect to dashboard based on role
      if ($row['role'] === 'Admin') {
         header("Location: ../dashboard_admin.php");
         exit();
      } else {
         header("Location: ../dashboard.php");
         exit();
      }
   }
}

header("Location: ../login.php?error=login_failed");
exit();
?>
