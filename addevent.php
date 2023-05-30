<?php
session_start();
require_once 'include/head.php';
require_once 'database/db_connection.php';
$success_msg = '';

// Define and initialize the variables
$event_name = '';
$costant = '';

?>

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">

<body>
  <?php require_once 'include/navbar.php'; ?>

  <div class="alert alert-success alert-dismissible fade show " role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
      <span class="sr-only">Close</span>
    </button>
    <strong><?php echo isset($_SESSION['success_msg']) ? $_SESSION['success_msg'] : ''; ?></strong> 
  </div>
  
  <div class="topnav" id="myTopnav">
    <a href="addevent.php" class="active"><i class="fas fa-user-plus"></i> Add new event</a>
  </div>

  <form action="app/addeventHandler.php" method="post" autocomplete="off">
    <div class="row">
      <div class="col-md-6 col-sm-4">
        <div class="form-group">
          <label for="">Event Name</label>
          <div class="input-group">
            <input type="text" name="event_name" class="form-control" placeholder="Event Name"
              value="<?php echo $event_name . $costant; ?>" >
            <small class="input-group-text"><i class="fas fa-user-cog"></i></small>
          </div>
        </div>
      </div>

      <div class="col-md-6 col-sm-4">
        <div class="form-group">
          <label for="">Date</label>
          <input type="date" name="date" id="" class="form-control" placeholder="Date">
        </div>
      </div>

      <div class="col-md-12 col-sm-4">
        <div class="form-group">
          <label for="">Description</label>
          <textarea name="description" id="" class="form-control" placeholder="Description"> </textarea>
        </div>
      </div>

      <div class="form-group">
        <button type="submit" class="btn btn-sm btn-primary" name="addcustomer">Add Event</button>
        <button type="reset" class="btn btn-sm btn-danger">Reset</button>
      </div>
    </div>
  </form>

</body>
</html>
