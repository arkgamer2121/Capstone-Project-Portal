<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>404 HTML Template by Colorlib</title>

    <!-- Google font -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:400,700" rel="stylesheet">

    <!-- Custom styles embedded here -->
    <style>
        * {
            -webkit-box-sizing: border-box;
            box-sizing: border-box;
        }

        body {
            padding: 0;
            margin: 0;
        }

        #notfound {
            position: relative;
            height: 100vh;
        }

        #notfound .notfound {
            position: absolute;
            left: 50%;
            top: 50%;
            -webkit-transform: translate(-50%, -50%);
            -ms-transform: translate(-50%, -50%);
            transform: translate(-50%, -50%);
        }

        .notfound {
            max-width: 560px;
            width: 100%;
            padding-left: 160px;
            line-height: 1.1;
        }

        .notfound .notfound-404 {
            position: absolute;
            left: 0;
            top: 0;
            display: inline-block;
            width: 140px;
            height: 140px;
            background-image: url('assets/images/emoji.png');
            background-size: cover;
        }

        .notfound .notfound-404:before {
            content: '';
            position: absolute;
            width: 100%;
            height: 100%;
            -webkit-transform: scale(2.4);
            -ms-transform: scale(2.4);
            transform: scale(2.4);
            border-radius: 50%;
            background-color: #f2f5f8;
            z-index: -1;
        }

        .notfound h1 {
            font-family: 'Nunito', sans-serif;
            font-size: 65px;
            font-weight: 700;
            margin-top: 0px;
            margin-bottom: 10px;
            color: #151723;
            text-transform: uppercase;
        }

        .notfound h2 {
            font-family: 'Nunito', sans-serif;
            font-size: 21px;
            font-weight: 400;
            margin: 0;
            text-transform: uppercase;
            color: #151723;
        }

        .notfound p {
            font-family: 'Nunito', sans-serif;
            color: #999fa5;
            font-weight: 400;
        }

        .notfound a {
            font-family: 'Nunito', sans-serif;
            display: inline-block;
            font-weight: 700;
            border-radius: 40px;
            text-decoration: none;
            color: #388dbc;
        }

        @media only screen and (max-width: 767px) {
            .notfound .notfound-404 {
                width: 110px;
                height: 110px;
            }

            .notfound {
                padding-left: 15px;
                padding-right: 15px;
                padding-top: 110px;
            }
        }
    </style>
</head>

<body>

    <?php
        // Example PHP logic to handle dynamic content (if needed)
        $errorMessage = "Oops! Page Not Be Found";
    ?>

    <div id="notfound">
        <div class="notfound">
            <div class="notfound-404"></div>
            <h1>404</h1>
            <h2><?php echo $errorMessage; ?></h2>
            <p>Sorry but the page you are looking for does not exist or temporarily unavailable.</p>
            <p>"Parang crush mo, unreachable. 😢"</p>
            <a href="/">Back to homepage</a>
        </div>
    </div>

</body>
</html>
