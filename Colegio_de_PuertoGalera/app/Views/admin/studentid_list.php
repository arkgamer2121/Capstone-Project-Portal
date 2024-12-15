<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <title>Admin</title>
    <link rel="shortcut icon" type="image/x-icon" href="assets/images/icon/colegiologo.png">
    <link rel="stylesheet" href="assets1/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets1/plugins/fontawesome/css/fontawesome.min.css">
    <link rel="stylesheet" href="assets1/plugins/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="assets1/css/feathericon.min.css">
    <link rel="stylesheet" href="assets1/plugins/morris/morris.css">
    <link rel="stylesheet" type="text/css" href="assets1/css/bootstrap-datetimepicker.min.css">
    <link rel="stylesheet" href="assets1/css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
</head>

<body>
    <!-- topbar -->
    <?= $this->include('include/topbar.php') ?>

    <!-- sidebar -->
    <?= $this->include('include/sidebar.php') ?>

    <!-- Page Wrapper -->
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <div class="mt-5">
                            <h1 class="card-title float-left mt-2">Student ID List</h1>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Display Session Messages -->
            <?php if (session()->has('success')): ?>
                <div class="alert alert-success"><?= session('success') ?></div>
            <?php endif; ?>
            <?php if (session()->has('error')): ?>
                <div class="alert alert-danger"><?= session('error') ?></div>
            <?php endif; ?>

            <!-- Form to upload Excel -->
            <div class="mt-4">
                <form action="<?= base_url('uploadExcel') ?>" method="post" enctype="multipart/form-data">
                    <?= csrf_field() ?>
                    <h3>Upload Excel File</h3>
                    <div class="form-group">
                        <label for="file">Choose Excel File:</label>
                        <input type="file" name="excel_file" id="file" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Upload</button>
                </form>
            </div>

            <!-- Student ID List Table -->
            <div class="row mt-4">
                <div class="col-lg-12">
                    <div class="card card-table">
                        <div class="card-body booking_card">
                            <div class="table-responsive">
                                <table class="datatable table table-striped table-hover table-center mb-0">
                                    <thead>
                                        <tr>
                                            <th>Student Name</th>
                                            <th>Student ID</th>
                                            <th class="text-right">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($students as $student) : ?>
                                            <?php if (!empty($student['student_id'])) : ?>
                                                <tr>
                                                    <td><?= htmlspecialchars($student['name']) ?></td>
                                                    <td><?= htmlspecialchars($student['student_id']) ?></td>
                                                    <td class="text-right">
                                                        <div class="dropdown dropdown-action">
                                                            <a href="" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                                                <i class="fas fa-ellipsis-v ellipse_color"></i>
                                                            </a>
                                                            <div class="dropdown-menu dropdown-menu-right">
                                                                <a class="dropdown-item" href="<?= base_url('/studentedit/' . $student['student_id']) ?>">
                                                                    <i class="fas fa-pencil-alt m-r-5"></i> Edit
                                                                </a>
                                                                <a class="dropdown-item" href="<?= base_url('/studentdelete/' . $student['student_id']) ?>" onclick="return confirm('Are you sure you want to delete this student?');">
                                                                    <i class="fas fa-trash-alt m-r-5"></i> Delete
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </div>

    <script src="assets1/js/jquery-3.5.1.min.js"></script>
    <script src="assets1/js/popper.min.js"></script>
    <script src="assets1/js/bootstrap.min.js"></script>
    <script src="assets1/plugins/slimscroll/jquery.slimscroll.min.js"></script>
    <script src="assets1/js/script.js"></script>
</body>

</html>
