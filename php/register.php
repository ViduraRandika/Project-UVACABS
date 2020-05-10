<?php

//INCLUDE DATABASE CONNECTION 
include('dbconfig.php');
session_start();

// variable declaration
$nic = "";
$email    = "";
$first_name = "";
$last_name = "";
$phone_number = "";
$address = "";
$errors   = array();

// call the register() function if register_btn is clicked
if (isset($_POST['register_btn'])) {
	if (isset($_SESSION['user'])) {
		$_SESSION['alreadyLoggedIn'] = "alreadyloggedin";
		header('location: ../user/signup.php');
	} else {
		register();
	}
}

// REGISTER USER
function register()
{
	// call these variables with the global keyword to make them available in function
	global $db, $errors, $nic, $email;

	// receive all input values from the form. Call the e() function
	// defined below to escape form values
	$nic    =  e($_POST['nic']);
	$email       =  e($_POST['user_email']);
	$password_1  =  e($_POST['password_1']);
	$password_2  =  e($_POST['password_2']);
	$first_name = e($_POST['fname']);
	$last_name = e($_POST['lname']);
	$phone_number = e($_POST['phone_number']);
	$address = e($_POST['h_address']);
	// form validation: ensure that the form is correctly filled

	if (empty($nic)) {
		array_push($errors, "nic is required");
	}
	if (empty($email)) {
		array_push($errors, "Email is required");
	}
	if (empty($password_1)) {
		array_push($errors, "Password is required");
	}
	if ($password_1 != $password_2) {
		array_push($errors, "The two passwords do not match");
	}
	if ((strlen($password_1) < 6)) {
		array_push($errors, "Password lenghth should be greatr than 6");
	}

	if ((strlen($phone_number) != 10)) {
		array_push($errors, "Invalid phone number");
	}

	$sql_u = "SELECT * FROM customer WHERE customerContactNo='$phone_number'";
	$sql_e = "SELECT * FROM login WHERE nic='$nic'";
	$sql_n = "SELECT * FROM customer WHERE customerEmail='$email'";
	$res_u = mysqli_query($db, $sql_u);
	$res_e = mysqli_query($db, $sql_e);
	$res_n = mysqli_query($db, $sql_n);

	if (mysqli_num_rows($res_u) > 0) {
		array_push($errors, "Sorry... phone number already taken");
	}

	if (mysqli_num_rows($res_e) > 0) {
		array_push($errors, "Sorry... nic already taken");
	}

	if (mysqli_num_rows($res_n) > 0) {
		array_push($errors, "Sorry... email already exists");
	}


	// register user if there are no errors in the form
	if (count($errors) == 0) {
		$password = md5($password_1); //encrypt the password before saving in the database
		$user_type = md5(uniqid());
        $date = date("Y/m/d");

		$queryLogin = "INSERT INTO login(nic,password,user_type) VALUES ('$nic','$password','$user_type')";
		$queryCustomer = "INSERT INTO customer(customerNic,customerFname,customerLname,customerAddress,customerEmail,customerContactNo,customerRegDate) VALUES ('$nic','$first_name','$last_name','$address','$email','$phone_number','$date')";
		mysqli_query($db, $queryLogin);
		mysqli_query($db,$queryCustomer);
		//SEND EMAIL TO CUSTOMER
        include('emailverification.php');
        sendActivationLink($email,$first_name,$nic,$user_type);
	}
}

// return user array from their id
function getUserById($id)
{
	global $db;
	$query = "SELECT * FROM login WHERE id=" . $id;
	$result = mysqli_query($db, $query);

	$user = mysqli_fetch_assoc($result);
	return $user;
}

// escape string
function e($val)
{
	global $db;
	return mysqli_real_escape_string($db, trim($val));
}

// function display_error() {
// 	global $errors;
// 	if (count($errors) > 0){
// 		echo '<div class="error">';
// 			foreach ($errors as $error){
// 				echo $error .'<br>';
// 			}
// 		echo '</div>';
// 	}
// }
//check whether user is logged in or not before loading restricted page
function isLoggedIn()
{
	if (isset($_SESSION['user'])) {
		return true;
	} else {
		return false;
	}
}
//user logut
if (isset($_GET['logout'])) {
	setcookie("loggedin", "deleted", time() + (86400 * 30), "/"); // 86400 = 1 day
	session_destroy();
	unset($_SESSION['user']);
	unset($_SESSION['user_data']);
	header("location: user/login.php");
}

// call the login() function if register_btn is clicked
if (isset($_POST['login_btn'])) {
	if (isset($_SESSION['user'])) {
		$_SESSION['alreadyLoggedIn'] = "alreadyloggedin";
		header('location: ../user/login.php');
	} else {
		login();
	}
}

// LOGIN USER
function login()
{
	global $db, $nic, $errors;

	// grap form values
	$nic = e($_POST['user_nic']);
	$password = e($_POST['user_password']);

	// make sure form is filled properly
	if (empty($nic)) {
		array_push($errors, "nic is required");
	}
	if (empty($password)) {
		array_push($errors, "Password is required");
	}

	// attempt login if no errors on form
	if (count($errors) == 0) {
		$password = md5($password);

		$query = "SELECT * FROM login WHERE nic='$nic' AND password='$password' LIMIT 1";
		$results = mysqli_query($db, $query);

		if (mysqli_num_rows($results) == 1) { // user found

			// check if user is admin or user
			$logged_in_user = mysqli_fetch_assoc($results);
			if ($logged_in_user['user_type'] == 'admin') {
				$_SESSION['user'] = $logged_in_user;
				$sqluser = mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM admin WHERE adminNic = '$nic'"));

				$_SESSION['user_data'] = $sqluser;
				$_SESSION['success']  = "You are now logged in";

				// //if user checked remeber me checkbox 
				if (isset($_POST['rememberme'])) {
					$cookie_name = "user";
					$cookie_value = "John Doe";
					setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 day
				}
				header('location: ../admin/index.php');
			} elseif ($logged_in_user['user_type'] == 'user') {

				$_SESSION['user'] = $logged_in_user;
				$sqluser = mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM customer WHERE customerNic = '$nic'"));

				$_SESSION['user_data'] = $sqluser;
				$_SESSION['success']  = "You are now logged in";

				// //if user checked remeber me checkbox 
				if (isset($_POST['rememberme'])) {
					$cookie_name = "loggedin";
					$cookie_value = $nic;
					setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 day
				}

				if (isset($_SESSION['url'])) {
					header('location:' . $_SESSION['url']);
				} else {
					header('location: ../index.php');
				}
			} elseif ($logged_in_user['user_type'] == 'driver') {

				$_SESSION['user'] = $logged_in_user;
				$sqluser = mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM driver WHERE driverNic = '$nic'"));

				$_SESSION['user_data'] = $sqluser;
				$_SESSION['success']  = "You are now logged in";
				header('location: ../driver/home.php');
			} elseif ($logged_in_user['user_type'] == 'cashier') {

				$_SESSION['user'] = $logged_in_user;
				$sqluser = mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM cashier WHERE cashierNic = '$nic'"));

				$_SESSION['user_data'] = $sqluser;
				$_SESSION['success']  = "You are now logged in";
				header('location: ../cashier/home.php');
            }
            elseif ($logged_in_user['user_type'] == 'removed') {
                $_SESSION['loginError'] = "removed";
                header('location: ../php/message.php');
            }
            else{
                $_SESSION['loginError'] = "notactivated";
                $_SESSION['notactivated'] = $nic;
                header('location: ../php/message.php');
            }
		} else {
			array_push($errors, "Invalid credentials");
			//header("../contactus.php");
		}
	}
}

if (isset($_POST['change_password'])) {
	changePassword();
}

function changePassword()
{
	global $db;
	$pw1 = md5($_POST['password1']);
	$n2 = $_POST['cnic'];
	$upid = "UPDATE login SET nic = '$n2', password = '$pw1'";
	mysqli_query($db, $upid);
	header('location: ../user/profile.php');
}
