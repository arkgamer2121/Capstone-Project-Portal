<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <title>Change Password</title>
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
</head>

<body>
<div class="main-wrapper">
    <!-- Header -->
    <div class="header">
        <div class="header-left">
            <a href="/dashboard" class="logo">
                <img src="<?= isset($profile_picture) ? $profile_picture : 'default-profile.png' ?>" class="rounded-circle" alt="logo">
                <span class="logoclass"><?= isset($user['name']) ? esc($user['name']) : 'CDPG' ?></span>
            </a>
        </div>
        <ul class="nav user-menu">
            <!-- Notifications and User Profile Menu -->
            <li class="nav-item dropdown noti-dropdown">
                <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
                    <i class="fe fe-bell"></i>
                    <span class="badge badge-pill">0</span>
                </a>
                <div class="dropdown-menu notifications">
                    <!-- Notifications List -->
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
    </div>
    <!-- /Header -->

    <!-- Sidebar -->
    <div class="sidebar" id="sidebar">
    <div class="sidebar-inner slimscroll">
        <div id="sidebar-menu" class="sidebar-menu">
            <ul>
                <li class="active"> <a href="/profile"><i class="bi bi-person"></i> <span>Profile</span></a> </li>
                <li> <a href="/request"><i class="bi bi-clipboard"></i> <span>Requirement Request</span></a> </li>
                <!-- <li class="submenu">
                    <a href="#"><i class="bi bi-file-earmark-text"></i> <span>Request Documents</span><span class="menu-arrow"></span></a>
                    <ul class="submenu_class" style="display: none;">
                        <li><a href="/allteachers">Students Data</a></li>
                    </ul>
                </li> -->
                <li><a href="/chat"><i class="bi bi-chat-dots"></i> <span>Chatter</span></a> </li>

                <li class="submenu"> 
                    <a href=""><i class="bi bi-bell"></i> <span>Notifications</span></a>
                </li>
                <li> <a href="/changepassword"><i class="bi bi-key"></i> <span>Change Password</span></a> </li>
                <li class="submenu"> 
                <a href="/settings"><i class="bi bi-journal-text"></i> <span>Grades</span></a>
               </li>

                <li class="submenu"> 
                    <a href="/settings"><i class="bi bi-gear"></i> <span>Settings</span></a>
                </li>
                <li> 
                    <a href="/signin"><i class="bi bi-box-arrow-right"></i> <span>Sign Out</span></a>
                </li>
            </ul>
        </div>
    </div>
</div>

    <!-- /Sidebar -->

    <!-- Page Wrapper -->
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header mt-5">
                <div class="row">
                    <div class="col">
                        <h3 class="page-title text-center">Change Password</h3>
                    </div>
                </div>
            </div>

            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-body">
                            <!-- Success and Error Messages -->
                            <?php if (session()->getFlashdata('success')): ?>
                                <p class="alert alert-success"><?= session()->getFlashdata('success') ?></p>
                            <?php endif; ?>

                            <?php if (session()->getFlashdata('error')): ?>
                                <p class="alert alert-danger"><?= session()->getFlashdata('error') ?></p>
                            <?php endif; ?>

                            <?= \Config\Services::validation()->listErrors() ?>

                            <!-- Change Password Form -->
                            <form action="/change-password" method="post" class="bg-white p-4 rounded shadow">
                                <div class="form-group">
                                    <label for="current_password">Current Password</label>
                                    <input type="password" name="current_password" id="current_password" class="form-control" required>
                                </div>

                                <div class="form-group">
                                    <label for="new_password">New Password</label>
                                    <input type="password" name="new_password" id="new_password" class="form-control" required>
                                </div>

                                <div class="form-group">
                                    <label for="confirm_password">Confirm New Password</label>
                                    <input type="password" name="confirm_password" id="confirm_password" class="form-control" required>
                                </div>

                                <div class="text-right">
                                    <button type="submit" class="btn btn-primary mt-3">Change Password</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /Page Wrapper -->
</div>

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
