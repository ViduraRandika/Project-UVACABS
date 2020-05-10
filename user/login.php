<?php include('../php/register.php') ?>
<?php include('../php/rememberme.php')?>

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

    <?php include('navigation.php') ?>


    <div class="container h-100">
        <div class="d-flex justify-content-center h-100">
            <div class="user_card">
                <div class="d-flex justify-content-center">
                    <div class="brand_logo_container">
                        <img src="../img/logo.png" class="brand_logo" alt="Logo">
                    </div>
                </div>
                <div class="d-flex justify-content-center form_container">
                    <form action="login.php" method="post">
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
                        <div class="error">
                            <p><?php 
                                if(isset($_GET['newpwd'])){
                                    if($_GET['newpwd']="updated"){
                                        echo "New Password Updated";
                                    }
                                }
                            ?></p>
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-append">
                                <span class="input-group-text"><i class="fas fa-user"></i></span>
                            </div>
                            <input type="text" name="user_nic" class="form-control input_user" placeholder="NIC"
                                required>
                        </div>
                        <div class="input-group mb-2">
                            <div class="input-group-append">
                                <span class="input-group-text"><i class="fas fa-key"></i></span>
                            </div>
                            <input type="password" name="user_password" class="form-control input_pass" value=""
                                placeholder="password" required>
                        </div>
                        <div class="form-group">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="customControlInline"
                                    name="rememberme">
                                <label class="custom-control-label" for="customControlInline">Remember me</label>
                            </div>
                        </div>
                        <div class="d-flex justify-content-center mt-3 login_container">
                            <button type="submit" name="login_btn" class="btn login_btn">Login</button>
                        </div>
                    </form>
                </div>

                <div class="mt-4">
                    <div class="d-flex justify-content-center links">
                        Don't have an account? <a href="signup.php" class="ml-2">Sign Up</a>
                    </div>
                    <div class="d-flex justify-content-center links">
                        <a href="../password_reset/reset-password.php">Forgot your password?</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
<?php
    if (isset($_SESSION['alreadyLoggedIn'])) {
        echo '<script>alert("Please Logout first");</script>';
        unset($_SESSION['alreadyLoggedIn']);
    }
    if(isset($_SESSION['ver_code'])){
        if($_SESSION['ver_code']=="activated"){
            echo "<script type='text/javascript'>alert('Your account is now activated. You can now login with your credentials.');</script>";
        }
    }
    ?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>

</html>