<?php
session_start();
$delete_msg = 'Event has been deleted';

require_once '../database/db_connection.php';
$delete_event = "DELETE FROM events
 WHERE 
 event_id = '".$_GET['event_id']."'";

if (mysqli_query($conn, $delete_event)) {

   header('Location:../manage_events.php');
   $_SESSION['delete_msg'] = $delete_msg;
}else {
   echo 'Unknown error occured during deleting, check the data you are trying to delete and try again';
   mysqli_close($conn);
}