<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
        <link rel="shortcut icon" type="image/x-icon" href="assets/images/icon/colegiologo.png">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <style>
        body {
            background: white;
            font-family: 'Roboto', sans-serif;
            background-image: url('/assets/images/icon/sideabar22.jpg');
            background-repeat: no-repeat;
            background-size: cover;
            background-position: center;
        }

        .container {
            margin-top: 30px;
        }

       .card {
            color: #999;
            border: none;
            border-radius: 30px;
            box-shadow: 0 25px 32px rgba(0, 0, 0, 0.1), 0 0 0 5px rgba(0, 0, 0, 0.1);
            padding: 30px;
            background-color: #fff;
            transition: background-color 0.3s ease;
        }

        .card h2 {
            color: #333;
            font-weight: bold;
            margin-top: 0;
            text-align: center;
        }

        .card .btn {
            border: none;
            border-radius: 30px;
            padding: 10px 0;
            font-size: 16px;
            font-weight: bold;
            color: #fff;
            min-width: 140px;
            transition: background-color 0.3s, transform 0.2s;
        }

        .card .btn:hover {
            transform: scale(1.05);
        }

        /* Error Message Styling */
        #error-message {
            color: red;
            font-size: 14px;
            display: block;
            margin-top: 10px;
            text-align: center;
        }

        /* Color Picker Button */
        .color-picker-btn {
            position: fixed;
            top: 20px;
            right: 20px;
            font-size: 24px;
            cursor: pointer;
            color: #19aa8d;
            transition: transform 0.2s;
        }

        .color-picker-btn:hover {
            transform: scale(1.1);
        }

        .color-options {
            display: none;
            position: absolute;
            right: 10px;
            top: 50px;
            background: #fff;
            padding: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            border-radius: 5px;
        }

        .color-options button {
            width: 30px;
            height: 30px;
            border: none;
            margin: 3px;
            cursor: pointer;
            border-radius: 50%;
            transition: opacity 0.2s;
        }

        .color-options button:hover {
            opacity: 0.8;
        }
    </style>
</head>
<body>
<div class="container d-flex flex-column">
    <div class="row align-items-center justify-content-center min-vh-100 g-0">
        <div class="col-12 col-md-8 col-lg-4">
            <div class="card shadow-sm" id="reset-password-card">
                <div class="card-body">
                    <div class="mb-4">
                        <h5>Reset Password</h5>
                        <p class="mb-2">Enter a new password to reset your account.</p>
                    </div>

                    <!-- Display error message if any -->
                    <?php if(session()->getFlashdata('error')): ?>
                        <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
                    <?php endif; ?>

                    <form action="/forgot_password/update" method="POST">
                        <div class="mb-3">
                            <label for="password" class="form-label">New Password</label>
                            <input type="password" id="password" class="form-control" name="password" placeholder="Enter new password" required="">
                        </div>
                        <div class="mb-3 d-grid">
                            <button type="submit" class="btn btn-success">Update Password</button>
                        </div>
                        <span>Remembered your password? <a href="/signin" class="signin-link">Sign in</a></span>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Color Picker Button -->
<i class="fa fa-paint-brush color-picker-btn" id="colorPickerIcon"></i>

<!-- Color Options -->
<div class="color-options" id="colorOptions">
    <button style="background: linear-gradient(45deg, #8e24aa, #ba68c8);" onclick="changeCardColor('linear-gradient(45deg, #8e24aa, #ba68c8)')"></button>
    <button style="background: linear-gradient(45deg, #1976d2, #64b5f6);" onclick="changeCardColor('linear-gradient(45deg, #1976d2, #64b5f6)')"></button>
    <button style="background: linear-gradient(45deg, #388e3c, #81c784);" onclick="changeCardColor('linear-gradient(45deg, #388e3c, #81c784)')"></button>
    <button style="background: linear-gradient(45deg, #fbc02d, #fff176);" onclick="changeCardColor('linear-gradient(45deg, #fbc02d, #fff176)')"></button>
    <button style="background: linear-gradient(45deg, #e64a19, #ff8a65);" onclick="changeCardColor('linear-gradient(45deg, #e64a19, #ff8a65)')"></button>
    <button style="background: linear-gradient(45deg, #000000, #434343);" onclick="changeCardColor('linear-gradient(45deg, #000000, #434343)')"></button>
    <button style="background: linear-gradient(45deg, #7d7d7d, #d9d9d9);" onclick="changeCardColor('linear-gradient(45deg, #7d7d7d, #d9d9d9)')"></button>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>

<script>
    $(document).ready(function () {
        $('#colorPickerIcon').click(function () {
            $('#colorOptions').toggle();
        });
    });

    function changeCardColor(color) {
        var card = document.getElementById('reset-password-card');
        card.style.background = color; // Set the gradient background

        // Set the button background to match the card
        var button = card.querySelector('.btn');
        button.style.background = color; // Match the gradient background of the card
        button.style.color = '#fff'; // Ensure the button text is white

        // Change the card text color based on the gradient background
        var cardText = card.querySelector('h5');
        var passwordLabel = card.querySelector('label[for="password"]');

        // Assuming gradients will be visually darker or lighter
        if (isDarkGradient(color)) {
            cardText.style.color = '#ffffff'; // White text for darker gradients
            passwordLabel.style.color = '#ffffff'; // White text for labels
        } else {
            cardText.style.color = '#333'; // Dark text for lighter gradients
            passwordLabel.style.color = '#333'; // Dark text for labels
        }
    }

    function isDarkGradient(gradient) {
        // Check if the gradient includes black or very dark colors
        const darkColors = ['#000000', '#434343', '#3a3a3a', '#2c2c2c', '#1c1c1c', '#0d0d0d'];
        return darkColors.some(color => gradient.includes(color));
    }
</script>

</body>
</html>
