<?php 
session_start();
if (isset($_SESSION['user'])) {
    if ($_SESSION['user']['user_type'] == "cashier") {
      header('location: ../cashier/index.php');
    }
    if ($_SESSION['user']['user_type'] == "driver") {
      header('location: ../driver/index.php');
    }
    if ($_SESSION['user']['user_type'] == "user") {
      header('location: ../index.php');
    }
  }else{
    header('location: ../user/login.php');
  }
header('Location: pages/dashboard.php');
?>