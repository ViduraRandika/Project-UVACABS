<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/main.css">
    <link rel="stylesheet" href="../css/login.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" integrity="sha384-gfdkjb5BdAXd+lj+gudLWI+BXq4IuLW5IT+brZEZsLFm++aCMlF1V92rMkPaX4PP" crossorigin="anonymous">



</head>

<body class="body-login">
<?php
session_start();
    if (isset($_SESSION['reset'])) {
       
        if ($_SESSION['reset'] == "success") {
            echo '<script>window.alert("Password reset email sent. Please check your email.");</script>';
            unset($_SESSION['reset']);
        }
        if ($_SESSION['reset'] == "invalid") {
            echo '<script>window.alert("Unable to find your email.")</script>';
            unset($_SESSION['reset']);
        }
    }
    ?>

    <?php
    $inedex = "../index.php";
    $logo = "../img/logo.png";
    $booking = "../user/booking.php";
    $contactus = "../user/contactus.php";
    $user_profile = "../user/profile.php";
    $login = "../user/login.php";
	$signup = "../user/signup.php";
    include('../common/navigation.php') ?>


    <div class="container h-100">
        <div class="d-flex justify-content-center h-100">
            <div class="user_card">
                <div class="d-flex justify-content-center">
                    <div class="brand_logo_container">
                        <img src="../img/logo.png" class="brand_logo" alt="Logo">
                    </div>
                    
                </div>
                <div class="mt-4 mb-3 container d-flex justify-content-center">
                <h4>RESET PASSWORD</h4>
                </div>
                
                <div class="d-flex justify-content-center ">
                    
                    <form action="reset-request.inc.php" class="container" method="post">

                        <div class="input-group mb-3">
                            <div class="input-group-append">
                                <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                            </div>
                            <input type="text" name="email" class="form-control input_user" placeholder="Enter your email address" required>
                        </div>
                        <div class="d-flex justify-content-center mt-3 login_container">
                            <button type="submit" name="reset-request-submit" value="submit" class="btn login_btn">Reset</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>

   

</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>

</html>