<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <title>Edit News</title>
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
                            <h4 class="card-title float-left mt-2">Edit News</h4>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="<?= base_url('/newsupdate' . $news['id']) ?>" method="POST" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label>Title</label>
                                    <input type="text" class="form-control" name="title" value="<?= $news['title'] ?>" required>
                                </div>
                                <div class="form-group">
                                    <label>Date Published</label>
                                    <input type="date" class="form-control" name="date_published" value="<?= $news['date_published'] ?>" required>
                                </div>
                                <div class="form-group">
                                    <label>Author</label>
                                    <input type="text" class="form-control" name="author" value="<?= $news['author'] ?>" required>
                                </div>
                                <div class="form-group">
                                    <label>Content</label>
                                    <textarea class="form-control" name="content" required><?= $news['content'] ?></textarea>
                                </div>
                                <div class="form-group">
                                    <label>Image</label>
                                    <input type="file" class="form-control" name="image">
                                    <?php if ($news['image_url']): ?>
                                        <img src="<?= base_url('uploads/' . $news['image_url']) ?>" alt="News Image" style="max-width: 100px; max-height: 100px;">
                                    <?php endif; ?>
                                </div>
                                <div class="text-right">
                                    <button type="submit" class="btn btn-primary">Update News</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
