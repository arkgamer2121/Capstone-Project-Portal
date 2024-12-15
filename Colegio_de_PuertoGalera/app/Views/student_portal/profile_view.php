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
            <a href="/profile" class="logo">
                <img src="<?= isset($profile_picture) ? $profile_picture : 'default-profile.png' ?>" class="rounded-circle" alt="logo">
                <span class="logoclass" ><?= isset($user['name']) ? esc($user['name']) : 'CDPG' ?></span>
            </a>
            <a href="/profile" class="logo logo-small">
               <img src="<?= base_url('assets/images/icon/colegiologo.png'); ?>" alt="Logo" width="30" height="30">
            </a>
        </div>
        <a href="javascript:void(0);" id="toggle_btn"><i class="fe fe-text-align-left"></i></a>
        <a class="mobile_btn" id="mobile_btn"><i class="fas fa-bars"></i></a>
        <ul class="nav user-menu">
            <li class="nav-item dropdown noti-dropdown">
                <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
                    <i class="fe fe-bell"></i>
                    <span class="badge badge-pill"><?= $badgeCount > 0 ? $badgeCount : 0 ?></span> <!-- Dynamic badge count -->

                </a>
                <div class="dropdown-menu notifications">
                    <div class="topnav-dropdown-header">
                        <span class="notification-title">Notifications</span>
                        <a href="javascript:void(0)" class="clear-noti">Clear All</a>
                    </div>
                    <div class="noti-content">
                        <ul class="notification-list">
                            <?php if (count($notifications) > 0): ?>
                                <?php foreach ($notifications as $notification): ?>
                                    <?php if ($notification['status'] === 'Approved' || $notification['status'] === 'Rejected'): ?>
                                        <li class="notification-message">
                                            <div class="media">
                                               <span class="avatar avatar-sm">
                                                    <i class="bi bi-bell"></i> <!-- Bootstrap Icons bell icon -->
                                                </span>
                                                <div class="media-body">
                                                    <p class="noti-details">
                                                        <?php if ($notification['status'] === 'Approved'): ?>
                                                            <span class="noti-title">
                                                                Your request for <?= $notification['request_type'] ?> has been approved and scheduled on <?= date('F j, Y', strtotime($notification['schedule_date'])) ?> at <?= $notification['schedule_time'] ?>.
                                                            </span>
                                                        <?php elseif ($notification['status'] === 'Rejected'): ?>
                                                            <span class="noti-title">
                                                                Your request for <?= $notification['request_type'] ?> has been rejected. Reason: <?= $notification['reject_reason'] ?>.
                                                            </span>
                                                        <?php endif; ?>
                                                        <br>
                                                        <span class="noti-time"><?= time_elapsed_string($notification['updated_at']) ?></span>
                                                    </p>
                                                </div>
                                            </div>
                                        </li>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <li class="notification-message">
                                    <div class="media">
                                        <div class="media-body">
                                            <p class="noti-details">
                                                <span class="noti-title">No new notifications.</span>
                                            </p>
                                        </div>
                                    </div>
                                </li>
                            <?php endif; ?>
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
                    <a href="#"><i class="bi bi-pencil"></i> <span>Application Request</span><span class="menu-arrow"></span></a>
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
                        <h3 class="page-title">Profile</h3>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="profile-header">
                        <div class="row align-items-center">
                            <div class="col-auto profile-image">
                                <a href="#" data-toggle="modal" data-target="#upload_profile_picture">
                                <img src="<?= isset($profile_picture) ? $profile_picture : 'default-profile.png' ?>" id="profile-logo" alt="Profile Logo" class="rounded-circle mt-2">
                                </a>
                                <h5 id="username" class="mt-2"><?= $user['name'] ?></h5> <!-- Replace with dynamic name -->
                                <h6 class="text-muted mt-1">Roles</h6> <!-- Replace with dynamic Designation -->
                                <div class="user-location mt-1"><i class="fas fa-map-marker-alt"></i> Location</div> <!-- Replace with dynamic location -->
                                <div class="about-text">Description</div> <!-- Replace with dynamic description -->
                            </div>
                        </div>
                    </div>
                    <div class="profile-menu">
                        <ul class="nav nav-tabs nav-tabs-solid">
                            <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#per_details_tab">About</a></li>
                            <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#password_tab">Password</a></li>
                        </ul>
                    </div>

                    <div class="tab-content profile-tab-cont">
                        <div class="tab-pane fade show active" id="per_details_tab">
                            <div class="row">
        <!-- Left Column - Personal Details -->
        <div class="col-lg-6">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title d-flex justify-content-between">
                                    <span>Personal Details</span>
                                    <a class="edit-link" data-toggle="modal" href="#edit_personal_details1">
                                        <i class="fa fa-edit mr-1"></i>Edit
                                    </a>
                                </h5>
        </div>
        <div class="card-body">
            <form action="<?= base_url('userdetails/store') ?>" method="post">
                <?= csrf_field() ?>
                <div class="mb-3 row">
                    <label class="col-sm-3 col-form-label">Username</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" value="<?= isset($user['name']) ? esc($user['name']) : '' ?>" readonly>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label class="col-sm-3 col-form-label">Email</label>
                    <div class="col-sm-9">
                        <input type="email" class="form-control" value="<?= isset($user['email']) ? esc($user['email']) : '' ?>" readonly>
                    </div>
                </div>

                <label>Contact:</label>
                <input type="text" name="contact" class="form-control" value="<?= isset($user['contact']) ? esc($user['contact']) : '' ?>" required><br>

                <label>Address:</label>
                <input type="text" name="address" class="form-control" value="<?= isset($user['address']) ? esc($user['address']) : '' ?>" required><br>

                <label>Gender:</label>
                <select name="gender" class="form-control" required>
                    <option value="Male" <?= (isset($user['gender']) && $user['gender'] == 'Male') ? 'selected' : '' ?>>Male</option>
                    <option value="Female" <?= (isset($user['gender']) && $user['gender'] == 'Female') ? 'selected' : '' ?>>Female</option>
                    <option value="Other" <?= (isset($user['gender']) && $user['gender'] == 'Other') ? 'selected' : '' ?>>Other</option>
                </select><br>

                <label>Age:</label>
                <input type="number" name="age" class="form-control" value="<?= isset($user['age']) ? esc($user['age']) : '' ?>" required><br>

                <label>Other Information:</label>
                <textarea name="other_information" class="form-control"><?= isset($user['other_information']) ? esc($user['other_information']) : '' ?></textarea><br>

                <label>Blood Type:</label>
                <select name="blood_type" class="form-control" required>
                    <option value="A+" <?= (isset($user['blood_type']) && $user['blood_type'] == 'A+') ? 'selected' : '' ?>>A+</option>
                    <option value="A-" <?= (isset($user['blood_type']) && $user['blood_type'] == 'A-') ? 'selected' : '' ?>>A-</option>
                    <option value="B+" <?= (isset($user['blood_type']) && $user['blood_type'] == 'B+') ? 'selected' : '' ?>>B+</option>
                    <option value="B-" <?= (isset($user['blood_type']) && $user['blood_type'] == 'B-') ? 'selected' : '' ?>>B-</option>
                    <option value="AB+" <?= (isset($user['blood_type']) && $user['blood_type'] == 'AB+') ? 'selected' : '' ?>>AB+</option>
                    <option value="AB-" <?= (isset($user['blood_type']) && $user['blood_type'] == 'AB-') ? 'selected' : '' ?>>AB-</option>
                    <option value="O+" <?= (isset($user['blood_type']) && $user['blood_type'] == 'O+') ? 'selected' : '' ?>>O+</option>
                    <option value="O-" <?= (isset($user['blood_type']) && $user['blood_type'] == 'O-') ? 'selected' : '' ?>>O-</option>
                </select><br>

                <button type="submit" class="btn btn-primary mt-3">Save</button>
            </form>
        </div>
    </div>
</div>

<!-- Edit Personal Details Modal -->
<div class="modal fade" id="edit_personal_details1" aria-hidden="true" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Personal Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"> 
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="<?= base_url('userdetails/store') ?>">
                    <div class="row form-row">
                        <div class="col-12">
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" name="name" class="form-control" value="<?= isset($user['name']) ? esc($user['name']) : '' ?>" required>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="form-group">
                                <label>Date of Birth</label>
                                <div class="cal-icon">
                                    <input type="date" name="date_of_birth" class="form-control" value="" required>
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="form-group">
                                <label>Email ID</label>
                                <input type="email" name="email" class="form-control" value="<?= isset($user['email']) ? esc($user['email']) : '' ?>" required>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="form-group">
                                <label>Mobile</label>
                                <input type="text" name="mobile" class="form-control" value="<?= isset($user['contact']) ? esc($user['contact']) : '' ?>" required>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="form-group">
                                <label>Address</label>
                                <input type="text" name="address" class="form-control" value="<?= isset($user['address']) ? esc($user['address']) : '' ?>" required>
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary btn-block">Save Changes</button>
                </form>
            </div>
        </div>
    </div>
</div>

 <!-- Right Column - Profile Picture -->
<div class="col-lg-6">
    <div class="card">
        <div class="card-body text-center">
            <h5 class="card-title">Profile Picture</h5>
            <a href="#">
                <img class="rounded-circle" alt="User Image" id="profile_image_preview" 
                src="<?= isset($profile_picture) && !empty($profile_picture) ? base_url('writable/uploads/' . $profile_picture) : base_url('default-profile.png') ?>"

                     width="150" height="150">
            </a>
            <form method="POST" action="<?= base_url('profile/uploadImage') ?>" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="profile_picture">Upload New Profile Picture</label>
                    <input type="file" name="profile_picture" class="form-control-file" id="profile_picture" required>
                </div>
                <button type="submit" class="btn btn-primary">Upload</button>
            </form>
        </div>
    </div>
</div>

    <!-- Password Change Tab -->
    <div class="tab-pane fade" id="password_tab">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Change Password</h5>
                <form method="POST" action="admin/changePassword">
                    <div class="form-group">
                        <label for="current_password">Current Password</label>
                        <input type="password" name="current_password" class="form-control" id="current_password" required>
                    </div>
                    <div class="form-group">
                        <label for="new_password">New Password</label>
                        <input type="password" name="new_password" class="form-control" id="new_password" required>
                    </div>
                    <div class="form-group">
                        <label for="confirm_password">Confirm New Password</label>
                        <input type="password" name="confirm_password" class="form-control" id="confirm_password" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Change Password</button>
                </form>
            </div>
        </div>
    </div>
</div>
                </div>
            </div>
        </div>

      
    </div>
</div>


<script>
    document.getElementById('profile_picture').addEventListener('change', function(event) {
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('profile_image_preview').src = e.target.result;
        }
        reader.readAsDataURL(event.target.files[0]);
    });
</script>

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
