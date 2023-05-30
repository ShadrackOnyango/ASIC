<?php
session_start();
require_once 'include/head.php';
require_once 'database/db_connection.php';
$success_msg = '';

// Update user detail
if (count($_POST) > 0) {
    mysqli_query($conn, "UPDATE users SET
        username = '" . $_POST['username'] . "',
        email = '" . $_POST['email'] . "',
        role = '" . $_POST['role'] . "',
        contribution = '" . $_POST['contribution'] . "'
        WHERE
        user_id = '" . $_POST['user_id'] . "'");

    $success_msg = 'Information successfully updated';
}

if (isset($_GET['user_id'])) {
    $user_id = $_GET['user_id'];
    
    $update_user = mysqli_query($conn, "SELECT * FROM users WHERE user_id = " . $user_id);
    
    if ($update_user) {
        $query = mysqli_fetch_assoc($update_user);
    } else {
        // Handle query error
        echo "Failed to fetch user details: " . mysqli_error($conn);
    }
} else {
    // Handle missing user_id
    echo "User ID is not specified in the URL.";
}
?>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

<body>
    <?php require_once 'include/navbar.php'; ?>
    <?php require_once 'include/sidebar.php'; ?>

    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            <span class="sr-only">Close</span>
        </button>
        <strong><?php if (isset($success_msg) && isset($query['username'])) { echo $query['username'] . $success_msg; } ?></strong>
    </div>

    <form action="" method="post" autocomplete="off">
        <div class="row">
        <div class="col-md-12 col-sm-4">
            <div class="form-group">
                <label for="">User ID</label>
                <select class="custom-select" name="user_id" id="" value="<?php echo $query['user_id']; ?>">
                <?php
                $result = mysqli_query($conn, "SELECT user_id, username FROM users");
                ?>
                <?php
                while ($row = mysqli_fetch_assoc($result)) {
                ?>
                <option disabled><?php echo $row['username']; ?></option>
                <option value="<?php echo $row['user_id']; ?>" <?php if (isset($query['user_id']) && $query['user_id'] == $row['user_id']) { echo 'selected'; } ?>>
                <?php echo $row['user_id']; ?>
                </option>
                <?php }?>
                </select>
            </div>
        </div>


            <div class="col-md-6 col-sm-4">
                <div class="form-group">
                    <label for="">Username</label>
                    <input type="text" name="username" id="" class="form-control" placeholder="Username"
                    value="<?php echo $query['username'] ?? ''; ?>">
                </div>
            </div>

            <div class="col-md-6 col-sm-4">
                <div class="form-group">
                    <label for="">Email</label>
                    <input type="email" name="email" id="" class="form-control" placeholder="Email"
                        value="<?php echo $query['email'] ?? ''; ?>">
                </div>
            </div>

            <div class="col-md-6 col-sm-4">
                <div class="form-group">
                    <label for="">Role</label>
                    <select name="role" id="" class="form-control">
                        <option value="">Select Role</option>
                        <option value="Member" <?php if (isset($query['role']) && $query['role'] == 'Member') { echo 'selected'; } ?>>Member</option>
                        <option value="Admin" <?php if (isset($query['role']) && $query['role'] == 'Admin') { echo 'selected'; } ?>>Admin</option>
                    </select>
                </div>
            </div>

            <div class="col-md-6 col-sm-4">
                <div class="form-group">
                    <label for="">Contribution</label>
                    <input type="text" name="contribution" id="" class="form-control" placeholder="Contribution"
                        value="<?php echo $query['contribution'] ?? ''; ?>">
                </div>
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-lg btn-primary" name="adduser">Update User</button>
            </div>
        </div>
    </form>
</body>
