<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <title>Section and Student List</title>
    <link rel="shortcut icon" type="image/x-icon" href="assets/images/icon/colegiologo.png">
    <link rel="stylesheet" href="assets1/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets1/plugins/fontawesome/css/fontawesome.min.css">
    <link rel="stylesheet" href="assets1/plugins/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="assets1/css/feathericon.min.css">
    <link rel="stylesheet" href="assets1/css/style.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/jquery.dataTables.min.css">
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
                            <h4 class="card-title float-left mt-2">All Sections and Students</h4>
                            <a href="/sectioning" class="btn btn-primary float-right veiwbutton">Add Section</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Filter Form -->
            <div class="row">
                <div class="col-lg-12">
                    <form method="get" action="/listsection" class="form-inline">
                        <div class="form-group mr-3">
                            <label for="course" class="mr-2">Filter by Course:</label>
                            <select name="course" id="course" class="form-control" onchange="this.form.submit()">
                                <option value="">All Courses</option>
                                <?php foreach ($courses as $c): ?>
                                    <option value="<?= esc($c['course']); ?>" <?= esc($c['course']) === $selectedCourse ? 'selected' : ''; ?>>
                                        <?= esc($c['course']); ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="form-group mr-3">
                            <label for="year" class="mr-2">Filter by Year:</label>
                            <select name="year" id="year" class="form-control" onchange="this.form.submit()">
                                <option value="">All Years</option>
                                <?php foreach ($years as $y): ?>
                                    <option value="<?= esc($y['year']); ?>" <?= esc($y['year']) === $selectedYear ? 'selected' : ''; ?>>
                                        <?= esc($y['year']); ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="form-group mr-3">
                            <label for="section" class="mr-2">Filter by Section:</label>
                            <select name="section" id="section" class="form-control" onchange="this.form.submit()">
                                <option value="">All Sections</option>
                                <?php foreach ($sectionNames as $s): ?>
                                    <option value="<?= esc($s['name']); ?>" <?= esc($s['name']) === $selectedSection ? 'selected' : ''; ?>>
                                        <?= esc($s['name']); ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Sections Table -->
            <div class="row mt-4">
                <div class="col-lg-12">
                    <div class="card card-table">
                        <div class="card-body booking_card">
                            <div class="table-responsive">
                                <table id="sectionsTable" class="datatable table table-striped table-hover table-center mb-0">
                                    <thead>
                                        <tr>
                                            <th>Section</th>
                                            <th>Year</th>
                                            <th>Course</th>
                                            <th>Student Name</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if (!empty($sections)): ?>
                                            <?php foreach ($sections as $row): ?>
                                                <tr>
                                                    <td><?= esc($row['section_name']); ?></td>
                                                    <td><?= esc($row['year']); ?></td>
                                                    <td><?= esc($row['course']); ?></td>
                                                    <td><?= esc($row['student_name']); ?></td>
                                                </tr>
                                            <?php endforeach; ?>
                                        <?php else: ?>
                                            <tr>
                                                <td colspan="4" style="text-align: center;">No data available.</td>
                                            </tr>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modals -->
            <div class="modal fade" id="successModal" tabindex="-1" role="dialog" aria-labelledby="successModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="successModalLabel">Success</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            Your action was successful.
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary" data-dismiss="modal">OK</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="errorModal" tabindex="-1" role="dialog" aria-labelledby="errorModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="errorModalLabel">Error</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            There was an error processing your request.
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> -->
    <script src="assets1/js/popper.min.js"></script>
    <script src="assets1/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#sectionsTable').DataTable();
        });
    </script>


	<script src="assets1/js/jquery-3.5.1.min.js"></script>
	<script src="assets1/plugins/datatables/jquery.dataTables.min.js"></script>
	<script src="assets1/plugins/slimscroll/jquery.slimscroll.min.js"></script>
	<script src="assets1/js/script.js"></script>
</body>

</html>
