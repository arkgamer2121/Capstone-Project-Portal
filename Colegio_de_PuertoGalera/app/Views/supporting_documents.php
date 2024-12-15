<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Supporting Documents</title>
    <!-- Bootstrap 4 CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <style>
 body {
            background-color: #f8f9fa;
            color: #343a40;
        }

        .navbar {
            padding: 0.5rem 1rem;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .navbar-brand {
            font-size: 1.5rem;
            font-weight: 600;
        }

        /* Simplified Modal */
        .modal-content {
            border-radius: 10px;
            border: none;
            box-shadow: none;
            background-color: #f8f9fa;
        }

        /* Minimalist Card Design */
        .card {
            border-radius: 8px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            border: 1px solid #dee2e6;
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .card:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .card-header {
            background-color: dark;
            font-weight: 500;
            border-bottom: 1px solid #dee2e6;
        }

        .sidebar {
        transition: all 0.3s ease; /* Smooth transition */
        background-image: url('assets/images/icon/sideabar12.jpg'); /* Replace with the actual path to your image */
        background-size: cover; /* Ensures the image covers the entire sidebar */
        background-position: center; /* Centers the image */
        background-repeat: no-repeat; /* Prevents the image from repeating */
        width: 250px;
        height: 100vh;
        position: fixed;
        top: 0;
        left: 0;
        padding: 1rem;
        overflow-y: auto;
        transition: all 0.3s ease;
    }
    
    .sidebar img {
        border: 2px solid darkgray; /* Profile picture border */
    }
    
    .nav-link1 {
        font-size: 16px; /* Larger font size for better readability */
        color: black; /* Darker color for text */
        padding: 0.75rem 1rem; /* Increased padding */
        transition: background-color 0.3s ease; /* Smooth hover effect */
        border-radius: 5px; /* Slightly rounded corners */
    }

    .nav-link1:hover {
        background-color: white; /* Light background on hover */
        color: violet; /* Change text color on hover */
    }

    .nav-link1.active {
        background-color: violet; /* Active link color */
        color: white; /* Text color for active link */
    }

    .nav-link1.active:hover {
        background-color: darkviolet; /* Darker shade for active link on hover */
    }

        .icon-circle {
            width: 35px;
            height: 35px;
            background-color: violet; /* Circle background color */
            border-radius: 50%; /* Make it circular */
            display: flex;
            align-items: center;
            justify-content: center;
            color: white; /* Icon color */
            font-size: 1.25rem; /* Icon size */
        }

        .content {
            margin-left: 270px;
            padding: 2rem;
        }

        /* Dark Mode Styles */
        body.dark-theme {
            background-color: #343a40;
            color: #f8f9fa;
        }

        .modal-content.dark-theme {
            background-color: #343a40;
            color: #f8f9fa;
        }

        /* Dark Theme Form Elements */
        .modal-content.dark-theme .btn-outline-primary {
            border-color: #f8f9fa;
            color: #f8f9fa;
        }

        .modal-content.dark-theme .btn-outline-primary:hover {
            background-color: #f8f9fa;
            color: #343a40;
        }

        .rounded-circle {
            border: 2px solid #dee2e6;
        }
        .text-primary {
        color: #007bff; 
        transition: color 0.3s ease; 
        }
        .text-primary:hover {
            color: #0056b3;
            cursor: pointer; 
        }

        </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg bg-light">
    <div class="container d-flex justify-content-between align-items-center">
        <a class="navbar-brand" href="#">Profile</a>
        <ul class="navbar-nav ms-auto">
            <li class="nav-item">
                <a class="nav-link1" href="#" data-bs-toggle="modal" data-bs-target="#minimalistModal">
                    <i class="bi bi-person-circle"></i>
                </a>
            </li>
             <!-- Notification Dropdown -->
             <li class="nav-item dropdown noti-dropdown">
                <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
                    <i class="fe fe-bell"></i> 
                    <span class="badge badge-pill">3</span> <!-- Notification Count -->
                </a>
                <div class="dropdown-menu notifications">
                    <div class="topnav-dropdown-header"> 
                        <span class="notification-title">Notifications</span> 
                        <a href="javascript:void(0)" class="clear-noti">Clear All</a>
                    </div>
                    <div class="noti-content">
                        <ul class="notification-list">
                            <!-- Notification Item 1 -->
                            <li class="notification-message">
                                <a href="#">
                                    <div class="media"> 
                                        <span class="avatar avatar-sm">
                                            <img class="avatar-img rounded-circle" alt="User Image" src="assets/img/profiles/avatar-02.jpg">
                                        </span>
                                        <div class="media-body">
                                            <p class="noti-details">
                                                <span class="noti-title">Carlson Tech</span> has approved 
                                                <span class="noti-title">your estimate</span>
                                            </p>
                                            <p class="noti-time"><span class="notification-time">4 mins ago</span></p>
                                        </div>
                                    </div>
                                </a>
                            </li>
            <li class="nav-item">
                <a class="nav-link1" href="/logout"><i class="bi bi-power"></i></a>
            </li>
        </ul>
    </div>
</nav>


<div class="sidebar bg-light shadow" style="width: 250px; height: 100vh; position: fixed; top: 0; left: 0; padding: 1rem; overflow-y: auto;">
    <div class="text-center mb-4">
    <img src="<?= isset($profile_picture) ? $profile_picture : 'default-profile.png' ?>" id="profile-logo" alt="Profile Logo" class="rounded-circle mt-2" style="width: 80px; height: 80px;">
    <h5 id="username" class="mt-2"><?= esc($name) ?></h5>
        
    </div>

    <nav class="nav flex-column">
        <a class="nav-link1" href="/profile">
            <div class="d-flex align-items-center">
                <div class="icon-circle me-2"><i class="fas fa-user"></i></div>
                <span>Profile</span>
            </div>
        </a>
        <a class="nav-link1" href="/request">
    <div class="d-flex align-items-center">
        <div class="icon-circle me-2"><i class="fas fa-paper-plane"></i></div> <!-- Updated icon -->
        <span>Request</span>
    </div>
</a>

        <a class="nav-link1" href="/supporting-documents">
            <div class="d-flex align-items-center">
                <div class="icon-circle me-2"><i class="fas fa-file-alt"></i></div>
                <span>Documents</span>
            </div>
        </a>
        <a class="nav-link1" href="/change-password">
            <div class="d-flex align-items-center">
                <div class="icon-circle me-2"><i class="fas fa-key"></i></div>
                <span>Change Password</span>
            </div>
        </a>
        <a class="nav-link1" href="/notifications">
            <div class="d-flex align-items-center">
                <div class="icon-circle me-2"><i class="fas fa-bell"></i></div>
                <span>Notifications</span>
            </div>
        </a>
        <a class="nav-link1" href="#">
            <div class="d-flex align-items-center">
                <div class="icon-circle me-2"><i class="fas fa-cog"></i></div>
                <span>Settings</span>
            </div>
        </a>
        <a class="nav-link1" href="/">
            <div class="d-flex align-items-center">
                <div class="icon-circle me-2"><i class="fas fa-sign-out-alt"></i></div>
                <span>Sign Out</span>
            </div>
        </a>
    </nav>
</div>

<!-- Main Content -->
<div class="content">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            
        <h6 style="color: violet;">Documents</h6>

            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#uploadModal">
                <i class="fas fa-upload"></i> Upload Document
            </button>
        </div>

        <!-- Display Validation Errors -->
        <?php if (session()->getFlashdata('errors')): ?>
            <div class="alert alert-danger mt-3">
                <?php foreach (session()->getFlashdata('errors') as $error): ?>
                    <p><?= esc($error); ?></p>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <!-- Modal for Uploading Document -->
        <div class="modal fade" id="uploadModal" tabindex="-1" role="dialog" aria-labelledby="uploadModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="uploadModalLabel">Upload Supporting Documents</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="<?= base_url('supporting-documents/upload'); ?>" method="POST" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="type">Document Type</label>
                                <select name="type" class="form-control" required>
                                    <option value="">Select Document</option>
                                    <option value="Report">Report</option>
                                    <option value="Invoice">Invoice</option>
                                    <option value="Proposal">Proposal</option>
                                    <!-- Add more options as needed -->
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="title">Document Title</label>
                                <input type="text" name="title" class="form-control" placeholder="Short title" required>
                            </div>
                            <div class="form-group">
                                <label for="file">Choose file to upload (PNG, JPG, PDF, DOCX)</label>
                                <input type="file" name="file" class="form-control-file" accept=".png,.jpg,.jpeg,.pdf,.docx" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Upload Document</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Document Table -->
        <div class="card mt-4">
            <div class="card-header">
                <h5 class="mb-0">Data</h5>
            </div>
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Type</th>
                            <th>Title</th>
                            <th>Date Uploaded</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($documents)): ?>
                            <?php foreach ($documents as $document): ?>
                                <tr>
                                    <td><?= esc($document['id']); ?></td>
                                    <td><?= esc($document['type']); ?></td>
                                    <td><?= esc($document['title']); ?></td>
                                    <td><?= esc($document['date_uploaded']); ?></td>
                                    <td><?= esc($document['status']); ?></td>
                                    <td>
                                        <a href="<?= base_url('supporting-documents/view/'.$document['id']); ?>" class="btn btn-sm btn-info">View</a>
                                        <a href="<?= base_url('supporting-documents/delete/'.$document['id']); ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this document?');">Delete</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="6" class="text-center">No documents uploaded yet.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


<!-- Bootstrap 4 JS and dependencies -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
