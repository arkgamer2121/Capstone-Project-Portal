<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <title>Add Course and Section</title>
    <link rel="shortcut icon" type="image/x-icon" href="assets/images/icon/colegiologo.png">
    <link rel="stylesheet" href="/assets1/css/bootstrap.min.css">
    <link rel="stylesheet" href="/assets1/plugins/fontawesome/css/fontawesome.min.css">
    <link rel="stylesheet" href="/assets1/plugins/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="/assets1/css/feathericon.min.css">
    <link rel="stylesheet" href="/assets1/css/style.css">
    <style>
        .section-input {
            margin-bottom: 10px;
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
                        <h3 class="page-title mt-5">Add Course and Sections</h3>
                        <a href="/courses-sections" class="btn btn-primary float-right">Back to List</a>
                    </div>
                </div>
            </div>

            <!-- Display success and error messages -->
            <?php if (session()->has('success')): ?>
                <div class="alert alert-success"><?= session('success'); ?></div>
            <?php endif; ?>
            
            <?php if (session()->has('error')): ?>
                <div class="alert alert-danger"><?= session('error'); ?></div>
            <?php endif; ?>

            <form id="addCourseSectionForm" method="post" action="/course_section/store">
                <div class="row formtype">
                    <div class="col-md-4">
                    <div class="form-group">
                        <label for="course">Course:</label>
                        <select name="course" id="course" class="form-control" required>
                            <option value="" disabled selected>Select Course</option>
                            <?php foreach ($courses as $course): ?>
                                <option value="<?= $course['title'] ?>"><?= esc($course['title']) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="year">Year:</label>
                            <select class="form-control" name="year" id="year" required>
                                <option value="" disabled selected>Select Year</option>
                                <option value="First Year">First Year</option>
                                <option value="Second Year">Second Year</option>
                                <option value="Third Year">Third Year</option>
                                <option value="Fourth Year">Fourth Year</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group" id="sectionsContainer">
                            <label for="section">Sections:</label>
                            <input type="text" name="sections[]" class="form-control section-input" placeholder="Enter Section (e.g., A)" required>
                        </div>
                        <button type="button" class="btn btn-secondary" id="addSectionButton">Add Another Section</button>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-primary mt-3">Save</button>
                    </div>
                </div>
            </form>

            <!-- Success Modal -->
            <div class="modal fade" id="statusSuccessModal" tabindex="-1" role="dialog" data-bs-backdrop="static" data-bs-keyboard="false">
                <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
                    <div class="modal-content">
                        <div class="modal-body text-center p-lg-4">
                            <svg version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 130.2 130.2">
                                <circle class="path circle" fill="none" stroke="#198754" stroke-width="6" stroke-miterlimit="10" cx="65.1" cy="65.1" r="62.1" />
                                <polyline class="path check" fill="none" stroke="#198754" stroke-width="6" stroke-linecap="round" stroke-miterlimit="10" points="100.2,40.2 51.5,88.8 29.8,67.5 " />
                            </svg>
                            <h4 class="text-success mt-3">Success!</h4>
                            <p class="mt-3">Course and sections added successfully.</p>
                            <button type="button" class="btn btn-sm mt-3 btn-success" data-bs-dismiss="modal">Ok</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Error Modal -->
            <div class="modal fade" id="statusErrorsModal" tabindex="-1" role="dialog" data-bs-backdrop="static" data-bs-keyboard="false">
                <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
                    <div class="modal-content">
                        <div class="modal-body text-center p-lg-4">
                            <svg version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 130.2 130.2">
                                <circle class="path circle" fill="none" stroke="#db3646" stroke-width="6" stroke-miterlimit="10" cx="65.1" cy="65.1" r="62.1" />
                                <line class="path line" fill="none" stroke="#db3646" stroke-width="6" stroke-linecap="round" stroke-miterlimit="10" x1="34.4" y1="37.9" x2="95.8" y2="92.3" />
                                <line class="path line" fill="none" stroke="#db3646" stroke-width="6" stroke-linecap="round" stroke-miterlimit="10" x1="95.8" y1="38" x2="34.4" y2="92.2" />
                            </svg>
                            <h4 class="text-danger mt-3">Error</h4>
                            <p class="mt-3">Failed to add course and sections.</p>
                            <button type="button" class="btn btn-sm mt-3 btn-danger" data-bs-dismiss="modal">Ok</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Scripts -->
            <script src="/assets1/js/jquery-3.5.1.min.js"></script>
            <script src="/assets1/js/popper.min.js"></script>
            <script src="/assets1/js/bootstrap.min.js"></script>
            <script src="/assets1/js/script.js"></script>
            <script>
                $(document).on('click', '#addSectionButton', function() {
                    $('#sectionsContainer').append('<input type="text" name="sections[]" class="form-control section-input" placeholder="Enter Section (e.g., A)" required>');
                });

                $(document).on('submit', '#addCourseSectionForm', function(e) {
                    e.preventDefault();
                    var formData = new FormData(this);
                    $.ajax({
                        url: $(this).attr('action'),
                        type: 'POST',
                        data: formData,
                        processData: false,
                        contentType: false,
                        success: function(response) {
                            $('#statusSuccessModal').modal('show');
                            setTimeout(function() {
                                $('#statusSuccessModal').modal('hide');
                            }, 2000); // hide modal after 2 seconds
                        },
                        error: function(xhr, status, error) {
                            $('#statusErrorsModal').modal('show');
                        }
                    });
                });
            </script>

        </div>
    </div>
</body>

</html>
