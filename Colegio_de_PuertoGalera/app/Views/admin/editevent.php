<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <title>Edit Event</title>
    <link rel="shortcut icon" type="image/x-icon" href="assets/images/icon/colegiologo.png">
    <link rel="stylesheet" href="assets1/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets1/plugins/fontawesome/css/fontawesome.min.css">
    <link rel="stylesheet" href="assets1/plugins/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="assets1/css/feathericon.min.css">
    <link rel="stylesheet" href="assets1/plugins/morris/morris.css">
    <link rel="stylesheet" type="text/css" href="assets1/css/bootstrap-datetimepicker.min.css">
    <link rel="stylesheet" href="assets1/css/style.css">
</head>

<body>

	<!-- topbar -->
    <?= $this->include('include/topbar.php') ?>


    <!-- sidebar -->
    <?= $this->include('include/sidebar.php') ?>

    <div class="page-wrapper">
    <div class="content container-fluid">
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <div class="mt-5">
        <h2>Edit News</h2>
        <form action="<?= base_url('/eventupdate' . $event['id']) ?>" method="post">
            <div class="form-group">
                <label for="event_name">Event Name</label>
                <input type="text" class="form-control" id="event_name" name="event_name" value="<?= $event['event_name'] ?>" required>
            </div>
            <div class="form-group">
                <label for="event_date">Event Date</label>
                <input type="date" class="form-control" id="event_date" name="event_date" value="<?= $event['event_date'] ?>" required>
            </div>
            <div class="form-group">
                <label for="event_start_time">Start Time</label>
                <input type="time" class="form-control" id="event_start_time" name="event_start_time" value="<?= $event['event_start_time'] ?>" required>
            </div>
            <div class="form-group">
                <label for="event_end_time">End Time</label>
                <input type="time" class="form-control" id="event_end_time" name="event_end_time" value="<?= $event['event_end_time'] ?>" required>
            </div>
            <div class="form-group">
                <label for="event_description">Description</label>
                <textarea class="form-control" id="event_description" name="event_description" required><?= $event['event_description'] ?></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
    <script src="assets1/js/jquery-3.5.1.min.js"></script>
	<script src="assets1/js/popper.min.js"></script>
	<script src="assets1/js/bootstrap.min.js"></script>
	<script src="assets1/js/moment.min.js"></script>
	<script src="assets1/plugins/slimscroll/jquery.slimscroll.min.js"></script>
	<script src="assets1/js/bootstrap-datetimepicker.min.js"></script>
	<script src="assets1/js/script.js"></script>
</body>

</html>
