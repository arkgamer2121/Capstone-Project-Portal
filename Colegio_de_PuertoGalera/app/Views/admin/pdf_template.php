<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>PDF Preview</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        h1, h4 {
            text-align: center;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed; /* Ensures the table adjusts and prevents overflow */
            word-wrap: break-word;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 8px;
            text-align: left;
            font-size: 12px; /* Reduce font size for better fit */
            word-break: break-word; /* Break long words to avoid overflow */
        }
        .section-title {
            font-weight: bold;
            margin-top: 20px;
            margin-bottom: 10px;
        }
        .faculty-details p {
            margin: 5px 0;
        }
        /* Ensuring the table fits within the page and avoids overflow */
        .table-container {
            overflow-x: auto;
            max-width: 100%;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <!-- Faculty Details Section -->
    <div class="section-title">Faculty Details</div>
    <div class="faculty-details">
        <?php if (!empty($faculty)): ?>
            <p><strong>ID No:</strong> <?= esc($faculty['id_no']) ?></p>
            <p><strong>Last Name:</strong> <?= esc($faculty['last_name']) ?></p>
            <p><strong>First Name:</strong> <?= esc($faculty['first_name']) ?></p>
            <p><strong>Middle Name:</strong> <?= esc($faculty['middle_name']) ?></p>
            <p><strong>Email:</strong> <?= esc($faculty['email']) ?></p>
            <p><strong>Contact:</strong> <?= esc($faculty['contact']) ?></p>
            <p><strong>Gender:</strong> <?= esc($faculty['gender']) ?></p>
            <p><strong>Address:</strong> <?= esc($faculty['address']) ?></p>
        <?php else: ?>
            <p>No faculty details available.</p>
        <?php endif; ?>
    </div>

    <!-- Schedule Details Section -->
    <div class="section-title">Schedule Details</div>
    <div class="table-container">
        <table class="table">
            <thead>
                <tr>
                    <th>Day</th>
                    <th>Subject Code</th>
                    <th>Subject</th>
                    <th>Year</th>
                    <th>Course</th>
                    <th>Section</th>
                    <th>Time</th>
                    <th>Room</th>
                    <th>Semester</th>
                    <th>Description</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($schedules)): ?>
                    <?php foreach ($schedules as $schedule): ?>
                        <?php $days = explode(",", $schedule['days_of_week']); ?>
                        <?php foreach ($days as $day): ?>
                            <tr>
                                <td><?= esc(trim($day)) ?></td>
                                <td><?= esc($schedule['subject_code']) ?></td>
                                <td><?= esc($schedule['subject']) ?></td>
                                <td><?= esc($schedule['year']) ?></td>
                                <td><?= esc($schedule['course']) ?></td>
                                <td><?= esc($schedule['section']) ?></td>
                                <td><?= esc($schedule['time_from']) ?> - <?= esc($schedule['time_to']) ?></td>
                                <td><?= esc($schedule['room']) ?></td>
                                <td><?= esc($schedule['sem']) ?></td>
                                <td><?= esc($schedule['description']) ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="11">No schedule details found.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
