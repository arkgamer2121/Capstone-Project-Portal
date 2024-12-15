<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <title>Admin Dashboard</title>
    <link rel="shortcut icon" type="image/x-icon" href="assets/images/icon/colegiologo.png">
    <link rel="stylesheet" href="assets1/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets1/plugins/fontawesome/css/fontawesome.min.css">
    <link rel="stylesheet" href="assets1/plugins/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="assets1/css/feathericon.min.css">
    <link rel="stylesheet" href="assets1/plugins/morris/morris.css">
    <link rel="stylesheet" type="text/css" href="assets1/css/bootstrap-datetimepicker.min.css">
    <link rel="stylesheet" href="assets1/css/style.css">
	<link href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.min.css" rel="stylesheet">
	 <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
	 
    

    <style>
        .teacher-image {
            width: 50px; /* Adjust the width as needed */
            height: 50px; /* Adjust the height as needed */
            object-fit: cover; /* Ensures the image fills the specified dimensions without stretching */
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


    <!-- topbar -->
   

    <!-- sidebar -->
    <?= $this->include('include/sidebar.php') ?>
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header">
                <div class="row">
                    <div class="col-sm-12 mt-5">
                        <h3 class="page-title mt-3">Good Day Administrator!</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ul>
                    </div>
                </div>
            </div>
<div class="row">
    <div class="col-xl-3 col-sm-6 col-12">
        <div class="card board1 fill">
            <div class="card-body">
                <div class="dash-widget-header">
                    <div>
                        <h3 class="card_widget_header"><?= $totalTeachers ?></h3>
                        <h6 class="text-muted">Total Teachers</h6>
                    </div>
                    <div class="ml-auto mt-md-3 mt-lg-0">
                        <span class="opacity-7 text-muted">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewbox="0 0 24 24" fill="none" stroke="#009688" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user-plus">
                                <path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                                <circle cx="8.5" cy="7" r="4"></circle>
                                <line x1="20" y1="8" x2="20" y2="14"></line>
                                <line x1="23" y1="11" x2="17" y2="11"></line>
                            </svg>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Total Users section -->
    <div class="col-xl-3 col-sm-6 col-12">
        <div class="card board1 fill">
            <div class="card-body">
                <div class="dash-widget-header">
                    <div>
                        <h3 class="card_widget_header"><?= $totalUser ?></h3>
                        <h6 class="text-muted">Total Users</h6>
                    </div>
                    <div class="ml-auto mt-md-3 mt-lg-0">
                        <span class="opacity-7 text-muted">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewbox="0 0 24 24" fill="none" stroke="#009688" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-users">
                                <path d="M17 21v-2a4 4 0 0 0-4-4H7a4 4 0 0 0-4 4v2"></path>
                                <circle cx="9" cy="7" r="4"></circle>
                                <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                                <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                            </svg>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-sm-6 col-12">
        <div class="card board1 fill">
            <div class="card-body">
                <div class="dash-widget-header">
                    <div>
                        <h3 class="card_widget_header"><?= $totalSubjects ?></h3>
                        <h6 class="text-muted">Subjects</h6>
                    </div>
                    <div class="ml-auto mt-md-3 mt-lg-0">
                        <span class="opacity-7 text-muted">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#009688" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-book">
                                <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2z"></path>
                                <line x1="19" y1="5" x2="5" y2="5"></line>
                                <line x1="19" y1="3" x2="5" y2="3"></line>
                            </svg>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-sm-6 col-12">
        <div class="card board1 fill">
            <div class="card-body">
                <div class="dash-widget-header">
                    <div>
                        <h3 class="card_widget_header"><?= $totalEvents ?></h3>
                        <h6 class="text-muted">Total Events</h6>
                    </div>
                    <div class="ml-auto mt-md-3 mt-lg-0">
                        <span class="opacity-7 text-muted">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewbox="0 0 24 24" fill="none" stroke="#009688" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-plus">
                                <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                                <polyline points="14 2 14 8 20 8"></polyline>
                                <line x1="12" y1="18" x2="12" y2="12"></line>
                                <line x1="9" y1="15" x2="15" y2="15"></line>
                            </svg>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-sm-6 col-12">
        <div class="card board1 fill">
            <div class="card-body">
                <div class="dash-widget-header">
                    <div>
                        <h3 class="card_widget_header"><?= $totalNews ?></h3>
                        <h6 class="text-muted">Total News</h6>
                    </div>
                    <div class="ml-auto mt-md-3 mt-lg-0">
                        <span class="opacity-7 text-muted">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewbox="0 0 24 24" fill="none" stroke="#009688" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-globe">
                                <circle cx="12" cy="12" r="10"></circle>
                                <line x1="2" y1="12" x2="22" y2="12"></line>
                                <path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"></path>
                            </svg>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

            <div class="row">
                <div class="col-md-12 col-lg-6">
                    <div class="card card-chart">
                         <div class="card-header">
                            <h4 class="card-title">Number of Visitors</h4>
                        </div>
                        <div class="card-body">
                            <canvas id="liveVisitorsChart"></canvas>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 col-lg-6">
                    <div class="card card-chart">
                        <div class="card-header">
                            <h4 class="card-title">CDPG DATA</h4>
                        </div>
                        <div class="card-body">
                            <div id="donut-chart"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 d-flex">
                    <div class="card card-table flex-fill">
                        <div class="card-header">
                            <h4 class="card-title float-left mt-2">Teacher Details</h4>
                            <a href="<?= site_url('/allteachers') ?>" class="btn btn-primary float-right view-button">View All</a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover table-center">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Designation</th>
                                            <th>Description</th>
                                            <th>Image</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($teachers as $teacher): ?>
                                            <tr>
                                                <td><?= $teacher['name'] ?></td>
                                                <td><?= $teacher['designation'] ?></td>
                                                <td><?= $teacher['description'] ?></td>
												<td>
												<a href="<?= base_url('uploads/' . $teacher['image']) ?>" data-lightbox="teacher-image" data-title="<?= $teacher['name'] ?>">
												<img src="<?= base_url('uploads/' . $teacher['image']) ?>" alt="<?= $teacher['name'] ?>" class="teacher-image">
												</a>
											</td>

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
    
    <script src="https://cdn.jsdelivr.net/npm/moment@2.29.1"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-adapter-moment@1.0.0"></script>


    <script src="assets1/js/jquery-3.5.1.min.js"></script>
    <script src="assets1/js/popper.min.js"></script>
    <script src="assets1/js/bootstrap.min.js"></script>
    <script src="assets1/js/moment.min.js"></script>
    <script src="assets1/plugins/slimscroll/jquery.slimscroll.min.js"></script>
    <script src="assets1/js/bootstrap-datetimepicker.min.js"></script>

    
    <script>
        $(function() {
            $('#datetimepicker3').datetimepicker({
                format: 'LT'
            });
        });
    </script>

    

    <script src="assets1/js/jquery-3.5.1.min.js"></script>
	<script src="assets1/plugins/slimscroll/jquery.slimscroll.min.js"></script>
    <script src="assets1/plugins/raphael/raphael.min.js"></script>
    <script src="assets1/plugins/morris/morris.min.js"></script>
    <script src="assets1/js/chart.morris.js"></script>
    <script src="assets1/js/script.js"></script>
    


 <script>
        let myChart; // Declare chart variable in a broader scope

        function fetchLiveVisitors() {
            fetch('analytics/live-visitors') // This should match your route
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(data => {
                    console.log(data); // Log the data to see its structure
                    if (data.dates && data.visitors) {
                        updateChart(data.dates, data.visitors); // Pass dates and visitor counts to the chart update function
                    } else {
                        console.error('Visitor count or dates not found in response:', data);
                    }
                })
                .catch(error => {
                    console.error('Error fetching live visitors:', error);
                });
        }

        function updateChart(dates, visitors) {
            const ctx = document.getElementById('liveVisitorsChart').getContext('2d');
            const chartData = {
                labels: dates, // Use the dates for the x-axis labels
                datasets: [{
                    label: 'Visitors',
                    data: visitors, // Use the visitors for the y-axis data
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1,
                    fill: false
                }]
            };

            // Create the chart if it doesn't exist, or update it
            if (!myChart) {
                myChart = new Chart(ctx, {
                    type: 'line',
                    data: chartData,
                    options: {
                        responsive: true,
                        scales: {
                            y: {
                                beginAtZero: true
                            },
                            x: {
                                type: 'time', // Use time scale for the x-axis
                                time: {
                                    unit: 'day' // Show lines for each day
                                }
                            }
                        }
                    }
                });
            } else {
                myChart.data.labels = dates; // Update the labels to the new dates
                myChart.data.datasets[0].data = visitors; // Update the dataset to the new visitor counts
                myChart.update(); // Update the chart with new data
            }
        }

        // Fetch the data initially and set interval for updates
        document.addEventListener('DOMContentLoaded', function() {
            fetchLiveVisitors();
            setInterval(fetchLiveVisitors, 5000); // Fetch data every 5 seconds
        });
    </script>

    







    <script>
        $(document).ready(function(){
          
            donutChart();
            pieChart();
            $(window).resize(function(){
               
                window.donutChart.redraw();
                window.pieChart.redraw();
            });
        });

  

        function donutChart(){
            var totalSubjects = <?= $totalSubjects ?>;
            var totalTeachers = <?= $totalTeachers ?>;
            var totalEvents = <?= $totalEvents ?>;
            var totalNews = <?= $totalNews ?>;
            var totalUser = <?= $totalUser ?>;
            
            window.donutChart = Morris.Donut({
                element: 'donut-chart',
                data: [
                    { label: "Subjects", value: totalSubjects },
                    { label: "Teachers", value: totalTeachers },
                    { label: "Events", value: totalEvents },
                    { label: "News", value: totalNews },
                    { label: "User", value: totalUser }
                ],
                backgroundColor: '#f2f5fa',
                labelColor: '#009688',
                colors: ['#0BA462', '#39B580', '#67C69D', '#95D7BB'],
                resize: true,
                redraw: true
            });
        }

        function pieChart(){
            var paper = Raphael("pie-chart");
            paper.piechart(100, 100, 90, [18.373, 18.686, 2.867, 23.991, 9.592, 0.213], {
                legend: ["Windows/Windows Live", "Server/Tools", "Online Services", "Business", "Entertainment/Devices", "Unallocated/Other"]
            });
        }
    </script>
</body>
</html>
