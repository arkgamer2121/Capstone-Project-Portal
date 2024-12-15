<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <title>Admin - Faculty Details</title>
    <link rel="shortcut icon" type="image/x-icon" href="assets/images/icon/colegiologo.png">
    <link rel="stylesheet" href="assets1/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets1/plugins/fontawesome/css/fontawesome.min.css">
    <link rel="stylesheet" href="assets1/plugins/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="assets1/css/feathericon.min.css">
    <link rel="stylesheet" href="assets1/plugins/morris/morris.css">
    <link rel="stylesheet" type="text/css" href="assets1/css/bootstrap-datetimepicker.min.css">
    <link rel="stylesheet" href="assets1/css/style.css">
  
    <style>
        /* Custom styles */
        .page-title {
            margin-bottom: 20px;
        }

        .card {
            margin-bottom: 20px;
        }
    </style>
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
                        <h4 class="card-title float-left mt-2">Faculty Details</h4>
                    </div>
                </div>
            </div>
        </div>
            </div>

        <?php if (!empty($faculty)): ?>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card card-table">
                        <div class="card-body booking_card">
                            <div class="table-responsive">
                                <table class="datatable table table-striped table-hover table-center mb-0">
                                    <thead>
                                        <tr>
                                            <th>ID No</th>
                                            <th>Last Name</th>
                                            <th>First Name</th>
                                            <th>Middle Name</th>
                                            <th>Email</th>
                                            <th>Contact</th>
                                            <th>Gender</th>
                                            <th>Address</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><?= $faculty['id_no']; ?></td>
                                            <td><?= $faculty['last_name']; ?></td>
                                            <td><?= $faculty['first_name']; ?></td>
                                            <td><?= $faculty['middle_name']; ?></td>
                                            <td><?= $faculty['email']; ?></td>
                                            <td><?= $faculty['contact']; ?></td>
                                            <td><?= $faculty['gender']; ?></td>
                                            <td><?= $faculty['address']; ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php else: ?>
            <div class="row">
                <div class="col">
                    <p>Faculty details not found.</p>
                </div>
            </div>
        <?php endif; ?>
    </div>
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
