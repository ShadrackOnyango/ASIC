<?php
session_start();
$delete_msg = 'Meeting has been deleted';

require_once '../database/db_connection.php';
$delete_meeting = "DELETE FROM meetings
 WHERE 
 meeting_id = '".$_GET['meeting_id']."'";

if (mysqli_query($conn, $delete_meeting)) {

   header('Location:../manage_meetings.php');
   $_SESSION['delete_msg'] = $delete_msg;
}else {
   echo 'Unknown error occured during deleting, check the data you are trying to delete and try again';
   mysqli_close($conn);
}