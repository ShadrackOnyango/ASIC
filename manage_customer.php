<?php
session_start();
require_once 'database/db_connection.php';
require_once 'include/head.php';

// retrieve data from database
$retrieve = mysqli_query($conn, "SELECT * FROM users ORDER BY registration_date DESC");
?>

<?php require_once 'include/head.php'; ?>

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

<body>
   <?php require_once 'include/navbar.php'; ?>
   <?php require_once 'include/sidebar.php'; ?>

   <?php
   if (mysqli_num_rows($retrieve) > 0) {
   ?>
   <div class="container">
      <div class="row justify-content-center">
         <div class="col-md-8">
            <div class="ms-4 mr-4 mt-5">
               <div class="topnav mb-3" id="myTopnav">
                  <a href="addcustomer.php" class="active"><i class="fas fa-user-plus"></i> Add new customer</a>
                  <a href="pdfcustomer.php" target="_blank"><i class="fas fa-print"></i> Print all customers</a>
               </div>

               <table id="users" class="table table-bordered mt-3">
                  <thead class="bg-success text-white">
                     <tr>
                        <th>SN</th>
                        <th>Member ID</th>
                        <th>Member Name</th>
                        <th>Member Email</th>
                        <th>Role</th>
                        <th>Actions</th>
                     </tr>
                  </thead>
                  <tbody>
                     <?php
                     $num = 1;
                     while ($result = mysqli_fetch_assoc($retrieve)) {
                     ?>
                     <tr>
                        <td><?php echo $num++; ?></td>
                        <td><?php echo $result["user_id"]; ?></td>
                        <td><?php echo $result["username"]; ?></td>
                        <td><?php echo $result["email"]; ?></td>
                        <td><?php echo $result["role"]; ?></td>
                        <td>
                           <div class="d-flex justify-content-between">
                              <a href="updatecustomer.php?user_id=<?php echo $result["user_id"]; ?>" class="btn btn-primary"><i class="fas fa-pencil-alt"></i> Edit</a>
                              <a href="app/deletecustomer.php?username=<?php echo $result["username"]; ?>" class="btn btn-danger"><i class="fas fa-trash"></i> Delete</a>

                           </div>
                        </td>
                     </tr>
                     <?php
                     }
                     ?>
                  </tbody>
               </table>
            </div>
         </div>
      </div>
   </div>
   <?php
   } else {
      echo '<div class="container"><p class="text-center">No results found.</p></div>';
   }
   ?>

</body>
<?php require_once 'include/footer.php'; ?>
