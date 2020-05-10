<?php
include('../php/dbconfig.php');
include('../php/register.php');

////////////////////////IF USER CLICKED ON VERIFICATION LINK///////////////////////////////
if (isset($_GET['id'])) {
    $nic  = $_GET['id'];
    $sql1 = mysqli_query($db, "SELECT * FROM login WHERE user_type = '$nic' limit 1");

    /////// IF IT IS VALID VERIFICATION CODE /////// 
    if (mysqli_num_rows($sql1) == 1) {
        $sql2 = mysqli_query($db, "UPDATE login SET user_type='user' WHERE user_type='$nic'");

        $_SESSION['ver_code'] = "activated";
        header('location: login.php');
    }

    ////////IF IT IS INVALID VERIFICATION CODE ///////
    else {
        $_SESSION['ver_code'] = "invalid";
        header('location: accountverification.php');
    }   

    
}

////////RESEND AN EMAIL WITH VERIFITION LINK//////
if (isset($_GET['active'])) {
    $nic2 = $_GET['active'];
    $sql_r= mysqli_query($db,"SELECT * FROM customer WHERE customerNic='$nic2' LIMIT 1");
    if(mysqli_num_rows($sql_r)==1){

    
    $sql_resend = mysqli_fetch_assoc($sql_r);
    
    $email = $sql_resend['customerEmail'];
    $first_name = $sql_resend['customerFname'];
    $user_type = md5(uniqid());

    //RESEND EMAIL TO CUSTOMER
    include('../php/emailverification.php');
    mysqli_query($db,"UPDATE login SET user_type = '$user_type' WHERE nic = '$nic2';");
    sendActivationLink($email,$first_name,$nic2,$user_type);
    }
    else{
        echo '<script>alert("There is a problem. Please try again.");</script>';
        header('location: login.php');
    }
}



?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Account Verification</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">

    <link rel="stylesheet" href="../css/main.css">
    <link rel="stylesheet" href="../css/contactus.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" integrity="sha384-gfdkjb5BdAXd+lj+gudLWI+BXq4IuLW5IT+brZEZsLFm++aCMlF1V92rMkPaX4PP" crossorigin="anonymous">

</head>

<body style="background-color: white; ">

    <?php include('navigation.php'); ?>
    <br><br><br><br><br><br><br><br>
    
    <?php
    
    
    if(isset($_SESSION['ver_code'])){
        if ($_SESSION['ver_code']=="invalid"){
            echo "<div class='container'>
                    <div style='background-color: white; ' class='col-md-5 offset-md-3 justify-content-center'>
                        <div class='alert alert-danger' role='alert'><b>Your verification link is not valid or expired.<b> Please try again. If you need any help please contact us via <a href='mailto:uvacabs0@gmail.com'>uvacabs0@gmail.com</a></div>
                    </div>
                </div>";
                unset($_SESSION['ver_code']);
        }
    }
   
    ?>
    <br><br><br><br><br><br><br><br>
    <?php include('footer.php'); ?>

</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>

</html>