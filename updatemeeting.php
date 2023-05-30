<?php
session_start();
require_once 'include/head.php';
require_once 'database/db_connection.php';
$success_msg = '';

// Update customer detail
if (count($_POST) > 0) {
    mysqli_query($conn, "UPDATE users SET
  user_id = '" . $_POST['user_id'] . "', username = '" . $_POST['username'] . "',
  email = '" . $_POST['email'] . "', role = '" . $_POST['role'] . "', contribution = '" . $_POST['contribution'] . "',
  WHERE
  username = '" . $_POST['username'] . "'");

  $success_msg = ' Information successfully updated';

}
$update_customer = mysqli_query($conn, "SELECT * FROM users
WHERE
username = '" . $_GET['username'] . "'");
$query = mysqli_fetch_assoc($update_customer);
?>

<body>
  <?php require_once 'include/navbar.php';?>
  <?php require_once 'include/sidebar.php';?>

  <body>
  <div class="alert alert-success alert-dismissible fade show " role="alert">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
         <span aria-hidden="true">&times;</span>
         <span class="sr-only">Close</span>
      </button>
      <strong><?php if (isset($success_msg)) { echo $query['username'] . $success_msg; } ?></strong>
   </div>

    <form action="" method="post" autocomplete="off">
      <div class="row">
        <div class="col-md-12 col-sm-4">
          <div class="form-group">
            <label for="">Member ID</label>
            <div class="input-group">
            <input type="hidden" name="user_id" value=" <?php echo $query['user_id']; ?>">
              <input type="number" name="" class="form-control" placeholder="Member ID"
                value="<?php echo $query['user_id']; ?>" readonly>
              <small class="input-group-text"><i class="fas fa-user-cog"></i></small>
            </div>
          </div>
        </div>

        <div class="col-md-12 col-sm-4">
          <div class="form-group">
            <label for="">Member Name</label>
            <select class="custom-select" name="username" id="" value="<?php echo $query['username']; ?>">
              <?php
               $result = mysqli_query($conn, "SELECT user_id, username FROM users");
               ?>
               <?php
               while ($row = mysqli_fetch_assoc($result)) {
               ?>
              <option disabled><?php echo $row['username']; ?></option>
              <option value="<?php echo $row['user_id']; ?>">
              <?php echo $row['user_id']; ?>
              </option>
              <?php }?>
            </select>
          </div>
        </div>

        <div class="col-md-6 col-sm-4">
          <div class="form-group">
            <label for="">Email</label>
            <input type="email" name="email" id="" class="form-control" placeholder="Email" 
            value="<?php echo $query['email']; ?>">
          </div>
        </div>

        <div class="col-md-6 col-sm-4">
          <div class="form-group">
            <label for="">Contribution</label>
            <input type="number" name="contribution" id="" class="form-control" placeholder="Contribution"
            value="<?php echo $query['contribution'];?>" >
          </div>
        </div>

        <div class="col-md-6 col-sm-4">
          <div class="form-group">
            <label for="">Role</label>
            <select name="role" id="" class="form-control" value="<?php echo $query['role'];?>">
              <option value="">Select Role</option>
              <option value="Member">Member</option>
              <option value="Admin">Admin</option>
            </select>
          </div>
        </div>

        <div class="form-group">
          <button type="submit" class="btn btn-lg btn-primary" name="addcustomer">Update Customer </button>
        </div>

      </div>
    </form>
    </main>
  </body>