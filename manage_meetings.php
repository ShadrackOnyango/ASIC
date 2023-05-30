<?php
session_start();
require_once 'database/db_connection.php';
require_once 'include/head.php';

// retrieve data from database
$retrieve = mysqli_query($conn, "SELECT * FROM meetings");
?>

<?php require_once 'include/head.php'; ?>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

<body>
   <?php require_once 'include/navbar.php'; ?>
   <?php require_once 'include/sidebar.php'; ?>

   <?php
   if (mysqli_num_rows($retrieve) > 0) {
   ?>
   <div class="container">
    <div class="row justify_content_center">
        <div class="col-md-8">
      <div class="ms-4 mr-4">
         <div class="topnav mt-5" id="myTopnav">
            <a href="addmeeting.php" class="active"><i class="fas fa-user-plus"></i> Add new  meeting</a>
            <a href="pdfcustomer.php" target="_blank"><i class="fas fa-print"></i> Print all meetings</a>
         </div>
    
                <table id="meetingss" class="mt-3">
                    <thead class="bg-success table-bordered">
                    <tr>
                            <th>SN</th>
                        <th>Meeting ID</th>
                        <th>Meeting Name</th>
                        <th>Meeting Description</th>
                        <th>Date</th>
                    </tr>
                    </thead>
                    <?php
                    $num = 1;
                    $i = 0;
                    while ($result = mysqli_fetch_assoc($retrieve)) {
                    ?>

                    <tbody class="table-bordered">
                        <tr>
                            <td><?php echo $num++; ?></td>
                            <td><?php echo $result["meeting_id"]; ?></td>
                            <td><?php echo $result["meeting_name"]; ?></td>
                            <td><?php echo $result["description"]; ?></td>
                            <td><?php echo $result["date"]; ?></td>

                            <td colspan="">
                                <a href="updatecustomer.php?meeting_id=<?php echo $result["meeting_id"]; ?>" type="submit" class="btn btn-primary"><i class="fas fa-pencil-alt"></i> Edit</a>
                                <a href="app/deletemeeting.php?meeting_id=<?php echo $result["meeting_id"]; ?>" type="submit" class="btn btn-danger"><i class="fas fa-trash"></i> Delete</a>
                                <a href="pdf_singlecustomer.php?meeting_id=<?php echo $result['meeting_id']; ?>" type="submit" class="btn btn-primary" target="_blank"><i class="fas fa-print"></i> Print</a>
                            </td>
                        </tr>
                    </tbody>
                    <?php
                    $i++;
                    }
                    ?>
                </table>
            </div>
        </div>
    </div>
      </div>
   <?php
   } else {
      echo 'No result found';
   }
   ?>

</body>
<?php require_once 'include/footer.php'; ?>
