<?php

if (isset($_POST['createDriver'])) {
    session_start();
    $nic    = $_POST['nic'];
	$email       =  $_POST['email'];
	$password_1  =  $_POST['password'];
    $password_2  =  $_POST['cpassword'];
    $first_name = $_POST['fname'];
    $last_name = $_POST['lname'];
    $phone_number = $_POST['pno'];
    $address = $_POST['address'];

    $sql_u = "SELECT * FROM drivercontactno WHERE driverContactNo='$phone_number'";
	$sql_e = "SELECT * FROM login WHERE nic='$nic'";
	$sql_n = "SELECT * FROM driver WHERE driverEmail='$email'";
	$res_u = mysqli_query($db, $sql_u);
	$res_e = mysqli_query($db, $sql_e);
    $res_n = mysqli_query($db, $sql_n);
    
    if ($password_1 != $password_2) {
		$_SESSION['error']= "code1";
        header('location: ../createcus.php');
    }
	elseif ((strlen($password_1) < 6)) {
		$_SESSION['error']= "code2";
        header('location: ../createcus.php');
    }

	elseif ((strlen($phone_number) != 10)) {
		$_SESSION['error']= "code3";
        header('location: ../createcus.php');
    }elseif (mysqli_num_rows($res_e) > 0) {
		$_SESSION['error']= "code4";
        header('location: ../createcus.php');
	}

	elseif (mysqli_num_rows($res_n) > 0) {
		$_SESSION['error']= "code5";
        header('location: ../createcus.php');
    }elseif (mysqli_num_rows($res_u) > 0) {
		$_SESSION['error']= "code6";
        header('location: ../createcus.php');
	}else{
        $today = date('Y/m/d');
        $password = md5($password_1);
        $query1 = "INSERT INTO login (nic, password, user_type) VALUES('$nic','$password','driver')";
        $query2 = "INSERT INTO  driver(driverNic,driverFname,driverLname,driverAddress,driverEmail) VALUES  ('$nic','$first_name','$last_name','$address','$email')";
        $query3 = "INSERT INTO drivercontactno (driverNic,driverContactNo) VALUES ('$nic','$phone_number')";
        if(mysqli_query($db,$query1)){
            if(mysqli_query($db,$query2)){
                if(mysqli_query($db,$query3)){
                    $_SESSION['success'] = "Driver added";
                    header('location: ../createdriv.php');
                }else{
                    echo "error in query3";
                }
               
            }else{
                echo "error in query2";
            }
        }else{
            echo "Error in query1";
        }
    }
}else{
    header('location: ../../index.php');
}


?>