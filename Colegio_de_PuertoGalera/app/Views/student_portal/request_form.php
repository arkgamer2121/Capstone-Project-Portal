<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <title>Student Portal</title>
    <link rel="shortcut icon" type="image/x-icon" href="<?= base_url('assets/images/icon/colegiologo.png'); ?>">
    <link rel="stylesheet" href="<?= base_url('assets1/css/bootstrap.min.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('assets1/plugins/fontawesome/css/fontawesome.min.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('assets1/plugins/fontawesome/css/all.min.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('assets1/css/feathericon.min.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('assets1/plugins/morris/morris.css'); ?>">
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets1/css/bootstrap-datetimepicker.min.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('assets1/css/style.css'); ?>">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">

    <style>
        .round-circle {
            border-radius: 50%;
            object-fit: cover;
            width: 200px;
            height: 200px;
        }
        
        .profile-header img {
            height: 160px;
            max-width: 300px;
            width: 160px;
        }
    </style>
</head>

<body>
<div class="main-wrapper">
    <div class="header">
        <div class="header-left">
            <a href="/dashboard" class="logo">
                <img src="<?= isset($profile_picture) ? $profile_picture : 'default-profile.png' ?>" class="rounded-circle" alt="logo">
                <span class="logoclass" ><?= isset($user['name']) ? esc($user['name']) : 'CDPG' ?></span>
            </a>
            <a href="/dashboard" class="logo logo-small">
                 <img src="<?= isset($profile_picture) ? $profile_picture : 'default-profile.png' ?>" class="rounded-circle" alt="Logo" width="30" height="30">
            </a>
        </div>
        <a href="javascript:void(0);" id="toggle_btn"><i class="fe fe-text-align-left"></i></a>
        <a class="mobile_btn" id="mobile_btn"><i class="fas fa-bars"></i></a>
        <ul class="nav user-menu">
            <li class="nav-item dropdown noti-dropdown">
                <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
                    <i class="fe fe-bell"></i>
                    <span class="badge badge-pill">0</span> <!-- Set to 0 or handle dynamically -->
                </a>
                <div class="dropdown-menu notifications">
                    <div class="topnav-dropdown-header">
                        <span class="notification-title">Notifications</span>
                        <a href="javascript:void(0)" class="clear-noti">Clear All</a>
                    </div>
                    <div class="noti-content">
                        <ul class="notification-list">
                            <li class="notification-message">
                                <div class="media">
                                    <span class="avatar avatar-sm">
                                        <img class="avatar-img rounded-circle" alt="User Image" src="assets/img/profiles/default-avatar.jpg">
                                    </span>
                                    <div class="media-body">
                                        <p class="noti-details">
                                            <span class="noti-title">No new notifications.</span>
                                        </p>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="topnav-dropdown-footer">
                        <a href="#">View all Notifications</a>
                    </div>
                </div>
            </li>

            <li class="nav-item dropdown has-arrow">
                <a class="dropdown-toggle nav-link" data-toggle="dropdown">
                    <span class="user-img">
                        <img class="rounded-circle" src="<?= isset($profile_picture) ? $profile_picture : 'default-profile.png' ?>" width="31">
                    </span>
                </a>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="/profile">My Profile</a>
                    
                    <a class="dropdown-item" href="signin">Logout</a>
                </div>
            </li>
        </ul>
        <div class="top-nav-search">
            <form>
                <input type="text" class="form-control" placeholder="Search here">
                <button class="btn" type="submit"><i class="fas fa-search"></i></button>
            </form>
        </div>
    </div>

   
<div class="sidebar" id="sidebar">
    <div class="sidebar-inner slimscroll">
        <div id="sidebar-menu" class="sidebar-menu">
            <ul>
                <li class="active"> <a href="/profile"><i class="bi bi-person"></i> <span>Profile</span></a> </li>
                <li class="submenu">
                    <a href="#"><i class="bi bi-file-earmark-text"></i> <span>Application Request</span><span class="menu-arrow"></span></a>
                    <ul class="submenu_class" style="display: none;">
                        <li><a href="/request">Request Form</a></li>
                        <li><a href="/reqStatus">Request Status</a></li>
                    </ul>
                </li>
                <li class="submenu">
                    <a href="#"><i class="bi bi-file-earmark-text"></i> <span>Documents</span><span class="menu-arrow"></span></a>
                    <ul class="submenu_class" style="display: none;">
                        <li><a href="/allteachers">Students Data</a></li>
                    </ul>
                </li>
                <li class="submenu"> 
                    <a href="#"><i class="bi bi-lock"></i> <span>Change Password</span></a>
                </li>
                <li class="submenu"> 
                    <a href="/notifications"><i class="bi bi-bell"></i> <span>Notifications</span></a>
                </li>
                <li class="submenu"> 
                    <a href="/settings"><i class="bi bi-gear"></i> <span>Settings</span></a>
                </li>
                <li> 
                    <a href="/signin"><i class="bi bi-box-arrow-right"></i> <span>Sign Out</span></a>
                </li>
                 <li> 
                    <a href="/"><i class="bi bi-house"></i> <span>Home Page</span></a>
                </li>
            </ul>
        </div>
    </div>
</div>


<div class="page-wrapper">
    <div class="content container-fluid">
        <div class="page-header mt-5">
            <div class="row">
                <div class="col">
                    <h3 class="page-title text-center">Request Form</h3>
                </div>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">

                        <!-- Success Message -->
                        <?php if (session()->getFlashdata('message')): ?>
                            <p class="alert alert-success">
                                <i class="fas fa-check-circle"></i> <!-- Font Awesome check icon -->
                                <?= session()->getFlashdata('message') ?>
                            </p>
                        <?php endif; ?>

                        <!-- Request Form -->
                        <form action="/request/create" method="post" class="bg-white p-4 rounded shadow">

                              <!-- Student Information -->
                            <?php
                                // Assuming session data contains user information
                                $session = session();
                                // $name = $session->get(' $user['name']'); // Replace with the actual session key for 'name'
                                $student_id = $session->get('student_id'); // Replace with the actual session key for 'student_id'
                                ?>

                               <div class="form-group">
                                    <label for="name">Name:</label>
                                    <input type="text" name="name" id="name" class="form-control" required>
                                </div>
                                
                                <div class="form-group">
                                    <label for="student_id">Student ID:</label>
                                    <input type="text" name="student_id" id="student_id" class="form-control" value="<?= esc($student_id) ?>" readonly required>
                                </div>
                            <div class="form-group">
                                <label for="contact_number">Contact Number:</label>
                                <input type="text" name="contact_number" id="contact_number" class="form-control" placeholder="Enter your contact number" required>
                            </div>

                            <!-- Request Details -->
                            <div class="form-group">
                                <label for="request_type">Type of Request:</label>
                                <select name="request_type" id="request_type" class="form-control" required>
                                    <option value="COR">Certificate of Registration (COR)</option>
                                    <option value="COG">Certificate of Grades (COG)</option>
                                    <option value="COE">Certificate of Enrollment (COE)</option>
                                    <option value="STUDENT ID">STUDENT ID</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="purpose">Purpose of Request:</label>
                                <input type="text" name="purpose" id="purpose" class="form-control" placeholder="Enter the purpose of the request" required>
                            </div>

                            <div class="form-group">
                                <label for="specific_documents">Specific Documents/Records Needed:</label>
                                <input type="text" name="specific_documents" id="specific_documents" class="form-control" placeholder="Enter the specific documents/records needed" required>
                            </div>

                            <!-- Academic Information -->
                            <div class="form-group">
                                <label for="course">Course:</label>
                                <select name="course" id="course" class="form-control" required>
                                    <option value="" disabled selected>Select your course</option>
                                    <option value="Bachelor of Science in Tourism Management">Bachelor of Science in Tourism Management</option>
                                    <option value="Bachelor of Science in Office Administrator">Bachelor of Science in Office Administrator</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="year">Year:</label>
                                <select name="year" id="year" class="form-control" required>
                                    <option value="" disabled selected>Select your year level</option>
                                    <option value="1st Year">1st Year</option>
                                    <option value="2nd Year">2nd Year</option>
                                    <option value="3rd Year">3rd Year</option>
                                    <option value="4th Year">4th Year</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="section">Section:</label>
                                <select name="section" id="section" class="form-control" required>
                                    <option value="" disabled selected>Select your section</option>
                                    <option value="A">A</option>
                                    <option value="B">B</option>
                                </select>

                            <!-- Submit Button -->
                            <div class="text-right">
                                <button type="submit" class="btn btn-primary mt-3">Submit Request</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>






<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

<script src="<?= base_url('assets1/js/jquery-3.5.1.min.js'); ?>"></script>
<script src="<?= base_url('assets1/js/popper.min.js'); ?>"></script>
<script src="<?= base_url('assets1/js/bootstrap.min.js'); ?>"></script>
    <script src="<?= base_url('assets1/js/moment.min.js'); ?>"></script>
    <script src="<?= base_url('assets1/plugins/slimscroll/jquery.slimscroll.min.js'); ?>"></script>
    <script src="<?= base_url('assets1/js/bootstrap-datetimepicker.min.js'); ?>"></script>
    <script src="<?= base_url('assets1/js/script.js'); ?>"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox.min.js"></script>
</body>

</html>
