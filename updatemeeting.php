<?php
session_start();
require_once 'include/head.php';
require_once 'database/db_connection.php';
$success_msg = '';

// Update meeting detail
if (count($_POST) > 0) {
    mysqli_query($conn, "UPDATE meetings SET
        meeting_name = '" . $_POST['meeting_name'] . "',
        date = '" . $_POST['date'] . "',
        description = '" . $_POST['description'] . "'
        WHERE
        meeting_id = '" . $_POST['meeting_id'] . "'");

    $success_msg = 'meeting information successfully updated';
}

if (isset($_GET['meeting_id'])) {
    $meeting_id = $_GET['meeting_id'];
    
    $update_meeting = mysqli_query($conn, "SELECT * FROM meetings WHERE meeting_id = " . $meeting_id);
    
    if ($update_meeting) {
        $query = mysqli_fetch_assoc($update_meeting);
    } else {
        // Handle query error
        echo "Failed to fetch meeting details: " . mysqli_error($conn);
    }
} else {
    // Handle missing meeting_id
    echo "meeting ID is not specified in the URL.";
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
        <strong><?php if (isset($success_msg) && isset($query['meeting_name'])) { echo $query['meeting_name'] . $success_msg; } ?></strong>
    </div>

    <form action="" method="post" autocomplete="off">
        <div class="row">
            <div class="col-md-12 col-sm-4">
                <div class="form-group">
                    <label for="">meeting ID</label>
                    <div class="input-group">
                        <input type="hidden" name="meeting_id" value="<?php echo $query['meeting_id'] ?? ''; ?>">
                        <input type="number" name="" class="form-control" placeholder="meeting ID"
                            value="<?php echo $query['meeting_id'] ?? ''; ?>" readonly>
                        <small class="input-group-text"><i class="fas fa-calendar-alt"></i></small>
                    </div>
                </div>
            </div>

            <div class="col-md-12 col-sm-4">
                <div class="form-group">
                    <label for="">Meeting Name</label>
                    <select class="custom-select" name="meeting_name" id="" value="<?php echo $query['meeting_name']; ?>">
                    <?php
                    $result = mysqli_query($conn, "SELECT meeting_id, meeting_name FROM meetings");
                    ?>
                    <?php
                    while ($row = mysqli_fetch_assoc($result)) {
                    ?>
                    <option disabled><?php echo $row['meeting_name']; ?></option>
                    <option value="<?php echo $row['meeting_name']; ?>" <?php if (isset($query['meeting_name']) && $query['meeting_name'] == $row['meeting_name']) { echo 'selected'; } ?>>
                    <?php echo $row['meeting_name']; ?>
                    </option>
                    <?php }?>
                    </select>
                </div>
            </div>

            <div class="col-md-6 col-sm-4">
                <div class="form-group">
                    <label for="">Date</label>
                    <input type="date" name="date" id="" class="form-control" placeholder="Date"
                        value="<?php echo $query['date'] ?? ''; ?>">
                </div>
            </div>

            <div class="col-md-12 col-sm-4">
                <div class="form-group">
                    <label for="">Description</label>
                    <textarea name="description" id="" class="form-control"
                        placeholder="Description"><?php echo $query['description'] ?? ''; ?></textarea>
                </div>
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-lg btn-primary" name="updatemeeting">Update meeting</button>
            </div>
        </div>
    </form>
</body>
