<!DOCTYPE html>
<html lang="en">
<head>

    <title>Log In</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/main.css">
    <link rel="stylesheet" href="../css/login.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css"
        integrity="sha384-gfdkjb5BdAXd+lj+gudLWI+BXq4IuLW5IT+brZEZsLFm++aCMlF1V92rMkPaX4PP" crossorigin="anonymous">
		


</head>

<body class="body-login">
<?php 
$index = "../index.php";
$logo = "../img/logo.png";
    $booking = "../user/booking.php";
    $contactus = "../user/contactus.php";
    $user_profile = "../user/profile.php";
    $login = "../user/login.php";
	$signup = "../user/signup.php";
include('../common/navigation.php') ?>


    <?php
    session_start();
    if(isset($_SESSION['newpwd'])){
        if($_SESSION['newpwd']=="empty"){
            ?>
            <script>window.alert("Passwords cannot be empty");</script>
            <?php
            unset($_SESSION['newpwd']);
        }

        if($_SESSION['newpwd']=="pwdnotsame"){
            ?>
             <script>window.alert("Passwords not same");</script>
            <?php
             unset($_SESSION['newpwd']);
        }

        
        
    }
        $selector = $_GET['selector'];
        $validator = $_GET['validator'];
        if(empty($selector)||empty($validator)){
            echo "Could not validate your request";
        }else{
            if (ctype_xdigit($selector) !== false && ctype_xdigit($validator) !== false) {
                ?>
				
	<div class="container h-100">
        <div class="d-flex justify-content-center h-100">
            <div class="user_card">
                <div class="d-flex justify-content-center">
                    <div class="brand_logo_container">
                        <img src="../img/logo.png" class="brand_logo" alt="Logo">
                    </div>
                </div>
                <div class="mt-4 mb-3 container d-flex justify-content-center">
                <h5>CREATE NEW PASSWORD</h5>
                </div>
                <div class="d-flex justify-content-center ">
                   <form action="reset-password.inc.php" method="post">
                        </div>
						<input type="hidden" name="selector" value="<?php echo $selector;?>">
                        <input type="hidden" name="validator" value="<?php echo $validator;?>">
                        <div class="justify-content-center">
                        <label id="message" class=""></label>
                        </div>
                        
                        <div class="input-group mb-3">
                        
                            <div class="input-group-append">
                                <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                            </div>
                            <input type="password" name="pwd" class="form-control input_user" id="password_1" placeholder="Enter a new password"
                                onkeyup='check();' required></div>
								
								 <div class="input-group mb-3">
                            <div class="input-group-append">
                                <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                            </div>
                            <input type="password" name="pwd-repeat" class="form-control input_user" id="password_2" placeholder="Repeat new password"
                                onkeyup='check();' required></div>
                        <div class="d-flex justify-content-center mt-3 login_container">
                            <button type="submit" name="reset-password-submit" value="Reset Password" class="btn login_btn">Reset Password</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
                </form>
                <br><br><br><br>
                
            
                <?php
            }else{
                
            }
        }
    ?>
</body>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>

<script>
    var check = function() {

        if (document.getElementById('password_1').value ==
            document.getElementById('password_2').value) {
            document.getElementById('message').style.color = 'green';
            document.getElementById('message').innerHTML = 'Passwords are matching';
            if (document.getElementById('password_1').value == "") {
                document.getElementById('message').innerHTML = '';
            }
        } else if (document.getElementById('password_1').value !=
            document.getElementById('password_2').value) {
            document.getElementById('message').style.color = 'red';
            document.getElementById('message').innerHTML = 'Passwords are not matching';
        }

    }
	
	
</script>
</html>