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
    <link href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.min.css" rel="stylesheet">


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
                            <h4 class="card-title float-left mt-2">Course Details</h4>
                            <a href="/courses/create" class="btn btn-primary float-right veiwbutton">Add Course</a>
                            <!-- Add the report generation button here -->
                            <!--<a href="/generate-report" class="btn btn-success float-right mr-2">Generate Report</a>-->
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-lg-12">
                    <div class="card card-table">
                        <div class="card-body booking_card">
                            <div class="table-responsive">
                                <table id="teacherTable" class="datatable table table-striped table-hover table-center mb-0">
                        <thead>
                            <tr>
                                <th>Image</th>
                                <th>Title</th>
                                <th>Description</th>
                                <th>Course</th>
                                <th>Course Unit</th>
                                <th>Subject</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($courses as $course): ?>
                                <tr>
                                    <td><img src="/uploads/<?= $course['image'] ?>" width="100"></td>
                                    <td><?= $course['title'] ?></td>
                                    <td><?= $course['description'] ?></td>
                                    <td><?= $course['course'] ?></td>
                                    <td><?= $course['course_unit'] ?></td>
                                    <td><?= $course['subject'] ?></td>
                                    <td>
                                    <div class="dropdown dropdown-action">
    <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
        <i class="fas fa-ellipsis-v ellipse_color"></i>
    </a>
    <div class="dropdown-menu dropdown-menu-right">
        <a class="dropdown-item" href="<?= base_url('/courses/edit/' . $course['id']) ?>">
            <i class="fas fa-pencil-alt m-r-5"></i> Edit
        </a>
        <a class="dropdown-item" href="<?= base_url('/courses/delete/' . $course['id']) ?>" onclick="return confirm('Are you sure you want to delete this course?');">
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

  
    <script data-cfasync="false" src="../../../cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script>
	<script src="assets1/js/jquery-3.5.1.min.js"></script>
	<script src="assets1/js/popper.min.js"></script>
	<script src="assets1/js/bootstrap.min.js"></script>
	<script src="assets1/plugins/datatables/jquery.dataTables.min.js"></script>
	<script src="assets1/plugins/datatables/datatables.min.js"></script>
	<script src="assets1/plugins/slimscroll/jquery.slimscroll.min.js"></script>
	<script src="assets1/js/script.js"></script>

        <script>
            $(function() {
                $('#datetimepicker3').datetimepicker({
                    format: 'LT'
                });
            });
        </script>
</body>

</html>
