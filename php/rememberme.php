<?php
	 if(isset($_COOKIE['loggedin'])){
		$nic = $_COOKIE['loggedin'];
		$sqlUser = mysqli_query($db,"SELECT * FROM login WHERE nic = '$nic' AND user_type != 'removed' LIMIT 1");
		if(mysqli_num_rows($sqlUser)==1){
		$resUser = mysqli_fetch_assoc($sqlUser);
		$userType = $resUser['user_type'];
		$_SESSION['user'] = $resUser;
		if($userType == "admin"){
			$sqlUserData = mysqli_fetch_assoc(mysqli_query($db,"SELECT * FROM admin WHERE adminNic = '$nic'"));
			$_SESSION['user_data'] = $sqlUserData;
		}
		if($userType == "cashier"){
			$sqlUserData = mysqli_fetch_assoc(mysqli_query($db,"SELECT * FROM cashier WHERE cashierNic = '$nic'"));
			$_SESSION['user_data'] = $sqlUserData;
		}
		if($userType == "driver"){
			$sqlUserData = mysqli_fetch_assoc(mysqli_query($db,"SELECT * FROM driver WHERE driverNic = '$nic'"));
			$_SESSION['user_data'] = $sqlUserData;
		}
		if($userType == "user"){
			$sqlUserData = mysqli_fetch_assoc(mysqli_query($db,"SELECT * FROM customer WHERE customerNic = '$nic'"));
			$_SESSION['user_data'] = $sqlUserData;
		}
		}
	 }
	?>