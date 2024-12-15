<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Subject</title>
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
                      <h1>Edit Subject</h1>
    
        <!-- Form to edit an existing subject -->
        <form action="/subject_listupdate<?php echo $subject['id']; ?>" method="post">
        <label for="name">Subject Name:</label>
        <input type="text" name="name" id="name" value="<?php echo esc($subject['name']); ?>" required><br>

        <label for="description">Description:</label>
        <textarea name="description" id="description" required><?php echo esc($subject['description']); ?></textarea><br>

        <button type="submit">Update Subject</button>
        </form>

        <!-- Back to subject list -->
        <a href="/subject_list">Back to Subject List</a>

        <script src="assets1/js/jquery-3.5.1.min.js"></script>
        <script src="assets1/js/popper.min.js"></script>
        <script src="assets1/js/bootstrap.min.js"></script>
        <script src="assets1/js/moment.min.js"></script>
        <script src="assets1/plugins/slimscroll/jquery.slimscroll.min.js"></script>
        <script src="assets1/js/bootstrap-datetimepicker.min.js"></script>
        <script src="assets1/js/script.js"></script>
</body>
</html>


