<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <title>Admin - Faculty Details</title>
    <link rel="stylesheet" href="assets1/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets1/plugins/fontawesome/css/fontawesome.min.css">
    <link rel="stylesheet" href="assets1/plugins/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="assets1/css/style.css">
    <style>
        .table-striped th, .table-striped td {
            border-right: 1px solid #ccc;
        }
        .table-striped th:last-child, .table-striped td:last-child {
            border-right: none;
        }
        h2 {
            font-family: 'Pacifico', cursive;
        }
        .custom-modal-dialog {
            max-width: 500px;
        }
        .modal-header, .modal-footer {
            border: none;
        }
        .modal-title {
            font-weight: 500;
        }
        .btn {
            border-radius: 20px;
        }
        .form-control {
            border-radius: 10px;
        }
        .modal-content {
            background-color: #f5f5f5;
        }
        .btn-primary {
            background-color: #4a90e2;
            border: none;
        }
        .btn-secondary {
            background-color: #aaa;
            border: none;
        }
        body {
            font-family: 'Georgia', serif;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 8px;
            text-align: left;
            border: 1px solid #ddd;
        }
        th {
            background-color: #f2f2f2;
            font-weight: bold;
        }
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
                            <h2 class="card-title float-left mt-2">Faculty Details</h2>
                        </div>
                        <div class="col text-right">
                            <button class="btn btn-success float-right mr-2" data-toggle="modal" data-target="#confirmModal">Generate Report</button>
                        </div>
                    </div>
                </div>
            </div>
            <br>

            <?php if (!empty($faculty)): ?>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card card-table">
                            <div class="card-body booking_card">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="box">
                                            <h4 class="box-title">Personal Information</h4>
                                            <div class="box-content">
                                                <p><strong>ID No:</strong> <?= $faculty['id_no']; ?></p>
                                                <p><strong>Last Name:</strong> <?= $faculty['last_name']; ?></p>
                                                <p><strong>First Name:</strong> <?= $faculty['first_name']; ?></p>
                                                <p><strong>Middle Name:</strong> <?= $faculty['middle_name']; ?></p>
                                                <p><strong>Email:</strong> <?= $faculty['email']; ?></p>
                                                <p><strong>Contact:</strong> <?= $faculty['contact']; ?></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="box">
                                            <h4 class="box-title">Contact Information</h4>
                                            <div class="box-content">
                                                <p><strong>Gender:</strong> <?= $faculty['gender']; ?></p>
                                                <p><strong>Address:</strong> <?= $faculty['address']; ?></p>
                                            </div>
                                        </div>
                                    </div>
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

            <div class="row">
                <div class="col-lg-12">
                    <div class="card-body booking_card">
                        <div class="table-responsive">
                            <table id="scheduleTable" class="datatable table table-striped table-hover table-center mb-0">
                                <thead>
                                <tr>
                                <th>Day</th>
                                <th>Teacher(s)</th>
                                <th>Subject Code</th>
                                <th>Subject</th>
                                <th>Year</th>
                                <th>Course</th>
                                <th>Section</th>
                                <th>Time</th>
                                <th>Room</th>
                                <th>Semester</th>
                                <th>Description</th>
                                </tr>
                            </thead>
                            <tbody id="scheduleBody">
                            <?php foreach ($schedules as $schedule): ?>
                                <?php $days = explode(",", $schedule['days_of_week']); ?>
                                <?php foreach ($days as $day): ?>
                                    <tr class="schedule-row" 
                                        data-id="<?= esc($schedule['id']) ?>" 
                                        data-schedule-type="<?= esc($schedule['course']) ?>" 
                                        data-day="<?= esc(trim($day)) ?>">
                                        
                                        <td class="text-muted"><?= esc(trim($day)) ?></td>
                                        <td>
                                            <?php if (!empty($schedule['faculty_name'])): ?>
                                                <?= esc($schedule['faculty_name']) ?>
                                            <?php else: ?>
                                                <span class="text-muted">No Faculty Assigned</span>
                                            <?php endif; ?>
                                        </td>
                                        <td><?= esc($schedule['subject_code']) ?></td>
                                        <td><?= esc($schedule['subject']) ?></td>
                                        <td><?= esc($schedule['year']) ?></td>
                                        <td><?= esc($schedule['course']) ?></td>
                                        <td><?= esc($schedule['section']) ?></td>
                                        <td><?= esc($schedule['time_from']) ?> - <?= esc($schedule['time_to']) ?></td>
                                        <td><?= esc($schedule['room']) ?></td>
                                        <td><?= esc($schedule['sem']) ?></td>
                                        <td><?= esc($schedule['description']) ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

<!-- Confirmation Modal -->
<div class="modal fade" id="confirmModal" aria-hidden="true" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Confirm Report Generation</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h4>Faculty Details</h4>
                <div class="row form-row">
                    <div class="col-6">
                        <p><strong>ID No:</strong> <?= esc($faculty['id_no']); ?></p>
                    </div>
                    <div class="col-6">
                        <p><strong>Last Name:</strong> <?= esc($faculty['last_name']); ?></p>
                    </div>
                    <div class="col-6">
                        <p><strong>First Name:</strong> <?= esc($faculty['first_name']); ?></p>
                    </div>
                    <div class="col-6">
                        <p><strong>Middle Name:</strong> <?= esc($faculty['middle_name']); ?></p>
                    </div>
                    <div class="col-6">
                        <p><strong>Email:</strong> <?= esc($faculty['email']); ?></p>
                    </div>
                    <div class="col-6">
                        <p><strong>Contact:</strong> <?= esc($faculty['contact']); ?></p>
                    </div>
                    <div class="col-6">
                        <p><strong>Gender:</strong> <?= esc($faculty['gender']); ?></p>
                    </div>
                    <div class="col-6">
                        <p><strong>Address:</strong> <?= esc($faculty['address']); ?></p>
                    </div>
                </div>

                <h4>Schedule Details</h4>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Day</th>
                                <th>Teacher(s)</th>
                                <th>Subject Code</th>
                                <th>Subject</th>
                                <th>Year</th>
                                <th>Course</th>
                                <th>Section</th>
                                <th>Time</th>
                                <th>Room</th>
                                <th>Semester</th>
                                <th>Description</th>
                            </tr>
                        </thead>
                        <tbody id="scheduleBody">
                            <?php foreach ($schedules as $schedule): ?>
                                <?php $days = explode(",", $schedule['days_of_week']); ?>
                                <?php foreach ($days as $day): ?>
                                    <tr class="schedule-row" 
                                        data-id="<?= esc($schedule['id']) ?>" 
                                        data-schedule-type="<?= esc($schedule['course']) ?>" 
                                        data-day="<?= esc(trim($day)) ?>">
                                        <td class="text-muted"><?= esc(trim($day)) ?></td>
                                        <td>
                                            <?php if (!empty($schedule['faculty_name'])): ?>
                                                <?= esc($schedule['faculty_name']) ?>
                                            <?php else: ?>
                                                <span class="text-muted">No Faculty Assigned</span>
                                            <?php endif; ?>
                                        </td>
                                        <td><?= esc($schedule['subject_code']) ?></td>
                                        <td><?= esc($schedule['subject']) ?></td>
                                        <td><?= esc($schedule['year']) ?></td>
                                        <td><?= esc($schedule['course']) ?></td>
                                        <td><?= esc($schedule['section']) ?></td>
                                        <td><?= esc($schedule['time_from']) ?> - <?= esc($schedule['time_to']) ?></td>
                                        <td><?= esc($schedule['room']) ?></td>
                                        <td><?= esc($schedule['sem']) ?></td>
                                        <td><?= esc($schedule['description']) ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>

                <h4>Preview PDF Report</h4>
                <button id="previewPdfBtn" class="btn btn-info mb-3">Preview Report</button>
                <div id="pdfPreviewContainer" class="d-none">
                    <iframe id="pdfPreview" src="" width="100%" height="500px" style="border: none;"></iframe>
                </div>
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <a href="#" id="confirmGenerate" class="btn btn-primary">Confirm</a>
            </div>
        </div>
    </div>
</div>

        
    <script src="assets1/js/jquery-3.5.1.min.js"></script>
    <script src="assets1/js/popper.min.js"></script>
    <script src="assets1/js/bootstrap.min.js"></script>
    <script src="assets1/js/script.js"></script>
    <script>
        $(document).ready(function() {
            $('#confirmGenerate').on('click', function() {
                window.location.href = '/generate-report-sched<?= $faculty['id']; ?>';
            });
        });
    </script>
    <script>
    document.getElementById('previewPdfBtn').addEventListener('click', function () {
        const pdfPreviewContainer = document.getElementById('pdfPreviewContainer');
        const pdfPreview = document.getElementById('pdfPreview');
        // Replace 'generatePdfUrl' with the actual route to fetch the PDF
        const generatePdfUrl = '<?= base_url("/generate-pdf-preview/" . $faculty['id']); ?>'; 

        pdfPreview.src = generatePdfUrl;
        pdfPreviewContainer.classList.remove('d-none');
    });
</script>
</body>
</html>
