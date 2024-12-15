<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="shortcut icon" type="image/x-icon" href="assets/images/icon/colegiologo.png">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Codeigniter Auth User Registration Example</title>
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
            width: 400px;
            margin: auto;
            padding: 30px 0;
            margin-top: 60px;
        }
        .card {
            color: #999;
            border-radius: 20px;
            background: #fff;
            box-shadow: 30 20px 8px rgba(0, 0, 0, 0.1), 0 0 0 3px rgba(0, 0, 0, 0.6); /* Added shadow around the border */
            padding: 25px;
            transition: background-color 0.3s ease; /* Add transition for smooth color changes */
        }
        .card h2 {
            color: #333;
            font-weight: bold;
            margin-top: 0;
        }
        .card hr {
            margin: 0 -30px 20px;
        }
        .card .form-group {
            margin-bottom: 20px;
        }
        .card label {
            font-weight: normal;
            font-size: 15px;
        }
        .card .form-control {
            min-height: 38px;
           
        }   
        .card .input-group-addon {
            max-width: 42px;
            text-align: center;
        }   
        .card .btn, .card .btn:active {        
            font-size: 16px;
            font-weight: bold;
            background: #19aa8d !important;
            border: none;
            min-width: 140px;
        }
        .card .btn:hover, .card .btn:focus {
            background: #179b81 !important;
        }
        .card a {
            color: #fff;    
            text-decoration: underline;
        }
        .card a:hover {
            text-decoration: none;
        }
        .card form a {
            color: #19aa8d;
            text-decoration: none;
        }   
        .card form a:hover {
            text-decoration: underline;
        }
        .card .fa {
            font-size: 21px;
        }
        .card .fa-paper-plane {
            font-size: 18px;
        }
        .card .fa-check {
            color: #fff;
            left: 17px;
            top: 18px;
            font-size: 7px;
            position: absolute;
        }
        #error-message {
            color: red;
            font-size: 14px;
            display: none;
        }
        
        /* Color Picker Styles */
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
        <div class="card" id="signup-card">
            <div class="text-center mb-3">
                <img src="assets/images/icon/colegiologo.png" alt="Logo" width="85">
            </div>
            <h2>Sign Up</h2>
            <p>Please fill in this form to create an account!</p>
            <hr>
          <?php if (session()->getFlashdata('error')): ?>
                <div class="alert alert-danger">
                    <?= session()->getFlashdata('error'); ?>
                </div>
            <?php endif; ?>

            <form id="signupForm" action="<?php echo base_url(); ?>/SignupController/store" method="post" onsubmit="return validatePasswords()">
                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="fa fa-user"></i>
                            </span>                    
                        </div>
                        <input type="text" class="form-control" name="student_id" placeholder="Student ID" value="<?= set_value('student_id') ?>" required="required">
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="fa fa-paper-plane"></i>
                            </span>                    
                        </div>
                        <input type="email" class="form-control" name="email" placeholder="Email Address" value="<?= set_value('email') ?>" required="required">
                    </div>
                </div>
                
                <div class="form-group">
    <div class="input-group">
        <div class="input-group-prepend">
            <span class="input-group-text">
                <i class="fa fa-lock"></i>
            </span>                    
        </div>
        <input type="password" class="form-control" id="password" name="password" placeholder="Password" required="required">
    </div>
</div>
<div class="form-group">
    <div class="input-group">
        <div class="input-group-prepend">
            <span class="input-group-text">
                <i class="fa fa-lock"></i>
                <i class="fa fa-check"></i>
            </span>                    
        </div>
        <input type="password" class="form-control" id="confirmPassword" name="confirmpassword" placeholder="Confirm Password" required="required">
    </div>
    <span id="special-char-error" style="color:red; display:none;">Password must contain at least one special character!</span>
    <span id="error-message" style="color:red; display:none;">Passwords do not match!</span>
</div>

                <div class="form-group">
                    <label class="form-check-label"><input type="checkbox" required="required"> I accept the <a href="#">Terms of Use</a> &amp; <a href="#">Privacy Policy</a></label>
                </div>
              <button type="submit" class="btn btn-signup btn-lg">Sign Up</button>

            </form>
            <div class="text-center">Already have an account? <a href="/signin" style="color: #19aa8d;">Login here</a></div>
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
        <button style="background: linear-gradient(45deg, #9e9e9e, #e0e0e0);" onclick="changeCardColor('linear-gradient(45deg, #9e9e9e, #e0e0e0)')"></button>
        <button style="background: linear-gradient(45deg, #ffffff, #d6d6d6);" onclick="changeCardColor('linear-gradient(45deg, #ffffff, #d6d6d6)')"></button>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const colorPickerIcon = document.getElementById('colorPickerIcon');
        const colorOptions = document.getElementById('colorOptions');

        colorPickerIcon.addEventListener('click', function() {
            colorOptions.style.display = colorOptions.style.display === 'none' || colorOptions.style.display === '' ? 'block' : 'none';
        });

      function changeCardColor(color) {
    const card = document.getElementById('signup-card');
    const button = document.querySelector('.btn-signup'); // Select the button
    card.style.background = color;
    colorOptions.style.display = 'none'; // Hide options after selection

    // Change text color based on background color
    const isLightBackground = color.includes('255') || color.includes('d6d6d6');
    card.style.color = isLightBackground ? '#333' : '#fff'; // Adjust text color

    // Change button color based on background
    if (isLightBackground) {
        button.classList.add('btn-signup-light');
        button.classList.remove('btn-signup-dark');
    } else {
        button.classList.add('btn-signup-dark');
        button.classList.remove('btn-signup-light');
    }
}

    </script>
    <script>
function validatePasswords() {
    var password = document.getElementById('password').value;
    var confirmPassword = document.getElementById('confirmPassword').value;
    if (password !== confirmPassword) {
        document.getElementById('error-message').style.display = 'block';
        return false;
    }
    return true;
}
</script>
<script>
        // Function to validate passwords and special character
        function validatePasswords() {
            var password = document.getElementById('password').value;
            var confirmPassword = document.getElementById('confirmPassword').value;

            // Special character regex pattern
            var specialCharPattern = /[!@#$%^&*(),.?":{}|<>]/;

            // Check if password contains at least one special character
            if (!specialCharPattern.test(password)) {
                document.getElementById('special-char-error').style.display = 'block';
                return false;
            } else {
                document.getElementById('special-char-error').style.display = 'none';
            }

            // Check if passwords match
            if (password !== confirmPassword) {
                document.getElementById('error-message').style.display = 'block';
                return false;
            } else {
                document.getElementById('error-message').style.display = 'none';
            }

            return true;
        }

        // Color picker button event
        document.getElementById('colorPickerIcon').addEventListener('click', function() {
            var colorOptions = document.getElementById('colorOptions');
            colorOptions.style.display = colorOptions.style.display === 'block' ? 'none' : 'block';
        });

        // Function to change card color
        function changeCardColor(gradientColor) {
            document.getElementById('signup-card').style.background = gradientColor;
        }
    </script>

</body>
</html>
