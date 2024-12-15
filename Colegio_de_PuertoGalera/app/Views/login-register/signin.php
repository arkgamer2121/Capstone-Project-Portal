<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
       <link rel="shortcut icon" type="image/x-icon" href="<?= base_url('assets/images/icon/colegiologo.png') ?>">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Login Form</title>
    <style>
        body {
            background: white;
            font-family: 'Roboto', sans-serif;
            background-image: url('assets/images/icon/sideabar22.jpg');
            background-repeat: no-repeat; /* Prevents the image from repeating */
            background-size: cover; /* Ensures the image covers the entire container */
            background-position: center; /* Centers the image */
        }

        .container {
            margin-top: 80px;
        }

        .card {
            color: #999;
            border: none;
            border-radius: 30px;
            box-shadow: 0 25px 32px rgba(0, 0, 0, 0.1), 0 0 0 3px rgba(0, 0, 0, 0.1); /* Added shadow around the border */
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

        .card hr {
            margin: 0 -30px 20px;
        }

        .card p {
            font-weight: normal;
        }

        .card .form-group {
            margin-bottom: 20px;
        }

        .card .form-control {
            border: 1px solid #dddfe2;
            border-radius: 5px;
            margin-bottom: 15px;
            font-size: 15px;
        }

        .card .btn {
            border: none;
            border-radius: 3px;
            padding: 10px 0;
            font-size: 16px;
            font-weight: bold;
            color: #fff;
            background-color: #19aa8d;
            min-width: 140px;
        }

        .card .btn:hover {
            background-color: #218c7d;
        }

        .card a {
            color: #19aa8d;
            text-decoration: underline;
        }

        .card a:hover {
            text-decoration: none;
        }

        /* Error Message Styling */
        #error-message {
            color: red;
            font-size: 14px;
            display: block;
            margin-top: 10px;
            text-align: center;
        }

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
    <div class="row justify-content-center">
        <div class="col-lg-4 col-md-6 col-sm-8">
            <div class="card" id="login-card">
                <div class="text-center mb-3">
                    
                    <img src="<?= base_url('assets/images/icon/colegiologo.png') ?>" alt="Logo" width="85">
                </div>
                <h2>Login</h2>
                <p>Please fill in this form to login to your account!</p>
                <hr>
                
                <!-- Display flash message for errors -->
                <?php if (session()->getFlashdata('error')): ?>
                    <div id="error-message" class="alert alert-danger">
                        <?= session()->getFlashdata('error'); ?>
                    </div>
                <?php endif; ?>

                <form id="login-form" action="<?php echo base_url(); ?>/SigninController/loginAuth" method="post">
                    <div class="form-group mb-3">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fa fa-envelope"></i></span>
                            </div>
                            <input type="email" name="email" placeholder="Email" value="<?= set_value('email') ?>" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group mb-3">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fa fa-lock"></i></span>
                            </div>
                            <input type="password" name="password" placeholder="Password" class="form-control" required>
                        </div>
                    </div>
                    <div class="d-grid">
                        <button type="submit" class="btn btn-success">Sign in</button>
                    </div>
                </form>
                <div class="text-center mt-3">Don't have an account? <a href="/signup">Sign Up here</a></div>
                <div class="text-center"><a href="/forgot_password" style="color: #19aa8d;">Forgot Password</a></div>
            </div>
        </div>
    </div>
</div>

<!-- Color Picker Button -->
<i class="fa fa-paint-brush color-picker-btn" id="colorPickerIcon" style="color: black;"></i>


<!-- Color Options -->
<!-- Color Options -->
<div class="color-options" id="colorOptions">
    <button style="background: linear-gradient(45deg, #8e24aa, #ba68c8);" onclick="changeCardColor('linear-gradient(45deg, #8e24aa, #ba68c8)')"></button>
    <button style="background: linear-gradient(45deg, #1976d2, #64b5f6);" onclick="changeCardColor('linear-gradient(45deg, #1976d2, #64b5f6)')"></button>
    <button style="background: linear-gradient(45deg, #388e3c, #81c784);" onclick="changeCardColor('linear-gradient(45deg, #388e3c, #81c784)')"></button>
    <button style="background: linear-gradient(45deg, #fbc02d, #fff176);" onclick="changeCardColor('linear-gradient(45deg, #fbc02d, #fff176)')"></button>
    <button style="background: linear-gradient(45deg, #e64a19, #ff8a65);" onclick="changeCardColor('linear-gradient(45deg, #e64a19, #ff8a65)')"></button>
    <button style="background: linear-gradient(45deg, #000000, #434343);" onclick="changeCardColor('linear-gradient(45deg, #000000, #434343)')"></button>
    <button style="background: linear-gradient(45deg, #7d7d7d, #d9d9d9);" onclick="changeCardColor('linear-gradient(45deg, #7d7d7d, #d9d9d9)')"></button>
    <!-- New White Gradient -->
    <button style="background: linear-gradient(45deg, #ffffff, #e0e0e0);" onclick="changeCardColor('linear-gradient(45deg, #ffffff, #e0e0e0)')"></button>
</div>


<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script>
    $(document).ready(function () {
        $('#colorPickerIcon').click(function () {
            $('#colorOptions').toggle();
        });
    });

    function changeCardColor(color) {
        var card = document.getElementById('login-card');
        card.style.background = color; // Set the gradient background

        // Set the button background to match the card
        var button = card.querySelector('.btn');
        button.style.background = color; // Match the gradient background of the card
        button.style.color = '#fff'; // Ensure the button text is white

        // Change the card text color based on the gradient background
        var cardText = card.querySelector('h2');
        var infoText = card.querySelector('p');
        var signUpLink = card.querySelector('a:nth-of-type(1)');
        var forgotPasswordLink = card.querySelector('a:nth-of-type(2)');

        // Check if the selected gradient is dark
        if (isDarkGradient(color)) {
            cardText.style.color = '#ffffff'; // White text for darker gradients
            infoText.style.color = '#ffffff'; // White text for info message
            signUpLink.style.color = '#ffffff'; // White text for Sign Up link
            forgotPasswordLink.style.color = '#ffffff'; // White text for Forgot Password link
        } else {
            cardText.style.color = '#333'; // Dark text for lighter gradients
            infoText.style.color = '#333'; // Dark text for info message
            signUpLink.style.color = '#19aa8d'; // Color for Sign Up link
            forgotPasswordLink.style.color = '#19aa8d'; // Color for Forgot Password link
        }
    }

    function isDarkGradient(gradient) {
        // Check if the gradient includes black or very dark colors
        const darkColors = ['#000000', '#434343', '#3a3a3a', '#2c2c2c', '#1c1c1c', '#0d0d0d'];
        return darkColors.some(color => gradient.includes(color));
    }
</script>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"></script>

</body>
</html>
