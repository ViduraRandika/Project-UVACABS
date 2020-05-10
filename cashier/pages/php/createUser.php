<?php include('dbconfig.php');
$nic = "";
$email    = "";
$first_name ="";
$last_name = "";
$phone_number = "";
$address = "";
$errors   = array(); 
?>
<?php 
if (isset($_POST['createCus'])) {
	register();
}

function register(){
    global $db, $errors, $nic, $email;
    $nic    =  e($_POST['nic']);
	$email       =  e($_POST['email']);
	$password_1  =  e($_POST['password']);
    $password_2  =  e($_POST['cpassword']);
    $first_name = e($_POST['fname']);
    $last_name = e($_POST['lname']);
    $phone_number = e($_POST['pno']);
    $address = e($_POST['address']);
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
    if (count($errors) == 0){
        $password = md5($password_1);
        $user_type="user";
        $today = date('Y/m/d');
        $query = "INSERT INTO login (nic, password, user_type) VALUES('$nic','$password','$user_type');INSERT INTO customer(customerNic,customerFname,customerLname,customerAddress,customerEmail,customerContactNo,customerRegDate,nic) VALUES ('$nic','$first_name','$last_name','$address','$email','$phone_number','$today','$nic');";
        mysqli_multi_query($db, $query);
        $_SESSION['success'];
        header('location: ../pages/view.php');
    }
}


//cashier registration
if (isset($_POST['createCashier'])) {
	registerCashier();
}

function registerCashier(){

global $db, $errors, $nic, $email;
    $nic    =  e($_POST['nic']);
	$password_1  =  e($_POST['password']);
    $password_2  =  e($_POST['cpassword']);
    $first_name = e($_POST['name']);
    $phone_number = e($_POST['pno']);
    $address = e($_POST['address']);
    if (empty($nic)) { 
		array_push($errors, "nic is required"); 
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
    $sql_u = "SELECT * FROM cashierr WHERE cashierContactNo='$phone_number'";
	$sql_e = "SELECT * FROM login WHERE nic='$nic'";
	$res_u = mysqli_query($db, $sql_u);
	$res_e = mysqli_query($db, $sql_e);

	if (mysqli_num_rows($res_u) > 0) {
		array_push($errors, "Sorry... phone number already taken");
	}

	if (mysqli_num_rows($res_e) > 0) {
		array_push($errors, "Sorry... nic already taken");
	}

	
    if (count($errors) == 0){
        $password = md5($password_1);
        $user_type="user";
        $today = date('Y/m/d');
        $query = "INSERT INTO login (nic, password, user_type) VALUES('$nic','$password','$user_type');INSERT INTO cashier(cashierNic,cashierName,cashierAddress,cashierContactNo,nic) VALUES ('$nic','$first_name','$address','$phone_number','$nic');";
        mysqli_multi_query($db, $query);
        $_SESSION['success'];
        header('location: ../pages/view.php');
    }
}

//Driver registration
if (isset($_POST['createDriver'])) {
	registerDriver();
}

function registerDriver(){
	global $db, $errors, $nic, $email;
    $nic    =  e($_POST['nic']);
	$email       =  e($_POST['email']);
	$password_1  =  e($_POST['password']);
    $password_2  =  e($_POST['cpassword']);
    $first_name = e($_POST['fname']);
    $last_name = e($_POST['lname']);
    $phone_number = e($_POST['pno']);
    $address = e($_POST['address']);
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
    $sql_u = "SELECT * FROM drivercontactno WHERE driverContactNo='$phone_number'";
	$sql_e = "SELECT * FROM login WHERE nic='$nic'";
	$sql_n = "SELECT * FROM driver WHERE driverEmail='$email'";
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
    if (count($errors) == 0){
        $password = md5($password_1);
        $user_type="user";
        $today = date('Y/m/d');
        $query = "INSERT INTO login (nic, password, user_type) VALUES('$nic','$password','$user_type');INSERT INTO driver(driverNic,driverFname,driverLname,driverAddress,driverEmail,nic) VALUES ('$nic','$first_name','$last_name','$address','$email','$nic');INSERT INTO drivercontactno(driverNic,driverContactNo) VALUES ('$nic','$phone_number')";
        mysqli_multi_query($db, $query);
        $_SESSION['success'];
        header('location: ../pages/view.php');
    }

}


function e($val){
	global $db;
	return mysqli_real_escape_string($db, trim($val));
}
?>

