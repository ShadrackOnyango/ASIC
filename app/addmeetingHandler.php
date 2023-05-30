<?php
session_start();
require_once '../include/head.php';
require_once '../database/db_connection.php';

if (isset($_POST['addmeeting'])) {
  // Sanitize and escape user input
  $meeting_name = mysqli_real_escape_string($conn, $_POST['meeting_name']);
  $date = mysqli_real_escape_string($conn, $_POST['date']);
  $description = mysqli_real_escape_string($conn, $_POST['description']);

  // Perform the SQL query
  $query = "INSERT INTO meetings (meeting_name, date, description) VALUES ('$meeting_name', '$date', '$description')";
  if (mysqli_query($conn, $query)) {
    $_SESSION['success_msg'] = 'Meeting Scheduled Successfully.';
    header('Location: ../addmeeting.php');
    exit;
  } else {
    $_SESSION['error_msg'] = 'Error: ' . mysqli_error($conn);
    header('Location: ../addmeeting.php');
    exit;
  }
} else {
  $_SESSION['error_msg'] = 'Invalid request.';
  header('Location: ../addmeeting.php');
  exit;
}
?>
