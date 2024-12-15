<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Courses and Sections List</title>
    <link rel="shortcut icon" type="image/x-icon" href="assets/images/icon/colegiologo.png">
    <link rel="stylesheet" href="assets1/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets1/plugins/fontawesome/css/fontawesome.min.css">
    <link rel="stylesheet" href="assets1/plugins/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="assets1/css/feathericon.min.css">
    <link rel="stylesheet" href="assets1/plugins/morris/morris.css">
    <link rel="stylesheet" type="text/css" href="assets1/css/bootstrap-datetimepicker.min.css">
    <link rel="stylesheet" href="assets1/css/style.css">
    <style>
        /* Minimalistic design adjustments */
        body {
            background-color: #f4f6f9;
            font-family: Arial, sans-serif;
        }
        .page-header {
            padding: 20px;
            background: #fff;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .page-header h3 {
            font-size: 1.5rem;
            font-weight: 600;
            color: #333;
            margin: 0;
        }
        .btn-success {
            background-color: #4CAF50;
            border: none;
            padding: 8px 16px;
            font-size: 0.9rem;
        }
        .content {
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <?= $this->include('include/topbar.php') ?>
    <?= $this->include('include/sidebar.php') ?>

    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header">
                <h3>Courses Year and Sections List</h3>
                <div>
                    <a href="/course_section/create" class="btn btn-success">Add New Course/Section</a>
                </div>
            </div>

            <?php if (session()->has('success')): ?>
                <div class="alert alert-success"><?= session('success') ?></div>
            <?php endif; ?>
            <?php if (session()->has('error')): ?>
                <div class="alert alert-danger"><?= session('error') ?></div>
            <?php endif; ?>

            <form method="get" action="">
                <div class="row mb-4">
                    <div class="col-md-4">
                        <label for="filterCourse">Course:</label>
                        <select class="form-control" name="filterCourse" id="filterCourse">
                            <option value="">All Courses</option>
                            <option value="Bachelor of Science in Tourism Management" <?= (isset($filterCourse) && $filterCourse == 'Bachelor of Science in Tourism Management') ? 'selected' : '' ?>>Bachelor of Science in Tourism Management</option>
                            <option value="Bachelor of Science in Office Administration" <?= (isset($filterCourse) && $filterCourse == 'Bachelor of Science in Office Administration') ? 'selected' : '' ?>>Bachelor of Science in Office Administration</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label for="filterYear">Year:</label>
                        <select class="form-control" name="filterYear" id="filterYear">
                            <option value="">All Years</option>
                            <option value="First Year" <?= (isset($filterYear) && $filterYear == 'First Year') ? 'selected' : '' ?>>First Year</option>
                            <option value="Second Year" <?= (isset($filterYear) && $filterYear == 'Second Year') ? 'selected' : '' ?>>Second Year</option>
                            <option value="Third Year" <?= (isset($filterYear) && $filterYear == 'Third Year') ? 'selected' : '' ?>>Third Year</option>
                            <option value="Fourth Year" <?= (isset($filterYear) && $filterYear == 'Fourth Year') ? 'selected' : '' ?>>Fourth Year</option>
                        </select>
                    </div>
                    <div class="col-md-4 d-flex align-items-end">
                        <button type="submit" class="btn btn-success">Apply</button>
                    </div>
                </div>
            </form>

            <div class="row">
                <div class="col-lg-12">
                    <div class="card card-table">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-hover table-center mb-0">
                                    <thead>
                                        <tr>
                                            <th>Course</th>
                                            <th>Section</th>
                                            <th>Year</th>
                                            <th class="text-right">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach ($coursesSections as $schedule): ?>
                                    <tr>
                                        <td><?= esc($schedule['course']) ?></td>
                                        <td><?= esc($schedule['section']) ?></td>
                                        <td><?= esc($schedule['year']) ?></td>
                                        <td class="text-right">
                                        <div class="dropdown dropdown-action">
                                            <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                                    <i class="fas fa-ellipsis-v ellipse_color"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <a class="dropdown-item" href="<?= base_url('/teacheredit' . $schedule['id']) ?>">
                                                        <i class="fas fa-pencil-alt m-r-5"></i> Edit
                                                    </a>
                                                    <a class="dropdown-item" href="<?= base_url('/deleteteachers' . $schedule['id']) ?>" onclick="return confirm('Are you sure you want to delete this teacher?');">
                                                        <i class="fas fa-trash-alt m-r-5"></i> Delete
                                                    </a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
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
    <script src="assets1/js/moment.min.js"></script>
    <script src="assets1/plugins/slimscroll/jquery.slimscroll.min.js"></script>
    <script src="assets1/js/bootstrap-datetimepicker.min.js"></script>
    <script src="assets1/js/script.js"></script>
</body>
</html>
