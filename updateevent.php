<?php
session_start();
require_once 'include/head.php';
require_once 'database/db_connection.php';
$success_msg = '';

// Update event detail
if (count($_POST) > 0) {
    mysqli_query($conn, "UPDATE events SET
        event_name = '" . $_POST['event_name'] . "',
        date = '" . $_POST['date'] . "',
        description = '" . $_POST['description'] . "'
        WHERE
        event_id = '" . $_POST['event_id'] . "'");

    $success_msg = 'Event information successfully updated';
}

if (isset($_GET['event_id'])) {
    $event_id = $_GET['event_id'];
    
    $update_event = mysqli_query($conn, "SELECT * FROM events WHERE event_id = " . $event_id);
    
    if ($update_event) {
        $query = mysqli_fetch_assoc($update_event);
    } else {
        // Handle query error
        echo "Failed to fetch event details: " . mysqli_error($conn);
    }
} else {
    // Handle missing event_id
    echo "Event ID is not specified in the URL.";
}
?>

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">

<body>
    <?php require_once 'include/navbar.php'; ?>
    <?php require_once 'include/sidebar.php'; ?>

    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            <span class="sr-only">Close</span>
        </button>
        <strong><?php if (isset($success_msg) && isset($query['event_name'])) { echo $query['event_name'] . $success_msg; } ?></strong>
    </div>

    <form action="" method="post" autocomplete="off">
        <div class="row">
            <div class="col-md-12 col-sm-4">
                <div class="form-group">
                    <label for="">Event ID</label>
                    <div class="input-group">
                        <input type="hidden" name="event_id" value="<?php echo $query['event_id'] ?? ''; ?>">
                        <input type="number" name="" class="form-control" placeholder="Event ID"
                            value="<?php echo $query['event_id'] ?? ''; ?>" readonly>
                        <small class="input-group-text"><i class="fas fa-calendar-alt"></i></small>
                    </div>
                </div>
            </div>

            <div class="col-md-12 col-sm-4">
                <div class="form-group">
                    <label for="">Event Name</label>
                    <select class="custom-select" name="event_name" id="" value="<?php echo $query['event_name']; ?>">
                    <?php
                    $result = mysqli_query($conn, "SELECT event_id, event_name FROM events");
                    ?>
                    <?php
                    while ($row = mysqli_fetch_assoc($result)) {
                    ?>
                    <option disabled><?php echo $row['event_name']; ?></option>
                    <option value="<?php echo $row['event_name']; ?>" <?php if (isset($query['event_name']) && $query['event_name'] == $row['event_name']) { echo 'selected'; } ?>>
                    <?php echo $row['event_name']; ?>
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
                <button type="submit" class="btn btn-lg btn-primary" name="updateevent">Update Event</button>
            </div>
        </div>
    </form>
</body>
