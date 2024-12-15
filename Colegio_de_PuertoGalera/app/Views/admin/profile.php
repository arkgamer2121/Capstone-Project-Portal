<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <title>Admin</title>
    <link rel="shortcut icon" type="image/x-icon" href="<?= base_url('assets/images/icon/colegiologo.png'); ?>">
    <link rel="stylesheet" href="<?= base_url('assets1/css/bootstrap.min.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('assets1/plugins/fontawesome/css/fontawesome.min.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('assets1/plugins/fontawesome/css/all.min.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('assets1/css/feathericon.min.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('assets1/plugins/morris/morris.css'); ?>">
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets1/css/bootstrap-datetimepicker.min.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('assets1/css/style.css'); ?>">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.min.css" rel="stylesheet">

    <style>
        .round-circle {
    border-radius: 50%; /* Ensure the image is circular */
    object-fit: cover; /* Cover the entire area while maintaining aspect ratio */
    width: 200px; /* Set width */
    height: 200px; /* Set height */
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
				<a href="/dashboard" class="logo"> <img src="<?= base_url('assets/images/icon/colegiologo.png'); ?>" width="50" height="70" alt="logo"> <span class="logoclass">CDPG</span> </a>
				<a href="/dashboard" class="logo logo-small"> <img src="<?= base_url('assets/images/icon/colegiologo.png'); ?>" alt="Logo" width="30" height="30"> </a>
			</div>
			<a href="javascript:void(0);" id="toggle_btn"> <i class="fe fe-text-align-left"></i> </a>
			<a class="mobile_btn" id="mobile_btn"> <i class="fas fa-bars"></i> </a>
			<ul class="nav user-menu">
            <li class="nav-item dropdown noti-dropdown">
                <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
                    <i class="fe fe-bell"></i>
                    <span class="badge badge-pill"><?= count($notifications) ?></span> <!-- Dynamic count -->
                </a>
                <div class="dropdown-menu notifications">
                    <div class="topnav-dropdown-header">
                        <span class="notification-title">Notifications</span>
                        <a href="javascript:void(0)" class="clear-noti">Clear All</a>
                    </div>
                    <div class="noti-content">
                    <ul class="notification-list">
    <?php if (!empty($notifications)): ?>
        <?php foreach ($notifications as $notification): ?>
            <li class="notification-message">
                <a href="#">
                    <div class="media">
                        <span class="avatar avatar-sm">
                            <img class="avatar-img rounded-circle" alt="User Image" src="assets/img/profiles/default-avatar.jpg">
                        </span>
                        <div class="media-body">
                            <p class="noti-details">
                                <span class="noti-title"><?= isset($notification['message']) ? $notification['message'] : 'No message available' ?></span>
                            </p>
                            <p class="noti-time">
                                <span class="notification-time"><?= time_elapsed_string($notification['created_at']) ?></span>
                            </p>
                        </div>
                    </div>
                </a>
            </li>
        <?php endforeach; ?>
    <?php else: ?>
        <li class="notification-message">
            <div class="media">
                <div class="media-body">
                    <p class="noti-details">No new notifications.</p>
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
            <img class="rounded-circle" 
			src="<?= base_url('assets/images/icon/colegiologo.png'); ?>"

                 width="31" 
                 >
        </span>
    </a>
    <div class="dropdown-menu">
       
        <a class="dropdown-item" href="admin/profile/1">My Profile</a>
        <a class="dropdown-item" href="settings.html">Account Settings</a>
        <a class="dropdown-item" href="login.html">Logout</a>
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


    <?= $this->include('include/sidebar.php') ?>

    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header mt-5">
                <div class="row">
                    <div class="col">
                        <h3 class="page-title">Profile</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                            <li class="breadcrumb-item active">Profile</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="profile-header">
                        <div class="row align-items-center">
                            <div class="col-auto profile-image">
                            <a href="#" data-toggle="modal" data-target="#upload_profile_picture">
    <img class="round-circle" alt="User Image" src="<?= base_url('assets/img/profiles/' . esc($adminProfile['user_image'])); ?>">
</a>


<h4 class="user-name mb-3"><?= esc($adminProfile['name']); ?></h4>
<h6 class="text-muted mt-1"><?= esc($adminProfile['designation']); ?></h6>
<div class="user-location mt-1"><i class="fas fa-map-marker-alt"></i> <?= esc($adminProfile['location']); ?></div>
<div class="about-text"><?= esc($adminProfile['description']); ?></div>

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
                        <div class="row mt-5">
                            <p class="col-sm-3 text-sm-right mb-0 mb-sm-3">Name</p>
                            <p class="col-sm-9"><?= esc($adminProfile['name']); ?></p>
                        </div>
                        <div class="row">
                            <p class="col-sm-3 text-sm-right mb-0 mb-sm-3">Date of Birth</p>
                            <p class="col-sm-9"><?= esc($adminProfile['date_of_birth']); ?></p>
                        </div>
                        <div class="row">
                            <p class="col-sm-3 text-sm-right mb-0 mb-sm-3">Email ID</p>
                            <p class="col-sm-9">
                                <a href="mailto:<?= esc($adminProfile['email']); ?>"><?= esc($adminProfile['email']); ?></a>
                            </p>
                        </div>
                        <div class="row">
                            <p class="col-sm-3 text-sm-right mb-0 mb-sm-3">Mobile</p>
                            <p class="col-sm-9"><?= esc($adminProfile['mobile']); ?></p>
                        </div>
                        <div class="row">
                            <p class="col-sm-3 text-sm-right mb-0">Address</p>
                            <p class="col-sm-9 mb-0"><?= esc($adminProfile['address']); ?></p>
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
                            <img class="rounded-circle" alt="User Image" src="<?= base_url('assets/img/profiles/' . esc($adminProfile['user_image'])); ?>" width="150" height="150">
                        </a>
                        <form method="POST" action="<?= base_url('admin/uploadProfilePicture') ?>" enctype="multipart/form-data">
                            <input type="hidden" name="id" value="<?= esc($adminProfile['id']); ?>">
                            <div class="form-group">
                                <label for="profile_picture">Upload New Profile Picture</label>
                                <input type="file" name="profile_picture" class="form-control-file" id="profile_picture" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Upload</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


                        
                        <div id="password_tab" class="tab-pane fade">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">Change Password</h5>
                                    <form>
                                        <div class="form-group">
                                            <label>Old Password</label>
                                            <input type="password" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label>New Password</label>
                                            <input type="password" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label>Confirm Password</label>
                                            <input type="password" class="form-control">
                                        </div>
                                        <button class="btn btn-primary" type="submit">Save Changes</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Personal Details Modal -->
<!-- Edit Personal Details Modal -->
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
                <form method="POST" action="<?= base_url('admin/updateProfile') ?>">
                    <div class="row form-row">
                        <!-- Name Field -->
                        <div class="col-12">
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" name="name" class="form-control" value="<?= esc($adminProfile['name']); ?>" required>
                            </div>
                        </div>

                        <!-- Date of Birth Field -->
                        <div class="col-12">
                            <div class="form-group">
                                <label>Date of Birth</label>
                                <div class="cal-icon">
                                    <input type="date" name="date_of_birth" class="form-control" value="<?= esc($adminProfile['date_of_birth']); ?>" required>
                                </div>
                            </div>
                        </div>

                        <!-- Email ID Field -->
                        <div class="col-12">
                            <div class="form-group">
                                <label>Email ID</label>
                                <input type="email" name="email" class="form-control" value="<?= esc($adminProfile['email']); ?>" required>
                            </div>
                        </div>

                        <!-- Mobile Field -->
                        <div class="col-12">
                            <div class="form-group">
                                <label>Mobile</label>
                                <input type="text" name="mobile" class="form-control" value="<?= esc($adminProfile['mobile']); ?>" required>
                            </div>
                        </div>

                        <!-- Address Field -->
                        <div class="col-12">
                            <div class="form-group">
                                <label>Address</label>
                                <input type="text" name="address" class="form-control" value="<?= esc($adminProfile['address']); ?>" required>
                            </div>
                        </div>
                    </div>

                    <!-- Save Changes Button -->
                    <button type="submit" class="btn btn-primary btn-block">Save Changes</button>
                </form>
            </div>
        </div>
    </div>
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
