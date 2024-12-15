<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Application Requirements</title>
</head>
<body>

<h2>Add Application Requirement</h2>

<?php if(session()->getFlashdata('success')): ?>
    <p style="color:green;"><?= session()->getFlashdata('success') ?></p>
<?php endif; ?>

<?php if(session()->getFlashdata('error')): ?>
    <p style="color:red;"><?= session()->getFlashdata('error') ?></p>
<?php endif; ?>

<form action="<?= base_url('/requirements/store') ?>" method="post">
    <label for="requirement">Select Requirement:</label>
    <select name="requirement" id="requirement" required>
        <option value="Certificate of Registration">Certificate of Registration</option>
        <option value="Certificate of Grades">Certificate of Grades</option>
        <option value="Certificate of Enrollment">Certificate of Enrollment</option>
        <option value="Student ID">Student ID</option>
    </select>
    <br><br>
    <button type="submit">Submit</button>
</form>

</body>
</html>
