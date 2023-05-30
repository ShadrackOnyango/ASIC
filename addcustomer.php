<?php
session_start();
require_once 'include/head.php';
require_once 'database/db_connection.php';
$success_msg = '';
?>

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">

<body>
  <?php require_once 'include/navbar.php'; ?>

  <div class="container">
    <?php if (isset($_SESSION['success_msg'])) : ?>
      <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
          <span class="sr-only">Close</span>
        </button>
        <strong><?php echo $_SESSION['success_msg']; ?></strong>
      </div>
    <?php
      unset($_SESSION['success_msg']);
    endif;
    ?>

    <div class="topnav" id="myTopnav">
      <a href="addcustomer.php" class="active"><i class="fas fa-user-plus"></i> Add New Member</a>
      <a href="updatecustomer.php"><i class="fas fa-table"></i> Update Member Details</a>
      <a href="app/deletecustomer.php" target="_blank"><i class="fas fa-print"></i> Delete Member</a>
    </div>

    <form action="app/addcustomerHandler.php" method="post" autocomplete="off">
      <div class="row">
        <div class="col-md-6 col-sm-4">
          <div class="form-group">
            <label for="username">Username</label>
            <input type="text" name="username" id="username" class="form-control" placeholder="Username" required>
          </div>
        </div>

        <div class="col-md-6 col-sm-4">
          <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" class="form-control" placeholder="Email" required>
          </div>
        </div>

        <div class="col-md-6 col-sm-4">
          <div class="form-group">
            <label for="password">Password</label>
            <input type="password" name="password" id="password" class="form-control" placeholder="Password" required>
          </div>
        </div>

        <div class="col-md-6 col-sm-4">
          <div class="form-group">
            <label for="role">Role</label>
            <select name="role" id="role" class="form-control" required>
              <option value="">Select Role</option>
              <option value="Member">MEMBER</option>
              <option value="Admin">ADMIN</option>
            </select>
          </div>
        </div>

        <div class="form-group">
          <button type="submit" class="btn btn-sm btn-primary" name="addcustomer">Register</button>
          <button type="reset" class="btn btn-sm btn-danger">Reset</button>
        </div>
      </div>
    </form>
  </div>
</body>
