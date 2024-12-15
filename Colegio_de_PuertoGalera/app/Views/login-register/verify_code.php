<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
        <link rel="shortcut icon" type="image/x-icon" href="assets/images/icon/colegiologo.png">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verification Code</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        body {
            background-color: #f0f2f5;
            background-image: url('/assets/images/icon/sideabar22.jpg');
        }
        .container {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }
        .card {
            width: 70%;
            max-width: 350px; /* Wider card */
            padding: 6px;    /* Larger padding */
            transition: background-color 0.3s ease; /* Added transition for background */
            border-radius: 30px;
        }
        .error {
            color: red;
            font-size: 1rem;
            text-align: center;
            margin-bottom: 15px;
        }
        .form-control {
            padding: 5px;  /* Larger padding for input fields */
            font-size: 1.1rem;  /* Larger font size for input fields */
        }
        .btn {
            padding: 7px;  /* Larger padding for buttons */
            font-size: 1.1rem;  /* Larger font size for buttons */
            transition: background-color 0.3s, transform 0.2s; /* Smooth transition */
        }
        .btn-primary {
            background-color: #0d6efd;
            border: none;
        }
        .btn-primary:hover {
            background-color: #0a58ca;
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
<div class="container">
    <div class="card shadow-sm" id="verification-card">
        <div class="card-body">
            <h5 class="card-title text-center">Verification Code</h5>

            <?php if(session()->getFlashdata('error')): ?>
                <div class="error"><?= session()->getFlashdata('error') ?></div>
            <?php endif; ?>

            <form action="/forgot_password/check_code" method="POST">
                <div class="mb-4">  <!-- More space between form elements -->
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" name="email" placeholder="Enter your email" required>
                </div>
                <div class="mb-4">  <!-- More space between form elements -->
                    <label for="verification_code" class="form-label">Verification Code</label>
                    <input type="text" class="form-control" name="verification_code" placeholder="Enter verification code" required>
                </div>
                <div class="d-grid">  <!-- Using Bootstrap d-grid for button -->
                    <button type="submit" class="btn btn-success">Verify</button>
                </div>
            </form>
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
    <!-- New Black Gradient -->
    <button style="background: linear-gradient(45deg, #000000, #434343);" onclick="changeCardColor('linear-gradient(45deg, #000000, #434343)')"></button>
    <!-- New Gray Gradient -->
    <button style="background: linear-gradient(45deg, #7d7d7d, #d9d9d9);" onclick="changeCardColor('linear-gradient(45deg, #7d7d7d, #d9d9d9)')"></button>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script>
    $(document).ready(function () {
        $('#colorPickerIcon').click(function () {
            $('#colorOptions').toggle();
        });
    });

    function changeCardColor(color) {
        var card = document.getElementById('verification-card');
        card.style.background = color; // Set the gradient background

        // Set the button background to match the card
        var button = card.querySelector('.btn');
        button.style.background = color; // Match the gradient background of the card
        button.style.color = '#fff'; // Ensure the button text is white

        // Change the card text color based on the gradient background
        var cardText = card.querySelector('h5');
        var emailLabel = card.querySelector('label[for="email"]');
        var codeLabel = card.querySelector('label[for="verification_code"]');

        // Assuming gradients will be visually darker or lighter
        if (isDarkGradient(color)) {
            cardText.style.color = '#ffffff'; // White text for darker gradients
            emailLabel.style.color = '#ffffff'; // White text for labels
            codeLabel.style.color = '#ffffff'; // White text for labels
        } else {
            cardText.style.color = '#333'; // Dark text for lighter gradients
            emailLabel.style.color = '#333'; // Dark text for labels
            codeLabel.style.color = '#333'; // Dark text for labels
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
