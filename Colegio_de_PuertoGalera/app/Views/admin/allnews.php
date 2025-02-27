<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <title>Admin</title>
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
    <!-- topbar -->
    <?= $this->include('include/topbar.php') ?>

    <!-- sidebar -->
    <?= $this->include('include/sidebar.php') ?>

    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <div class="mt-5">
                            <h4 class="card-title float-left mt-2">News List</h4>
                            <a href="/addnews" class="btn btn-primary float-right veiwbutton">Add News</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card card-table">
                        <div class="card-body booking_card">
                            <div class="table-responsive">
                                <table class="datatable table table-striped table-hover table-center mb-0">
                                    <thead>
                                        <tr>
                                            <th>Title</th>
                                            <th>Date Published</th>
                                            <th>Author</th>
                                            <th>Content</th>
                                            <th>Image</th>
                                            <th class="text-right">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($news as $newsItem) : ?>
                                            <tr>
                                                <td><?= $newsItem['title'] ?></td>
                                                <td><?= $newsItem['date_published'] ?></td>
                                                <td><?= $newsItem['author'] ?></td>
                                                <td><?= $newsItem['content'] ?></td>
                                                <td>
                                                    <img src="<?= base_url('uploads/' . $newsItem['image_url']) ?>" alt="News Image" style="max-width: 100px; max-height: 100px;">
                                                </td>
                                                <td class="text-right">
												<div class="dropdown dropdown-action"> <a href="" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fas fa-ellipsis-v ellipse_color"></i></a>
													<div class="dropdown-menu dropdown-menu-right"> <a class="dropdown-item" href=""><i class=""></i></a> 
                                                    <a class="dropdown-item" href="<?= base_url('/newsedit' . $newsItem['id']) ?>">
                                                    <i class="fas fa-pencil-alt m-r-5"></i> Edit
                                                </a>
                                               <a class="dropdown-item" href="<?= base_url('/deletenews' . $newsItem['id']) ?>" onclick="return confirm('Are you sure you want to delete this news?');"><i class="fas fa-trash-alt m-r-5"></i> Delete</a>
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
</body>

</html>
