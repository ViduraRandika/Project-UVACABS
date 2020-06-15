<?php 
session_start();
 
if (isset($_SESSION['user'])) {
  if ($_SESSION['user']['user_type'] == "admin") {
    header('location: ../admin/index.php');
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

header('location: pages/Cashier.php');
?>