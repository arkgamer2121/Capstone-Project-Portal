<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <title>Chat Box</title>
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
        .chat-box {
            border: 1px solid #ccc;
            height: 400px;
            overflow-y: scroll;
            padding: 10px;
        }
        .message {
            margin-bottom: 10px;
        }
        .user-message {
            color: blue;
        }
        .admin-message {
            color: green;
        }
    </style>
</head>

<body>
<div class="main-wrapper">
    <div class="header">
        <div class="header-left">
            <a href="/dashboard" class="logo">
                <img src="<?= isset($profile_picture) ? $profile_picture : 'default-profile.png' ?>" class="rounded-circle" alt="logo">
                <span class="logoclass"><?= isset($user['name']) ? esc($user['name']) : 'CDPG' ?></span>
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
                    <span class="badge badge-pill">0</span>
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
                <li> <a href="/request"><i class="bi bi-clipboard"></i> <span>Requirement Request</span></a> </li>
                <li> <a href="#"><i class="bi bi-file-earmark-text"></i> <span>Request Documents</span></a></li>
                <li> <a href="/chat"><i class="bi bi-chat-dots"></i> <span>Chatter</span></a> </li>
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


    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header mt-5">
                <div class="row">
                    <div class="col">
                        <h3 class="page-title text-center">Chat Box</h3>
                    </div>
                </div>
            </div>

            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-body">

                            <!-- Chat Box -->
                            <div class="chat-box">
                                <?php foreach ($messages as $message): ?>
                                    <div class="message <?= esc($message['type']) === 'admin' ? 'admin-message' : 'user-message'; ?>">
                                        <strong><?= esc($message['sender']); ?>:</strong>
                                        <p><?= esc($message['message']); ?></p>
                                        <small><?= esc($message['timestamp']); ?></small>
                                    </div>
                                <?php endforeach; ?>
                            </div>

                            <!-- Message Input Form -->
                            <form action="/chat/send" method="post" class="mt-3">
                                <div class="form-group">
                                    <input type="text" name="sender" placeholder="Your Name" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <textarea name="message" placeholder="Type your message here..." class="form-control" required></textarea>
                                </div>
                                <button type="submit" class="btn btn-primary">Send</button>
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
    <script>
    $(document).ready(function() {
        $('form').submit(function(event) {
            event.preventDefault(); // Prevent the default form submission

            $.ajax({
                url: $(this).attr('action'),
                method: 'POST',
                data: $(this).serialize(),
                success: function(data) {
                    // Assuming your server returns the updated messages
                    $('.chat-box').empty(); // Clear the chat box
                    data.messages.forEach(function(message) {
                        $('.chat-box').append(
                            '<div class="message ' + (message.type === 'admin' ? 'admin-message' : 'user-message') + '"><strong>' + message.sender + ':</strong><p>' + message.message + '</p><small>' + message.timestamp + '</small></div>'
                        );
                    });
                }
            });
        });
    });
    </script>

</body>

</html>
