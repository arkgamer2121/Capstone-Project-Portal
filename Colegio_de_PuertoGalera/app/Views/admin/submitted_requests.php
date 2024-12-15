<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <title>Submitted Requests</title>
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
    <!-- Topbar -->
    <?= $this->include('include/topbar.php') ?>

    <!-- Sidebar -->
    <?= $this->include('include/sidebar.php') ?>

    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <br>
                        <h4 class="card-title float-left mt-2">Submitted Requests</h4>
                    </div>
                </div>
            </div>
            <div class="row mb-3">
            <div class="col-lg-5">
            <select id="filterDropdown" class="form-control">
                <option value="">-- Select Request Type --</option>
                <option value="COR">COR</option>
                <option value="COG">COG</option>
                <option value="COE">COE</option>
                <option value="STUDENT ID">STUDENT ID</option>
            </select>
        </div>
            <div class="col-lg-5">
                <!-- Search bar input -->
                <div class="input-group mb-3">
                    <input type="text" id="searchInput" class="form-control" placeholder="Search">
                    <div class="input-group-append">
                        <span class="input-group-text"><i class="fas fa-search"></i></span>
                    </div>
                </div>
            </div>
            <div class="col-lg-2">
                <select id="statusFilter" class="form-control">
                    <option value="">-- Select Status --</option>
                    <option value="Pending">Pending</option>
                    <option value="Approved">Approved</option>
                    <option value="Rejected">Rejected</option>
                </select>
            </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card card-table">
                        <div class="card-body booking_card">
                            <div class="table-responsive">
                                <table class="datatable table table-striped table-hover mb-0">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Request Type</th>
                                        <th>Name</th>
                                        <th>Course</th>
                                        <th>Year</th>
                                        <th>Status</th>
                                        <th>Purpose of Request</th>
                                        <th>Specific Documents</th>
                                        <th>Section</th>
                                        <th>Contact Number</th>
                                        <th>Schedule Date</th>
                                        <th>Schedule Time</th>
                                        <th>Reject Reason</th>
                                        <th class="text-right">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
    <?php foreach ($requests as $request) : ?>
        <tr>
        <td><?= esc($request['id']) ?></td>
        <td><?= esc($request['request_type']) ?></td>
        <td><?= esc($request['name']) ?></td>
        <td><?= esc($request['course']) ?></td>
        <td><?= esc($request['year']) ?></td>
        <td><?= esc($request['status']) ?></td>
        <td><?= esc($request['purpose_of_request']) ?></td>
        <td><?= esc($request['specific_documents']) ?></td>
        <td><?= esc($request['section']) ?></td>
        <td><?= esc($request['contact_number']) ?></td>
        <td><?= esc($request['schedule_date']) ?></td>
        <td><?= esc($request['schedule_time']) ?></td>
        <td><?= esc($request['reject_reason']) ?></td>

            <td class="text-right">
    <div class="dropdown dropdown-action">
        <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
            <i class="fas fa-ellipsis-v ellipse_color"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-right">
            <a class="dropdown-item approve-btn" href="#" data-id="<?= esc($request['id']) ?>">
                <i class="fas fa-check m-r-5"></i> Approve
            </a>
            <a class="dropdown-item reject-btn" href="#" data-id="<?= esc($request['id']) ?>">
                <i class="fas fa-times m-r-5"></i> Reject
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



   <!-- Approve Confirmation Modal -->
<div class="modal fade" id="confirmApprovalModal" tabindex="-1" role="dialog" aria-labelledby="confirmApprovalModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-success text-white">
                <h5 class="modal-title" id="confirmApprovalModalLabel">Approve Request</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="approvalForm">
                    <p>Are you sure you want to approve this request?</p>
                    <div class="form-group">
                        <label for="scheduleDate">Schedule Date:</label>
                        <input type="date" id="scheduleDate" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="scheduleTime">Schedule Time:</label>
                        <input type="time" id="scheduleTime" class="form-control" required>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" id="confirmApproveBtn" class="btn btn-success">Confirm</button>
            </div>
        </div>
    </div>
</div>

<!-- Reject Modal with Comment -->
<!-- Reject Confirmation Modal -->
<!-- Reject Modal with Comment -->
<div class="modal fade" id="rejectModal" tabindex="-1" role="dialog" aria-labelledby="rejectModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title" id="rejectModalLabel">Reject Request</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to reject this request?</p>
                <div class="form-group">
                    <label for="rejectReason">Reason for rejection:</label>
                    <textarea id="rejectReason" class="form-control" rows="3" placeholder="Enter reason..."></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-danger" id="confirmRejectBtn" data-id="<?= esc($request['id']) ?>">Reject</button>
            </div>
        </div>
    </div>
</div>



    <!-- Optional: Bootstrap JS and dependencies -->
    <script src="assets1/js/jquery-3.5.1.min.js"></script>
    <script src="assets1/js/popper.min.js"></script>
    <script src="assets1/js/bootstrap.min.js"></script>
    <script src="assets1/js/script.js"></script>


    <script>
$(document).ready(function() {
    let currentRequestId = null;
    let rejectRequestId = null;

    // Show only Pending requests on page load and populate request type dropdown
    filterTable("", "Pending");
    populateRequestTypeDropdown();

    // Event handler for Approve button
    $('.approve-btn').on('click', function(e) {
        e.preventDefault();
        const status = $(this).closest('tr').find('td:eq(5)').text().trim();

        // Prevent approval if the request is already approved or rejected
        if (status === 'Approved' || status === 'Rejected') {
            alert('This request has already been processed and cannot be modified.');
            return;
        }

        currentRequestId = $(this).data('id');
        $('#confirmApprovalModal').modal('show');
    });

    // Confirm approval
    // Confirm approval with date and time
$('#confirmApproveBtn').on('click', function() {
    const scheduleDate = $('#scheduleDate').val();
    const scheduleTime = $('#scheduleTime').val();

    if (!scheduleDate || !scheduleTime) {
        alert('Please select both a schedule date and time.');
        return;
    }

    $.ajax({
        url: `/request/approve/${currentRequestId}`,
        type: 'POST',
        data: {
            schedule_date: scheduleDate,
            schedule_time: scheduleTime
        },
        success: function() {
            $('#confirmApprovalModal').modal('hide');
            alert('Request approved successfully.');

            const row = $(`a[data-id="${currentRequestId}"]`).closest('tr');
            row.find('td:eq(5)').html('<span class="badge badge-success">Approved</span>');
            row.find('.approve-btn, .reject-btn').remove();
        },
        error: function() {
            alert('Error approving the request. Please try again.');
        }
    });
});

    // Event handler for Reject button
    $('.reject-btn').on('click', function(e) {
        e.preventDefault();
        const status = $(this).closest('tr').find('td:eq(5)').text().trim();

        // Prevent rejection if the request is already approved or rejected
        if (status === 'Approved' || status === 'Rejected') {
            alert('This request has already been processed and cannot be modified.');
            return;
        }

        rejectRequestId = $(this).data('id');
        $('#rejectModal').modal('show');
    });

    // Confirm rejection with a reason
    $('#confirmRejectBtn').on('click', function() {
        const rejectReason = $('#rejectReason').val().trim();

        if (!rejectReason) {
            alert('Please provide a reason for rejection.');
            return;
        }

        $.ajax({
            url: `/request/reject/${rejectRequestId}`,
            type: 'POST',
            data: { reason: rejectReason },
            success: function() {
                $('#rejectModal').modal('hide');
                alert('Request rejected successfully.');

                const row = $(`a[data-id="${rejectRequestId}"]`).closest('tr');
                row.find('td:eq(5)').html('<span class="badge badge-danger">Rejected</span>');
                row.find('.approve-btn, .reject-btn').remove();
            },
            error: function() {
                alert('Error rejecting the request. Please try again.');
            }
        });
    });

    // Filter table based on selected type and status
    $('#filterDropdown, #statusFilter').on('change', function() {
        const selectedRequestType = $('#filterDropdown').val();
        const selectedStatus = $('#statusFilter').val();
        filterTable(selectedRequestType, selectedStatus);
        populateRequestTypeDropdown();
    });

    // Function to filter table rows
    function filterTable(requestType, requestStatus) {
        $('tbody tr').each(function() {
            const rowRequestType = $(this).find('td:eq(1)').text();
            const rowStatus = $(this).find('td:eq(5)').text().trim();

            const matchesType = !requestType || rowRequestType === requestType;
            const matchesStatus = !requestStatus || rowStatus === requestStatus;

            $(this).toggle(matchesType && matchesStatus);
        });
    }

    // Populate the request type dropdown based on visible rows
    function populateRequestTypeDropdown() {
        const uniqueTypes = new Set();
        $('tbody tr:visible').each(function() {
            uniqueTypes.add($(this).find('td:eq(1)').text());
        });

        // Uncomment to repopulate the dropdown as needed
        // $('#filterDropdown').empty().append('<option value="">-- Select Request Type --</option>');
        // uniqueTypes.forEach(type => $('#filterDropdown').append(`<option value="${type}">${type}</option>`));
    }

    // Reset filter functionality
    $('#resetFilter').on('click', function() {
        $('#filterDropdown, #statusFilter').val('');
        $('tbody tr').show();
        populateRequestTypeDropdown();
    });
});
</script>


</body>

</html>