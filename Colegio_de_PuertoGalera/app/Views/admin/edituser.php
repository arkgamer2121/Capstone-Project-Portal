<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <title>Edit User</title>
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
                            <h4 class="card-title float-left mt-2">Edit User</h4>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="<?= base_url('/userupdate' . $user['id']) ?>" method="POST" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" class="form-control" name="name" value="<?= $user['name'] ?>" required>
                                </div>
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="email" class="form-control" name="email" value="<?= $user['email'] ?>" required>
                                </div>
                                <div class="form-group">
                                    <label>Verification Code</label>
                                    <input type="text" class="form-control" name="verification_code" value="<?= $user['verification_code'] ?>">
                                </div>
                                <div class="form-group">
                                    <label>Verified</label>
                                    <select class="form-control" name="verified">
                                        <option value="1" <?= $user['verified'] == 1 ? 'selected' : '' ?>>Yes</option>
                                        <option value="0" <?= $user['verified'] == 0 ? 'selected' : '' ?>>No</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Profile Picture</label>
                                    <input type="file" class="form-control" name="profile_picture">
                                    <?php if ($user['profile_picture']): ?>
                                        <img src="<?= base_url('uploads/' . $user['profile_picture']) ?>" alt="Profile Picture" style="max-width: 100px; max-height: 100px;">
                                    <?php endif; ?>
                                </div>
                                <div class="text-right">
                                    <button type="submit" class="btn btn-primary">Update User</button>
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
