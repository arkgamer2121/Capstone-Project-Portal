<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin - Faculty List</title>
    <link rel="shortcut icon" type="image/x-icon" href="assets/images/icon/colegiologo.png">
    <link rel="stylesheet" href="assets1/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets1/plugins/fontawesome/css/fontawesome.min.css">
    <link rel="stylesheet" href="assets1/plugins/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="assets1/css/feathericon.min.css">
    <link rel="stylesheet" href="assets1/plugins/morris/morris.css">
    <link rel="stylesheet" type="text/css" href="assets1/css/bootstrap-datetimepicker.min.css">
    <link rel="stylesheet" href="assets1/css/style.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

    <!-- Load Bootstrap and FontAwesome -->
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto+Slab:wght@400;700&display=swap"> 
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400;700&display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Georgia:wght@400;700&display=swap"> -->
    
    <style>
    .table {
        background-color: white;
    }
    .table th, .table td {
        vertical-align: middle;
    }
        .small-button {
            width: 80px;
            height: 35px;
        }
        .large-button {
            width: 100px;
            height: 45px;
        }
        .table-striped th,
        .table-striped td {
            border-right: 1px solid #ccc; /* Create vertical lines between columns */
        }
        /* To remove the last border-right */
        .table-striped th:last-child,
        .table-striped td:last-child {
            border-right: none;
        }
       h1 {
    font-family: 'Arial', sans-serif; /* A clean and professional sans-serif font */
}

        .custom-modal-dialog {
            max-width: 500px; /* Restricting the width for a minimalist look */
        }

        .modal-header,
        .modal-footer {
            border: none; /* Removing border for a clean look */
        }

        .modal-title {
            font-weight: 500; /* Slightly less bold title */
        }

        .btn {
            border-radius: 20px; /* Soft rounded corners */
        }

        .form-control {
            border-radius: 10px; /* Softer input field borders */
        }

        /* Minimalist color scheme */
        .modal-content {
            background-color: #f5f5f5; /* Soft background color */
        }

        .btn-primary {
            background-color: #4a90e2; /* Soft blue color for primary buttons */
            border: none; /* No border for a minimalist look */
        }

        .btn-secondary {
            background-color: #aaa; /* Gray color for secondary buttons */
            border: none; /* No border */
        }
            /* Apply the slab font to the entire body, or specifically to the table */
        body {
            font-family: 'Georgia', serif;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 5px;
            text-align: left;
            border: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
            font-weight: bold;
        }
        .container {
    width: 110%; /* Adjust width percentage */
    max-width: 1500px; /* Optional: set a maximum width */
    margin: 0 auto; /* Center the container */
}
.bg-success {
    background-color: #28a745 !important; /* Green */
}

.text-warning {
    color: #ffc107 !important; /* Yellow text for warning */
}

.card-header {
    background-color: lightgreen; /* Green */
    color: white;
}

.card-body {
    background-color: white; /* Light green background */
}

.table-responsive {
    background-color: white; /* Light green background */
}

/* Pagination Customization */
.page-item .page-link {
    color: #28a745;
    font-weight: bold;
}

.page-item .page-link:hover {
    background-color: #f8f9fa;
    color: #007bff;
}

.page-item.active .page-link {
    background-color: white;
    border-color: #28a745;
    color: white;
}

        
    </style>
</head>
<body>
    <!-- topbar -->
    <?= $this->include('include/topbar.php') ?>

    <!-- sidebar -->
    <?= $this->include('include/sidebar.php') ?>

        <?php if (session()->has('success')): ?>
        <div class="alert alert-success" role="alert">
            <?= session()->get('success'); ?>
        </div>
        <?php endif; ?>

        <div class="page-wrapper">
        <div class="content container-fluid">
    <div class="container mt-5">
        <h1 class="mb-4">Class Schedule</h1>
   
        <!-- Button to open modal for creating a new schedule -->
        <button class="btn btn-light mb-2" data-toggle="modal" data-target="#addScheduleModal">
            <i class="fas fa-plus"></i> Add New Schedule
        </button>
        <div class="button-container mb-4" style="text-align: right;">
      <button class="btn btn-light filter-btn" data-filter="all">
      <a href="/history" style="color: white;"> 
  <i class="fas fa-history"></i> History Log
</a>

      </button>
        </div>


        <div>
        <hr style="margin-top: 10px; border: 1px solid #ccc;">
        </div>
        
        <!-- Modal for creating a new schedule -->
 <!-- Modal for creating a new schedule -->
 <div class="modal fade" id="addScheduleModal" tabindex="-1" role="dialog" aria-labelledby="addScheduleModalLabel" aria-hidden="true">
    <div class="modal-dialog custom-modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addScheduleModalLabel">Create a New Schedule</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Form for creating a new schedule -->
                <form action="/schedule/create" method="post">
                    <!-- Faculty -->
                    <div class="form-group">
                        <label for="faculty_select">Faculty</label>
                        <select name="faculty_select" id="faculty_select" class="form-control" required>
                            <option value="" disabled selected>Select a Faculty Member</option>
                            <?php foreach ($faculty as $member): ?>
                                <option value="<?= esc($member['last_name']) . ', ' . esc($member['first_name']) . ' ' . esc($member['middle_name']); ?>">
                                    <?= esc($member['last_name']); ?>, <?= esc($member['first_name']); ?> <?= esc($member['middle_name']); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    
                 <!-- Days of Week -->
                    <div class="form-group">
                        <label for="days_of_week">Days of Week</label>
                        <select name="days_of_week" id="days_of_week" class="form-control" required>
                            <option value="" disabled selected>Select day</option>
                            <option value="Monday">Monday</option>
                            <option value="Tuesday">Tuesday</option>
                            <option value="Wednesday">Wednesday</option>
                            <option value="Thursday">Thursday</option>
                            <option value="Friday">Friday</option>
                            <option value="Saturday">Saturday</option>
                        </select>
                    </div>

                  <!-- Year -->
                <div class="form-group">
                    <label for="year">Year</label>
                    <select name="year" id="year" class="form-control" required>
                        <option value="" disabled selected>Select Year</option>
                        <?php foreach ($years as $year): ?>
                            <option value="<?= esc($year['year']); ?>"><?= esc($year['year']); ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <!-- semester -->
                <div class="form-group">
                        <label for="sem">Semester</label>
                        <select name="sem" id="sem" class="form-control" required>
                            
                            <option value="1st Semester">1st Semester</option>
                            <option value="2nd Semester">2nd Semester</option>
                        </select>
                    </div>
                    

                  
                    <!-- Course -->
                <!-- Course -->
                <div class="form-group">
                    <label for="course">Course</label>
                    <select name="course" id="course" class="form-control" required>
                        <option value="" disabled selected>Select a Course</option>
                        <?php 
                        // Extract unique course names
                        $uniqueCourses = [];
                        foreach ($subjects as $subject) {
                            if (!in_array($subject['course'], $uniqueCourses)) {
                                $uniqueCourses[] = $subject['course'];
                                // Display the unique course as an option
                                echo '<option value="' . esc($subject['course']) . '">' . esc($subject['course']) . '</option>';
                            }
                        }
                        ?>
                    </select>
                </div>
                                        
                   
                    
                    <!-- Section -->
                    <div class="form-group">
                        <label for="section">Section</label>
                        <select name="section" id="section" class="form-control" required>
                            <option value="" disabled selected>Select Section</option>
                            <option value="A">A</option>
                            <option value="B">B</option>
                            <option value="C">C</option>
                        </select>
                    </div>
                    
                    <!-- Subject Code -->
                    <div class="form-group">
                        <label for="subject_code">Subject Code</label>
                        
                        <select name="subject_code" id="subject_code" class="form-control" required>
                        <option value="" disabled selected>Select Subject Code</option>
                        <?php foreach ($subjects as $subject): ?>
                            <option value="<?= esc($subject['name']); ?>"><?= esc($subject['name']); ?></option>
                        <?php endforeach; ?>
                    </select>
                    </div>
            
                    
                    <!-- Subject -->
                    <div class="form-group">
                        <label for="subject">Subject</label>
                        <select name="subject" id="subject" class="form-control" required>
                            <option value="">Select Subject</option>
                            <?php foreach ($subjects as $subject): ?>
                                <option value="<?= esc($subject['description']); ?>"><?= esc($subject['description']); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    
                    <!-- Time From -->
                    <div class="form-group">
                        <label for="time_from">Time From</label>
                        <input type="time" name="time_from" id="time_from" class="form-control" required>
                    </div>
                    
                    <!-- Time To -->
                    <div class="form-group">
                        <label for="time_to">Time To</label>
                        <input type="time" name="time_to" id="time_to" class="form-control" required>
                    </div>
                    
                    <!-- Room -->
                    <div class="form-group">
                        <label for="room">Room</label>
                        <select name="room" id="room" class="form-control" required>
                            <option value="">Select Room</option>
                            <?php for ($i = 1; $i <= 10; $i++): ?>
                                <option value="<?= $i ?>"><?= $i ?></option>
                            <?php endfor; ?>
                        </select>
                    </div>
                    
                    <!-- Description -->
                    <div class="form-group">
                        <label for="description">Description</label>
                        <input type="text" name="description" id="description" class="form-control" required>
                    </div>
                    
                    <!-- Submit Button -->
                    <button type="submit" class="btn btn-primary">Create Schedule</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid">
    <!-- Top Filter Section -->
    <div class="row mb-4">
        <!-- Day filter dropdown and search bar (left side) -->
        <div class="col-md-6 mb-3 d-flex">
            <div class="day-filter-dropdown mr-3">
                <select class="form-control" id="dayFilter" style="width: 100%; border-radius: 25px; background-color: white; border: 1px solid #darkgreen;">
                    <option value="all">All Days</option>
                    <option value="monday">Monday</option>
                    <option value="tuesday">Tuesday</option>
                    <option value="wednesday">Wednesday</option>
                    <option value="thursday">Thursday</option>
                    <option value="friday">Friday</option>
                    <option value="saturday">Saturday</option>
                </select>
            </div>
            <!-- Search bar -->
            <div class="search-container">
                <input type="text" id="searchFaculty" placeholder="Search by Faculty" class="form-control search-bar" style="width: 250px; height: 40px; border-radius: 30px; background-color:white; border: 1px solid lighgray;">
            </div>
        </div>

        <!-- Filter buttons (right side) -->
        <div class="col-md-6 d-flex justify-content-end align-items-center">
            <div class="filter-btn-group d-flex">
                <button class="btn btn-light filter-btn px-4 py-1 mr-3 rounded-pill" data-filter="all">
                    ALL
                </button>
                <button class="btn btn-light filter-btn px-4 py-1 mr-3 rounded-pill" data-filter="Bachelor of Science in Tourism Management">
                    BSTM
                </button>
                <button class="btn btn-light filter-btn px-4 py-1 mr-3 rounded-pill" data-filter="Bachelor of Science in Office Administration">
                    BSOA
                </button>
            </div>
        </div>
    </div>

    <!-- Schedule Table Section -->
    <div class="row">
    <div class="col-lg-12">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg- text-white">
                <h4 class="card-title mb-0">Schedule Management</h4>
            </div>
                <div class="card-body p-3">
                    <div class="table-responsive">
                        <table id="scheduleTable" class="datatable table table-bordered table-sm mb-4" style="border: 1px solid #green;">
                            <thead class="bg-success text-black">
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
                                <th class="text-center">Edit</th>
                                <th class="text-center">Delete</th>
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
                                        <td class="text-center">
                                            <button class="btn btn-light btn-sm" data-toggle="modal" data-target="#editScheduleModal-<?= esc($schedule['id']) ?>">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                        </td>
                                        <td class="text-center">
                                            <a class="btn btn-light btn-sm" href="<?= base_url('/scheduledelete/' . $schedule['id']) ?>" onclick="return confirm('Are you sure you want to delete this schedule?');">
                                                <i class="fas fa-trash-alt"></i>
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
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
    <?php foreach ($schedules as $schedule): ?>
<div class="modal fade" id="editScheduleModal-<?= esc($schedule['id']) ?>" tabindex="-1" role="dialog" aria-labelledby="editScheduleModalLabel-<?= esc($schedule['id']) ?>" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editScheduleModalLabel-<?= esc($schedule['id']) ?>">Edit Schedule</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('/schedule/update/' . esc($schedule['id'])) ?>" method="post">
                <div class="modal-body">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="faculty_name-<?= esc($schedule['id']) ?>">Faculty Name</label>
                            <input type="text" id="faculty_name-<?= esc($schedule['id']) ?>" name="faculty_name" class="form-control" value="<?= esc($schedule['faculty_name']) ?>" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="days_of_week-<?= esc($schedule['id']) ?>">Days of Week</label>
                            <input type="text" id="days_of_week-<?= esc($schedule['id']) ?>" name="days_of_week" class="form-control" value="<?= esc($schedule['days_of_week']) ?>" required>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="subject_code-<?= esc($schedule['id']) ?>">Subject Code</label>
                            <input type="text" id="subject_code-<?= esc($schedule['id']) ?>" name="subject_code" class="form-control" value="<?= esc($schedule['subject_code']) ?>" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="subject-<?= esc($schedule['id']) ?>">Subject</label>
                            <input type="text" id="subject-<?= esc($schedule['id']) ?>" name="subject" class="form-control" value="<?= esc($schedule['subject']) ?>" required>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="time_from-<?= esc($schedule['id']) ?>">Time From</label>
                            <input type="time" id="time_from-<?= esc($schedule['id']) ?>" name="time_from" class="form-control" value="<?= esc($schedule['time_from']) ?>" required>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="time_to-<?= esc($schedule['id']) ?>">Time To</label>
                            <input type="time" id="time_to-<?= esc($schedule['id']) ?>" name="time_to" class="form-control" value="<?= esc($schedule['time_to']) ?>" required>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="room-<?= esc($schedule['id']) ?>">Room</label>
                            <input type="text" id="room-<?= esc($schedule['id']) ?>" name="room" class="form-control" value="<?= esc($schedule['room']) ?>" required>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="sem-<?= esc($schedule['id']) ?>">Semester</label>
                            <input type="text" id="sem-<?= esc($schedule['id']) ?>" name="sem" class="form-control" value="<?= esc($schedule['sem']) ?>" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="description-<?= esc($schedule['id']) ?>">Description</label>
                            <input type="text" id="description-<?= esc($schedule['id']) ?>" name="description" class="form-control" value="<?= esc($schedule['description']) ?>" required>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="year-<?= esc($schedule['id']) ?>">Year</label>
                            <input type="text" id="year-<?= esc($schedule['id']) ?>" name="year" class="form-control" value="<?= esc($schedule['year']) ?>" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="section-<?= esc($schedule['id']) ?>">Section</label>
                            <input type="text" id="section-<?= esc($schedule['id']) ?>" name="section" class="form-control" value="<?= esc($schedule['section']) ?>" required>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="schedule_type-<?= esc($schedule['id']) ?>">Course</label>
                            <select id="schedule_type-<?= esc($schedule['id']) ?>" name="schedule_type" class="form-control" required>
                                <option value="Bachelor of Science in Tourism Management" <?= ($schedule['schedule_type'] === "Bachelor of Science in Tourism Management") ? 'selected' : '' ?>>Bachelor of Science in Tourism Management</option>
                                <option value="Bachelor of Science in Office Administration" <?= ($schedule['schedule_type'] === "Bachelor of Science in Office Administration") ? 'selected' : '' ?>>Bachelor of Science in Office Administration</option>
                            </select>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update Schedule</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php endforeach; ?>


        <div class="modal fade" id="successModal" tabindex="-1" role="dialog" aria-labelledby="successModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="successModalLabel">Update Success</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Schedule updated successfully.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Okay</button>
            </div>
        </div>
    </div>
</div>

  


 
   <!-- Include jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Include Bootstrap JS -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

   
    <script>
        document.getElementById('faculty_select').addEventListener('change', function() {
        document.getElementById('faculty_name').value = this.value;
    });
    </script>
    
    <script>
   $(document).ready(function() {
    // Function to filter the table based on the selected schedule type
    function filterTable(filterType) {
        $('#scheduleTable tbody tr').each(function() {
            var scheduleType = $(this).data('schedule-type').toLowerCase();
            if (filterType === 'all' || scheduleType === filterType) {
                $(this).show();
            } else {
                $(this).hide();
            }
        });
    }

    // Handle filter button clicks
    $('.filter-btn').click(function() {
        var filterType = $(this).data('filter').toLowerCase();
        filterTable(filterType);
    });

    // Search functionality
    $('#searchFaculty').on('input', function() {
        var searchQuery = $(this).val().toLowerCase();
        $('#scheduleTable tbody tr').each(function() {
            var facultyName = $(this).find('td:nth-child(2)').text().toLowerCase();
            if (facultyName.includes(searchQuery)) {
                $(this).show();
            } else {
                $(this).hide();
            }
        });
    });

});


        </script>

<script src="assets1/js/jquery-3.5.1.min.js"></script>
    <script src="assets1/js/popper.min.js"></script>
    <script src="assets1/js/bootstrap.min.js"></script>
    <script src="assets1/js/moment.min.js"></script>
    <script src="assets1/plugins/slimscroll/jquery.slimscroll.min.js"></script>
    <script src="assets1/js/bootstrap-datetimepicker.min.js"></script>
    <script src="assets1/js/script.js"></script>
    <script>
        $(function() {
            $('#datetimepicker3').datetimepicker({
                format: 'LT'
            });
        });
    </script>
     <script>
   // Add event listener to day filter dropdown
document.getElementById('dayFilter').addEventListener('change', function() {
    const selectedDay = this.value.toLowerCase();

    // Get all schedule rows
    const rows = document.querySelectorAll('.schedule-row');

    rows.forEach(row => {
        const day = row.getAttribute('data-day').toLowerCase();

        // Show or hide rows based on selected day
        if (selectedDay === 'all' || day === selectedDay) {
            row.style.display = '';  // Show row
        } else {
            row.style.display = 'none';  // Hide row
        }
    });
});

// Add event listener to filter buttons
document.querySelectorAll('.filter-btn').forEach(button => {
    button.addEventListener('click', function() {
        const filterValue = this.getAttribute('data-filter');
        
        // Get all rows in the table
        const rows = document.querySelectorAll('.schedule-row');
        
        rows.forEach(row => {
            const scheduleType = row.getAttribute('data-schedule-type').toLowerCase();
            
            // Show or hide rows based on selected filter
            if (filterValue === 'all' || scheduleType === filterValue) {
                row.style.display = '';  // Show row
            } else {
                row.style.display = 'none';  // Hide row
            }
        });
    });
});


     </script>



</body>
</html>