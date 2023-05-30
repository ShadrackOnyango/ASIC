<?php
session_start();
$delete_msg = 'Member has been deleted';

require_once '../database/db_connection.php';
$delete_customer = "DELETE FROM users
 WHERE 
 username = '".$_GET['username']."'";

if (mysqli_query($conn, $delete_customer)) {

   header('Location:../manage_customer.php');
   $_SESSION['delete_msg'] = $delete_msg;
}else {
   echo 'Unknown error occured during deleting, check the data you are trying to delete and try again';
   mysqli_close($conn);
}