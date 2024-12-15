<!DOCTYPE html>
<html lang="en">
<head>
        <link rel="shortcut icon" type="image/x-icon" href="assets/images/icon/colegiologo.png">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        body {
            background: white;
            font-family: 'Roboto', sans-serif;
            background-image: url('assets/images/icon/sideabar22.jpg');
            background-repeat: no-repeat;
            background-size: cover;
            background-position: center;
        }

        .container {
            margin-top: 20px;
        }

        .card {
            color: #999;
            border: none;
            border-radius: 30px;
            
    box-shadow: 10px 2px 10px rgba(0, 0, 0, 0.6);
            padding: 30px;
            background-color: #fff;
            transition: background-color 0.3s ease;
        }

        .card h5 {
            color: #333;
            font-weight: bold;
            margin-top: 0;
        }

        .signin-link {
            color: darkgreen; /* Change the color as desired */
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
    <div class="col-10 col-md-8 col-lg-4">
      <div class="card shadow-sm" id="forgot-password-card">
        <div class="card-body">
          <div class="mb-4">
            <h5>Forgot Password?</h5>
            <p class="mb-2">Enter your registered email ID to reset the password</p>
         </div>
        
        <?php if(session()->getFlashdata('success')): ?>
            <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
        <?php endif; ?>
        
        <?php if(session()->getFlashdata('error')): ?>
            <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
        <?php endif; ?>

        <form action="/forgot_password/send" method="POST">
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" id="email" class="form-control" name="email" placeholder="Enter Your Email" required="">
            </div>
            <div class="mb-3 d-grid">
                <button type="submit" class="btn btn-success">Reset Password</button>
            </div>
            <span>Don't have an account? <a href="signin" class="signin-link">sign in</a></span>
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
        var card = document.getElementById('forgot-password-card');
        card.style.background = color; // Set the gradient background

        // Set the button background to match the card
        var button = card.querySelector('.btn');
        button.style.background = color; // Match the gradient background of the card
        button.style.color = '#fff'; // Ensure the button text is white

        // Change the card text color based on the gradient background
        var cardText = card.querySelector('h5');
        var infoText = card.querySelector('p');
        var signUpLink = card.querySelector('.signin-link');

        // Assuming gradients will be visually darker or lighter
        if (isDarkGradient(color)) {
            cardText.style.color = '#ffffff'; // White text for darker gradients
            infoText.style.color = '#ffffff'; // White text for info message
            signUpLink.style.color = '#ffffff'; // White text for Sign In link
        } else {
            cardText.style.color = '#333'; // Dark text for lighter gradients
            infoText.style.color = '#333'; // Dark text for info message
            signUpLink.style.color = '#19aa8d'; // Color for Sign In link
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
