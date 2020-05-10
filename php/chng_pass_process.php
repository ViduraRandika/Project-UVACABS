<?php
include('register.php');
if (!isLoggedIn()) {
    $_SESSION['msg'] = "You must log in first";
    header('location: login.php');
}
$n = $_SESSION['user']['nic'];
include('dbconfig.php');
$exceptions = array();
if (isset($_POST['change'])){
    $pass = md5($_POST['password1']);
    $pwup = "UPDATE login SET password = '$pass' WHERE nic = '$n'";
    mysqli_query($db,$pwup);
    session_destroy();
    unset($_SESSION['user']);
    header("location: ../user/login.php");
    
}
else{
    header('location:../user/change_password.php');
}
?>
