<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <title>Edit Faculty</title>
    <link rel="shortcut icon" type="image/x-icon" href="assets/images/icon/colegiologo.png">
    <link rel="stylesheet" href="/assets1/css/bootstrap.min.css">
    <link rel="stylesheet" href="/assets1/plugins/fontawesome/css/fontawesome.min.css">
    <link rel="stylesheet" href="/assets1/plugins/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="/assets1/css/feathericon.min.css">
    <link rel="stylesheet" href="/assets1/css/style.css">
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
                        <h2>Edit Faculty</h2>
                        <form action="<?= base_url('/faculty/update/' . $faculty['id']); ?>" method="post" id="editFacultyForm">
                            <div class="form-group">
                                <label for="id_no">ID No:</label>
                                <input type="text" class="form-control" name="id_no" value="<?= $faculty['id_no']; ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="last_name">Last Name:</label>
                                <input type="text" class="form-control" name="last_name" value="<?= $faculty['last_name']; ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="first_name">First Name:</label>
                                <input type="text" class="form-control" name="first_name" value="<?= $faculty['first_name']; ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="middle_name">Middle Name:</label>
                                <input type="text" class="form-control" name="middle_name" value="<?= $faculty['middle_name']; ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="email">Email:</label>
                                <input type="email" class="form-control" name="email" value="<?= $faculty['email']; ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="contact">Contact:</label>
                                <input type="text" class="form-control" name="contact" value="<?= $faculty['contact']; ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="gender">Gender:</label>
                                <input type="text" class="form-control" name="gender" value="<?= $faculty['gender']; ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="address">Address:</label>
                                <input type="text" class="form-control" name="address" value="<?= $faculty['address']; ?>" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Success Modal -->
    <div class="modal fade" id="successModal" tabindex="-1" role="dialog" aria-labelledby="successModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="successModalLabel">Update Successful</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    The faculty details have been updated successfully!
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <a href="/faculty" class="btn btn-primary">Back to Faculty List</a>
                </div>
            </div>
        </div>
    </div>

    <script src="/js/jquery-3.5.1.min.js"></script>
    <script src="/assets1/js/popper.min.js"></script>
    <script src="/assets1/js/bootstrap.min.js"></script>
    <script>
        // Show modal on form submission
        $('#editFacultyForm').on('submit', function(event) {
            event.preventDefault(); // Prevent default form submission
            // Perform AJAX request or simple form submission here

            // Assuming the update is successful, show the modal
            $('#successModal').modal('show');
        });
    </script>
</body>

</html>
