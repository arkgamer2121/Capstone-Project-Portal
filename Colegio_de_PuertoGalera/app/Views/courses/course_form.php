<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <title>Course Form</title>
    <link rel="shortcut icon" type="image/x-icon" href="assets/images/icon/colegiologo.png">
    <link rel="stylesheet" href="/assets1/css/bootstrap.min.css">
    <link rel="stylesheet" href="/assets1/plugins/fontawesome/css/fontawesome.min.css">
    <link rel="stylesheet" href="/assets1/plugins/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="/assets1/css/style.css">
    <style>
        .form-control {
            width: 100%;
            margin-top: 5px;
        }

        .form-group {
            margin-bottom: 1.5rem; /* Space between form groups */
        }

        .formtype {
            display: flex;
            flex-wrap: wrap; /* Allows the form fields to wrap in smaller screens */
        }

        .col-md-6, .col-md-4 {
            padding: 0 15px; /* Adds padding to the columns */
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
                        <h3 class="page-title mt-5"><?= isset($course) ? 'Edit Course' : 'Add Course' ?></h3>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <form id="courseForm" action="<?= isset($course) ? '/courses/update/' . $course['id'] : '/courses/store' ?>" method="post" enctype="multipart/form-data">
                        <div class="row formtype">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Image</label>
                                    <input class="form-control" type="file" name="image">
                                    <?php if (isset($course) && $course['image']): ?>
                                        <img src="/uploads/<?= $course['image'] ?>" width="100" class="mt-2">
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Title</label>
                                    <textarea class="form-control" rows="3" name="title"><?= isset($course) ? $course['title'] : '' ?></textarea>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Description</label>
                                    <textarea class="form-control" rows="3" name="description"><?= isset($course) ? $course['description'] : '' ?></textarea>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Course</label>
                                    <input class="form-control" type="text" name="course" value="<?= isset($course) ? $course['course'] : '' ?>" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Course Unit</label>
                                    <input class="form-control" type="text" name="course_unit" value="<?= isset($course) ? $course['course_unit'] : '' ?>" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Subject</label>
                                    <input class="form-control" type="text" name="subject" value="<?= isset($course) ? $course['subject'] : '' ?>" required>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

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
                    <p class="mt-3">Course saved successfully.</p>
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
                    <p class="mt-3">Failed to save course.</p>
                    <button type="button" class="btn btn-sm mt-3 btn-danger" data-bs-dismiss="modal">Ok</button>
                </div>
            </div>
        </div>
    </div>

    <script src="/assets1/js/jquery-3.5.1.min.js"></script>
    <script src="/assets1/js/popper.min.js"></script>
    <script src="/assets1/js/bootstrap.min.js"></script>
    <script src="/assets1/plugins/slimscroll/jquery.slimscroll.min.js"></script>
    <script src="/assets1/js/script.js"></script>
    <script>
        // AJAX Form Submission for Course Form
        $(document).on('submit', '#courseForm', function(e) {
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
</body>

</html>
