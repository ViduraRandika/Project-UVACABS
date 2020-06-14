<?php include('../php/register.php') ?>
<?php 
//permissions
if(isset($_SESSION['user'])){
	if($_SESSION['user']['user_type'] == "admin"){
			header('location: ../admin/index.php');
	}
	if($_SESSION['user']['user_type'] == "cashier"){
		header('location: ../cashier/index.php');
	}
	if($_SESSION['user']['user_type'] == "driver"){
		header('location: ../driver/index.php');
    }
    if($_SESSION['user']['user_type'] == "customer"){
		header('location: ../index.php');
	}
}
?>
<?php include('../php/rememberme.php')?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Sign Up</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/main.css">
    <link rel="stylesheet" href="../css/signup.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" integrity="sha384-gfdkjb5BdAXd+lj+gudLWI+BXq4IuLW5IT+brZEZsLFm++aCMlF1V92rMkPaX4PP" crossorigin="anonymous">

</head>

<body class="body-signup">

    <?php include('navigation.php') ?>

    <!--NAV BAR END-->

    <br>
    <br>

    <!--SIGNUP SECTION-->

    <div class="container h-100 container_signup">
        <div class="d-flex justify-content-center h-100">

            <!--SIGN UP CARD-->

            <div class="user_card">
                <div class="d-flex justify-content-center">
                    <div class="brand_logo_container">
                        <img src="../img/logo.png" class="brand_logo" alt="Logo">
                    </div>
                </div>
                <div class="d-flex justify-content-center form_container">
                    <form class="signform" action="signup.php" method="post">
                        <?php if (count($errors) > 0) : ?>

                            <?php if (isset($url)) {
                                echo $_SESSION['url'];
                            } ?>
                            <div class="error">
                                <?php foreach ($errors as $error) : ?>
                                    <p><?php echo $error ?></p>
                                <?php endforeach ?>
                            </div>
                        <?php endif ?>

                        <!--First name-->

                        <label for="InputName" class="label_signUp">First Name*</label>
                        <div class="input-group mb-3">
                            <div class="input-group-append">
                                <span class="input-group-text"><i class="fas fa-user"></i></span>
                            </div>
                            <input type="text" name="fname" class="form-control input_user" value="<?php echo $first_name; ?>" placeholder="First Name" required>
                        </div>

                        <!--Last Name-->

                        <label for="InputNic" class="label_signUp">Last Name*</label>
                        <div class="input-group mb-2">
                            <div class="input-group-append">
                                <span class="input-group-text"><i class="fas fa-user"></i></span>
                            </div>
                            <input type="text" name="lname" class="form-control input_pass" value="<?php echo $last_name; ?>" placeholder="Last Name" required>
                        </div>

                        <!--NIC-->

                        <label for="InputNic" class="label_signUp">NIC*</label>
                        <div class="input-group mb-2">
                            <div class="input-group-append">
                                <span class="input-group-text"><i class="fas fa-id-badge"></i></span>
                            </div>
                            <input type="text" name="nic" class="form-control input_pass" value="<?php echo $nic; ?>" placeholder="NIC" required>
                        </div>

                        <!--E-mail-->

                        <label for="InputNic" class="label_signUp">E-mail*</label>
                        <div class="input-group mb-2">
                            <div class="input-group-append">
                                <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                            </div>
                            <input type="email" name="user_email" class="form-control input_pass" value="<?php echo $email; ?>" placeholder="E-mail" required>
                        </div>

                        <!--Phone Number-->

                        <label for="InputNic" class="label_signUp">Phone Number*</label>
                        <div class="input-group mb-2">
                            <div class="input-group-append">
                                <span class="input-group-text"><i class="fas fa-phone"></i></span>
                            </div>
                            <input type="number" name="phone_number" class="form-control input_pass" value="<?php echo $phone_number; ?>" placeholder="Phone Number" required>
                        </div>

                        <!--Address-->

                        <label for="InputNic" class="label_signUp">Address*</label>
                        <div class="input-group mb-2">
                            <div class="input-group-append">
                                <span class="input-group-text"><i class="fas fa-address-card"></i></span>
                            </div>
                            <input type="text" name="h_address" class="form-control input_pass" value="<?php echo $address; ?>" placeholder="Address" required>
                        </div>

                        <!--Password-->

                        <label for="InputNic" class="label_signUp">Password*</label>
                        <div class="input-group mb-2">
                            <div class="input-group-append">
                                <span class="input-group-text"><i class="fas fa-key"></i></span>
                            </div>
                            <input type="password" name="password_1" id="password_1" class="form-control input_pass" placeholder="Password" onkeyup='check();' required>
                        </div>

                        <!--Confirm password-->

                        <label for="InputNic" class="label_signUp">Confirm Password*</label>
                        <div class="input-group mb-2">
                            <div class="input-group-append">
                                <span class="input-group-text"><i class="fas fa-key"></i></span>
                            </div>
                            <input type="password" name="password_2" id="password_2" class="form-control input_pass" placeholder="Confirm Password" onkeyup='check();' required>
                        </div>
                        <label id="message"></label>

                        <!--Sign Up button-->

                        <div class="d-flex justify-content-center mt-3 login_container">
                            <button type="submit" name="register_btn" class="btn login_btn">Signup</button>
                        </div>

                    </form>

                </div>

                <!--Already have an account-->

                <div class="mt-4">
                    <div class="d-flex justify-content-center links">
                        Already have an account? <a href="login.php" class="ml-2">Login</a>
                    </div>

                </div>
            </div>

            <!--SIGN UP CARD END-->

        </div>
    </div>
    <?php
    if (isset($_SESSION['alreadyLoggedIn'])) {
        echo '<script>alert("Please Logout first");</script>';
        unset($_SESSION['alreadyLoggedIn']);
    }
    ?>

</body>

<script>
    var check = function() {

        if (document.getElementById('password_1').value ==
            document.getElementById('password_2').value) {
            document.getElementById('message').style.color = 'green';
            document.getElementById('message').innerHTML = 'matching';
            if (document.getElementById('password_1').value == "") {
                document.getElementById('message').innerHTML = '';
            }
        } else if (document.getElementById('password_1').value !=
            document.getElementById('password_2').value) {
            document.getElementById('message').style.color = 'red';
            document.getElementById('message').innerHTML = 'not matching';
        }

    }
</script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>

<!-- <script src="jquery-3.2.1.min.js"></script>
<script src="script.js"></script> -->

</html>