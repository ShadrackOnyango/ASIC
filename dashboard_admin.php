<?php
session_start();
require_once 'include/head.php';
require_once 'database/db_connection.php';

$contributionsQuery = "SELECT SUM(contribution) AS totalContribution FROM users";
$contributionsResult = mysqli_query($conn, $contributionsQuery);
$row = mysqli_fetch_assoc($contributionsResult);
$totalContribution = $row['totalContribution'];
?>

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
<!-- Include AdminLTE CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/3.1.0/css/adminlte.min.css">

<body class="hold-transition sidebar-mini">
  <div class="wrapper">

    <?php require_once 'include/navbar.php'; ?>
    <?php require_once 'include/sidebar.php'; ?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Main content -->
      <section class="content my-4">
        <div class="container-fluid">
          <!-- Small boxes (Stat box) -->
          <div class="row">
            <div class="col-lg-4 col-md-6">
              <!-- small box -->
              <?php
              $sql = "SELECT username, SUM(contribution) AS total_contribution FROM users GROUP BY username";
              $result = mysqli_query($conn, $sql);
              $data = mysqli_fetch_assoc($result);
              ?>

              <div class="small-box bg-info">
                <div class="inner">
                  <h3>Ksh. <?php echo $totalContribution; ?></h3>
                  <p>Total Contribution</p>
                </div>
                <div class="icon">
                  <i class="fas fa-cogs"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <!-- ./col -->

            <div class="col-lg-4 col-md-6">
              <!-- small box -->
              <?php
              $sql = "SELECT COUNT(*) AS total FROM users";
              $result = mysqli_query($conn, $sql);
              $data = mysqli_fetch_assoc($result);
              ?>

              <div class="small-box bg-success">
                <div class="inner">
                  <h3><?php echo $data['total']; ?></h3>
                  <p>Users</p>
                </div>
                <div class="icon">
                  <i class="fas fa-user"></i>
                </div>
                <a href="manage_users.php" class="small-box-footer">Manage <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <!-- ./col -->

            <div class="col-lg-4 col-md-6">
              <!-- small box -->
              <?php
              $sql = "SELECT COUNT(*) AS total FROM user_account";
              $result = mysqli_query($conn, $sql);
              $data = mysqli_fetch_assoc($result);
              ?>

              <div class="small-box bg-warning">
                <div class="inner">
                  <h3><?php echo $data['total']; ?></h3>
                  <p>User Accounts</p>
                </div>
                <div class="icon">
                  <i class="fas fa-users"></i>
                </div>
                <a href="manage_user_accounts.php" class="small-box-footer">Manage <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <!-- ./col -->
          </div>
        </div>
      </section>
    </div>
    <!-- /.content-wrapper -->

    <?php require_once 'include/footer.php'; ?>
  </div>
  <!-- ./wrapper -->

  <!-- Include AdminLTE JavaScript -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/3.1.0/js/adminlte.min.js"></script>
</body>
