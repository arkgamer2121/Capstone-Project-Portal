<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>File List</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/css/bootstrap.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>
    <style>
        body {
            background-color: #f8f9fa;
            color: #343a40;
        }
        .container {
            margin-top: 50px;
        }
        table {
            background-color: #ffffff;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        th {
            background-color: #007bff;
            color: white;
        }
        .btn-primary {
            background-color: #007bff;
            border: none;
        }
        .btn-primary:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="text-center mb-4">Pre Registration</h1>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Path</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($files)): ?>
                    <?php foreach ($files as $file): ?>
                        <tr>
                            <td><?= $file['id']; ?></td>
                            <td><?= $file['name']; ?></td>
                            <td><?= $file['path']; ?></td>
                            <td>
                                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#qrCodeModal" 
                                        data-id="<?= $file['id']; ?>" 
                                        data-name="<?= $file['name']; ?>">Send QR Code</button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5" class="text-center">No files found</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
        <a href="/files/upload" class="btn btn-success">Upload a new file</a>

        <!-- QR Code Modal -->
        <div class="modal fade" id="qrCodeModal" tabindex="-1" aria-labelledby="qrCodeModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="qrCodeModalLabel">Send QR Code</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>Send QR Code for: <span id="fileName"></span></p>
                        <form action="<?= base_url('files/send_qr') ?>" method="post">
                            <input type="hidden" name="file_id" id="fileId" value="">
                            <div class="mb-3">
                                <label for="recipientEmail" class="form-label">Recipient Email</label>
                                <input type="email" class="form-control" id="recipientEmail" name="recipient_email" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Send QR Code</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <script>
            // Bootstrap modal event
            var qrCodeModal = document.getElementById('qrCodeModal');
            qrCodeModal.addEventListener('show.bs.modal', function (event) {
                var button = event.relatedTarget; // Button that triggered the modal
                var fileId = button.getAttribute('data-id'); // Extract info from data-* attributes
                var fileName = button.getAttribute('data-name');

                // Update the modal's content
                var modalTitle = qrCodeModal.querySelector('.modal-title');
                var modalBodyInput = qrCodeModal.querySelector('#fileId');
                var fileNameDisplay = qrCodeModal.querySelector('#fileName');

                modalTitle.textContent = 'Send QR Code for ' + fileName;
                modalBodyInput.value = fileId;
                fileNameDisplay.textContent = fileName;
            });
        </script>
    </div>
</body>
</html>
