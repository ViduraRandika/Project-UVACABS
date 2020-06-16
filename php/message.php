<?php
session_start();
////////REDIRECT IF THERE IS NO ANY REASON TO VISIT THIS PAGE//////////
if (!isset($_SESSION['loginError'])||!isset($_COOKIE['activated'])) {
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Message</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">

    <link rel="stylesheet" href="../css/main.css">
    <link rel="stylesheet" href="../css/contactus.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" integrity="sha384-gfdkjb5BdAXd+lj+gudLWI+BXq4IuLW5IT+brZEZsLFm++aCMlF1V92rMkPaX4PP" crossorigin="anonymous">

</head>

<body style="background-color: white; ">

    <?php 
    $index = "../index.php";
    $booking = "../user/booking.php";
    $contactus = "../user/contactus.php";
    $user_profile = "../user/profile.php";
    $login = "../user/login.php";
	$signup = "../user/signup.php";
	$logo = "../img/logo.png";
    include('../common/navigation.php'); ?>
    <br><br><br><br><br><br><br><br>
    
    <?php
    if(isset($_GET['mail'])){
        if ($_GET['mail']=="sent"){
            $mailsentnic = $_SESSION['mailsentNic'];
            echo "<div class='container'>
                    <div style='background-color: white; ' class='col-md-5 offset-md-3 justify-content-center'>
                        <div class='alert alert-success' role='alert'><b>Email sent !</b><br><br>Please check your email (If you can't find please check your spam folder also).If you didn't received an email yet, please click <a href='../user/accountverification.php?active=".$mailsentnic."'>here</a> to resend activation link.</div>
                    </div>
                </div>";
            }
    }
    if (isset($_SESSION['loginError'])) {
        if ($_SESSION['loginError']=="removed"){
            echo "<div class='container'>
                    <div style='background-color: white; ' class='col-md-5 offset-md-3 justify-content-center'>
                        <div class='alert alert-danger' role='alert'><b>There is a problem with your account. Contact us from<a href='../user/contactus.php'> here</a> or contact us via <u>uvacabs0@gmail.com</u> (Dont't forget to mention your NIC and Contact No).</b><br>Our agent will contact you soon. Sorry for the inconvenience</div>
                    </div>
                </div>";
                unset($_SESSION['loginError']);
            }
        elseif ($_SESSION['loginError']=="notactivated"){
            $nic = $_SESSION['notactivated'];
            echo "<div class='container'>
                    <div style='background-color: white; ' class='col-md-5 offset-md-3 justify-content-center'>
                        <div class='alert alert-primary' role='alert'><b>Your email is not verified. Please check your email. If you didn't received an email yet, please click <a href='../user/accountverification.php?active=".$nic."'>here</a> to resend activation link.</div>
                    </div>
                </div>";
                unset($_SESSION['loginError']);
            }
    }
    

    ?>
    
    <br><br><br><br><br><br><br><br>
    <?php include('../common/footer.php'); ?>

</body>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>

</html>