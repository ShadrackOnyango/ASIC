<?php
session_start();
require_once '../include/head.php';
require_once '../database/db_connection.php';

if (isset($_POST['addevent'])) {
  // Sanitize and escape user input
  $event_name = mysqli_real_escape_string($conn, $_POST['event_name']);
  $date = mysqli_real_escape_string($conn, $_POST['date']);
  $description = mysqli_real_escape_string($conn, $_POST['description']);

  // Perform the SQL query
  $query = "INSERT INTO events (event_name, date, description) VALUES ('$event_name', '$date', '$description')";
  if (mysqli_query($conn, $query)) {
    $_SESSION['success_msg'] = 'Event added successfully.';
    header('Location: ../addevent.php');
    exit;
  } else {
    $_SESSION['error_msg'] = 'Error: ' . mysqli_error($conn);
    header('Location: ../addevent.php');
    exit;
  }
} else {
  $_SESSION['error_msg'] = 'Invalid request.';
  header('Location: ../addevent.php');
  exit;
}
