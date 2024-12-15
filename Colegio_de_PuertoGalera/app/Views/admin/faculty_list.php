<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <title>Admin - Faculty List</title>
    <link rel="shortcut icon" type="image/x-icon" href="assets/images/icon/colegiologo.png">
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
                            <h4 class="card-title float-left mt-2">FACULTY LIST</h4>
                            <a href="/facultycreate" class="btn btn-primary float-right veiwbutton">Add Faculty</a>
                            <!-- Add the report generation button here -->
                            <!-- <a href="/generate-report" class="btn btn-success float-right mr-2">Generate Report</a> -->
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
                                            <th class="text-right">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($faculty as $member): ?>
                                            <tr data-id="<?= $member['id']; ?>">
                                                <td><?= esc($member['id_no']); ?></td>
                                                <td><?= esc($member['last_name']); ?></td>
                                                <td><?= esc($member['first_name']); ?></td>
                                                <td><?= esc($member['middle_name']); ?></td>
                                                <td><?= esc($member['email']); ?></td>
                                                <td><?= esc($member['contact']); ?></td>
                                                <td><?= esc($member['gender']); ?></td>
                                                <td><?= esc($member['address']); ?></td>
                                                <td class="text-right row-actions">
                                                    <div class="dropdown dropdown-action">
                                                        <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                                            <i class="fas fa-ellipsis-v ellipse_color"></i>
                                                        </a>
                                                        <div class="dropdown-menu dropdown-menu-right">
                                                            <a class="dropdown-item" href="/faculty/edit/<?= $member['id']; ?>">
                                                                <i class="fas fa-pencil-alt m-r-5"></i> Edit
                                                            </a>
                                                            <form action="/faculty/delete/<?= $member['id']; ?>" method="post" style="display:inline;">
                                                                <button type="submit" class="dropdown-item" onclick="return confirm('Are you sure you want to delete this record?');">
                                                                    <i class="fas fa-trash-alt m-r-5"></i> Delete
                                                                </button>
                                                            </form>
                                                            <button type="button" class="dropdown-item send-schedule-btn" data-member-id="<?= $member['id']; ?>" data-email="<?= $member['email']; ?>">
                                                                <i class="fas fa-paper-plane m-r-5"></i> Send Schedule
                                                            </button>
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

    <!-- Modal for sending schedule -->
    <div class="modal fade" id="sendScheduleModal" tabindex="-1" role="dialog" aria-labelledby="sendScheduleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-side modal-dialog-bottom-right" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="sendScheduleModalLabel">Send Schedule</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="sendScheduleForm" action="/faculty/send/<?= $member['id']; ?>" method="post" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="message">Message:</label>
                            <textarea class="form-control" id="message" name="message" rows="3" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="form-group">
                            <label for="attachment">Attachment:</label>
                            <input type="file" class="form-control-file" id="attachment" name="attachment" accept=".pdf">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary" id="confirmSendSchedule">Send Schedule</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="assets1/js/jquery-3.5.1.min.js"></script>
    <script src="assets1/js/popper.min.js"></script>
    <script src="assets1/js/bootstrap.min.js"></script>
    <script src="assets1/plugins/slimscroll/jquery.slimscroll.min.js"></script>
    <script src="assets1/js/script.js"></script>
    <script>
        $(function() {
            $('#datetimepicker3').datetimepicker({
                format: 'LT'
            });
        });

        $(document).ready(function() {
    // Add click event listener to table rows
    $('.datatable tbody tr').on('click', function(event) {
        if (!$(event.target).closest('.row-actions').length) {
            // Get the ID of the clicked faculty member only if the click is not within the row action column
            var facultyId = $(this).data('id');
            redirectToDetails(facultyId);
        }
    });
});

            // Populate email in the send schedule modal
            $('.send-schedule-btn').on('click', function() {
                var memberId = $(this).data('member-id');
                var email = $(this).data('email');
                $('#sendScheduleForm').attr('action', '/send-schedule/' + memberId);
                $('#sendScheduleModal #email').val(email);
                $('#sendScheduleModal').modal('show');
            });

            $('#confirmSendSchedule').on('click', function() {
                $('#sendScheduleForm').submit();
            });
        


        function redirectToDetails(id) {
            window.location.href = '/details' + id;
        }
    </script>
</body>
</html>

</body>
</html>