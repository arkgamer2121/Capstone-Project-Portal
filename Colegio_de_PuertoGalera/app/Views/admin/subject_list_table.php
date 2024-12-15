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
                            <h4 class="card-title float-left mt-2">Subject Details</h4>
                            <a href="/subject_list_add" class="btn btn-primary float-right veiwbutton">Add New Subject</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Display success message if any -->
            <?php if (session()->has('success')): ?>
                <div class="alert alert-success"><?php echo session('success'); ?></div>
            <?php endif; ?>

            <!-- Display error message if any -->
            <?php if (session()->has('error')): ?>
                <div class="alert alert-danger"><?php echo session('error'); ?></div>
            <?php endif; ?>

            <!-- Filters -->
            <div class="row mb-3">
                <div class="col-lg-4">
                    <select class="form-control" id="semesterFilter">
                        <option value="">Select Semester</option>
                        <option value="First Semester">1st Semester</option>
                        <option value="Second Semester">2nd Semester</option>
                    </select>
                </div>
                <br>
                <div class="col-lg-4">
                    <select class="form-control" id="yearFilter">
                        <option value="">Select Year</option>
                        <option value="First Year">First Year</option>
                        <option value="Second Year">Second Year</option>
                        <option value="Third Year">Third Year</option>
                        <option value="Fourth Year">Fourth Year</option>
                    </select>
                </div>
                <div class="col-lg-4">
                    <select class="form-control" id="courseFilter">
                        <option value="">Select Course</option>
                        <option value="Bachelor of Science in Tourism Management">Bachelor of Science in Tourism Management</option>
                        <option value="Bachelor of Science in Office Administration">Bachelor of Science in Office Administration</option>
                        <!-- Add more courses as needed -->
                    </select>
                </div>
                <br>
                <div class="col-lg-4">
                    <br>
                    <button class="btn btn-primary" id="filterButton">Search</button>
                </div>
            </div>

            <div class="row">
    <div class="col-lg-12">
        <div class="card card-table">
            <div class="card-body booking_card">
                <div class="table-responsive">
                    <table class="datatable table table-striped table-hover table-center mb-0" id="subjectTable">
                        <thead>
                            <tr>
                                <th>Code</th>
                                <th>Subject</th>
                                <th>Year</th>
                                <th>Course</th>
                                <th>Semester</th>
                                <th>Unit</th>
                                <th class="text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($subjects as $subject): ?>
                                <tr>
                                    <td><?php echo esc($subject['name']); ?></td>
                                    <td><?php echo esc($subject['description']); ?></td>
                                    <td><?php echo esc($subject['year']); ?></td>
                                    <td><?php echo esc($subject['course']); ?></td>
                                    <td><?php echo esc($subject['semester']); ?></td>
                                    <td><?php echo esc($subject['unit']); ?></td>
                                    <td class="text-right">
                                        <div class="dropdown dropdown-action">
                                            <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                                <i class="fas fa-ellipsis-v ellipse_color"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a class="dropdown-item" href="/subject_list/edit/<?php echo $subject['id']; ?>">
                                                    <i class="fas fa-pencil-alt m-r-5"></i> Edit
                                                </a>
                                                <form action="/subject_list/delete/<?php echo $subject['id']; ?>" method="post" style="display:inline;">
                                                    <button type="submit" class="dropdown-item" onclick="return confirm('Are you sure you want to delete this subject?');">
                                                        <i class="fas fa-trash-alt m-r-5"></i> Delete
                                                    </button>
                                                </form>
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

    <script src="assets1/js/jquery-3.5.1.min.js"></script>
    <script src="assets1/js/popper.min.js"></script>
    <script src="assets1/js/bootstrap.min.js"></script>
    <script src="assets1/js/moment.min.js"></script>
    <script src="assets1/plugins/slimscroll/jquery.slimscroll.min.js"></script>
    <script src="assets1/js/bootstrap-datetimepicker.min.js"></script>
    <script src="assets1/js/script.js"></script>
    <script>
    $(function() {
        // Update course dropdown based on semester and year filter selections
        $('#semesterFilter, #yearFilter').on('change', function() {
            filterSubjects();
        });

        // When the course filter is selected, filter the table
        $('#courseFilter').on('change', function() {
            filterSubjects();
        });

        // Filter the subjects
        function filterSubjects() {
            var semester = $('#semesterFilter').val();
            var year = $('#yearFilter').val();
            var course = $('#courseFilter').val();

            // Loop through each subject row
            $('#subjectTable tbody tr').each(function() {
                var subjectSemester = $(this).data('semester');
                var subjectYear = $(this).data('year');
                var subjectCourse = $(this).data('course');

                // Check if the row matches the filter criteria
                if ((semester === '' || subjectSemester === semester) && 
                    (year === '' || subjectYear === year) && 
                    (course === '' || subjectCourse === course)) {
                    $(this).show();  // Show the row
                } else {
                    $(this).hide();  // Hide the row
                }
            });
        }
    });
</script>


</body>
</html>
