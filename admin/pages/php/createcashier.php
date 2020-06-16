<?php
if(isset($_POST['createCashier'])){
    session_start();
    $nic    =  e($_POST['nic']);
	$password_1  =  e($_POST['password']);
    $password_2  =  e($_POST['cpassword']);
    $first_name = e($_POST['name']);
    $phone_number = e($_POST['pno']);
    $address = e($_POST['address']);

    $sql_u = "SELECT * FROM cashierr WHERE cashierContactNo='$phone_number'";
	$sql_e = "SELECT * FROM login WHERE nic='$nic'";
	$res_u = mysqli_query($db, $sql_u);
    $res_e = mysqli_query($db, $sql_e);
    
    if ($password_1 != $password_2) {
		$_SESSION['error']= "code1";
        header('location: ../createcash.php');
    }
	elseif ((strlen($password_1) < 6)) {
		$_SESSION['error']= "code2";
        header('location: ../createcash.php');
    }

	elseif ((strlen($phone_number) != 10)) {
		$_SESSION['error']= "code3";
        header('location: ../createcash.php');
    }elseif (mysqli_num_rows($res_u) > 0) {
		$_SESSION['error']= "code4";
        header('location: ../createcash.php');
	}

	elseif (mysqli_num_rows($res_e) > 0) {
		$_SESSION['error']= "code5";
        header('location: ../createcash.php');
	}
    
    else{
        $today = date('Y/m/d');
        $password = md5($password_1);
        $query = "INSERT INTO login (nic, password, user_type) VALUES('$nic','$password','cashier')";
		$query2 = "INSERT INTO cashier(cashierNic,cashierName,cashierAddress,cashierContactNo) VALUES ('$nic','$first_name','$address','$phone_number')";
        if(mysqli_query($db,$query1)){
            if(mysqli_query($db,$query2)){
                $_SESSION['success'] = "Customer added";
                header('location: ../createcash.php');
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