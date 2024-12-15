<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <title>Auto Sectioning</title>
    <link rel="shortcut icon" type="image/x-icon" href="assets/images/icon/colegiologo.png">
    <link rel="stylesheet" href="assets1/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets1/plugins/fontawesome/css/fontawesome.min.css">
    <link rel="stylesheet" href="assets1/plugins/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="assets1/css/feathericon.min.css">
    <link rel="stylesheet" href="assets1/plugins/morris/morris.css">
    <link rel="stylesheet" type="text/css" href="assets1/css/bootstrap-datetimepicker.min.css">
    <link rel="stylesheet" href="assets1/css/style.css">
    <style>
        .modal#statusSuccessModal .modal-content,
        .modal#statusErrorsModal .modal-content {
            border-radius: 30px;
        }

        .modal#statusSuccessModal .modal-content svg,
        .modal#statusErrorsModal .modal-content svg {
            width: 100px;
            display: block;
            margin: 0 auto;
        }

        .modal#statusSuccessModal .modal-content .path,
        .modal#statusErrorsModal .modal-content .path {
            stroke-dasharray: 1000;
            stroke-dashoffset: 0;
        }

        .modal#statusSuccessModal .modal-content .path.circle,
        .modal#statusErrorsModal .modal-content .path.circle {
            -webkit-animation: dash 0.9s ease-in-out;
            animation: dash 0.9s ease-in-out;
        }

        @-webkit-keyframes dash {
            0% {
                stroke-dashoffset: 1000;
            }

            100% {
                stroke-dashoffset: 0;
            }
        }

        @keyframes dash {
            0% {
                stroke-dashoffset: 1000;
            }

            100% {
                stroke-dashoffset: 0;
            }
        }
    </style>
</head>

<body>
    <?= $this->include('include/topbar.php') ?>
    <?= $this->include('include/sidebar.php') ?>
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title mt-5">Auto Sectioning</h3>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <form id="autoSectioningForm" method="post" action="/section/upload" enctype="multipart/form-data">
                        <div class="row formtype">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="file">Excel File</label>
                                    <input type="file" name="file" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="num_sections">Number of Sections</label>
                                    <input type="number" id="num_sections" name="num_sections" class="form-control" min="1" required onchange="generateSectionFields()">
                                </div>
                            </div>
                            <div class="col-md-12" id="section_names_container">
                                <!-- Section name fields will be dynamically added here -->
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="year">Year</label>
                                    <input type="number" name="year" class="form-control" min="1" max="5" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="course">Course</label>
                                    <input type="text" name="course" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary">Upload and Create Sections</button>
                            </div>
                        </div>
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
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 130.2 130.2">
                        <circle class="path circle" fill="none" stroke="#198754" stroke-width="6" cx="65.1" cy="65.1" r="62.1" />
                        <polyline class="path check" fill="none" stroke="#198754" stroke-width="6" points="100.2,40.2 51.5,88.8 29.8,67.5" />
                    </svg>
                    <h4 class="text-success mt-3">Success!</h4>
                    <p class="mt-3">Sections created successfully.</p>
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
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 130.2 130.2">
                        <circle class="path circle" fill="none" stroke="#db3646" stroke-width="6" cx="65.1" cy="65.1" r="62.1" />
                        <line class="path line" fill="none" stroke="#db3646" stroke-width="6" x1="34.4" y1="37.9" x2="95.8" y2="92.3" />
                        <line class="path line" fill="none" stroke="#db3646" stroke-width="6" x1="95.8" y1="38" x2="34.4" y2="92.2" />
                    </svg>
                    <h4 class="text-danger mt-3">Error</h4>
                    <p class="mt-3">Failed to create sections.</p>
                    <button type="button" class="btn btn-sm mt-3 btn-danger" data-bs-dismiss="modal">Ok</button>
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
        function generateSectionFields() {
            const container = document.getElementById('section_names_container');
            container.innerHTML = '';
            const numSections = document.getElementById('num_sections').value;
            for (let i = 0; i < numSections; i++) {
                const field = document.createElement('div');
                field.classList.add('form-group');
                field.innerHTML = `
                    <label for="section_name_${i}">Section Name ${i + 1}:</label>
                    <input type="text" id="section_name_${i}" name="section_names[]" class="form-control" required>
                `;
                container.appendChild(field);
            }
        }

        // AJAX Submission
        $(document).on('submit', '#autoSectioningForm', function (e) {
            e.preventDefault();
            var formData = new FormData(this);
            $.ajax({
                url: $(this).attr('action'),
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function () {
                    $('#statusSuccessModal').modal('show');
                    setTimeout(function () {
                        $('#statusSuccessModal').modal('hide');
                        location.reload();
                    }, 2000);
                },
                error: function () {
                    $('#statusErrorsModal').modal('show');
                }
            });
        });
    </script>
</body>

</html>
