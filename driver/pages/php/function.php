<?php
//user logut
session_start();
if (isset($_GET['logout'])) {
	setcookie("loggedin", "deleted", time() + (86400 * 30), "/"); // 86400 = 1 day
	session_destroy();
	unset($_SESSION['user']);
	unset($_SESSION['user_data']);
	header("location: ../../../user/login.php");
}




?>