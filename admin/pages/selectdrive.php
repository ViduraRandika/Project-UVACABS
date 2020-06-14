<?php

//permissions
if(isset($_SESSION['user'])){
	if($_SESSION['user']['user_type'] == "cashier"){
		header('location: ../../cashier/index.php');
	}
	if($_SESSION['user']['user_type'] == "driver"){
		header('location: ../../driver/index.php');
    }
    if($_SESSION['user']['user_type'] == "customer"){
		header('location: ../../index.php');
	}
}
include('php/dbconfig.php');
if(isset($_GET['sd'])){
  $id = $_GET['sd'];
  $sql = "SELECT * FROM driver WHERE driverNic = '$id'";
  $result = mysqli_query($db,$sql);
  
  if(mysqli_num_rows($result)>0){
    $fetchdata = mysqli_fetch_assoc($result);
    $id2 = $fetchdata['driverNic'];
    $sql2 = "SELECT * FROM drivercontactno WHERE driverNic = '$id2'";
  
    if(mysqli_num_rows(mysqli_query($db,$sql2))>0){
       $fetchdata2 = mysqli_fetch_assoc(mysqli_query($db,$sql2));
    }
    $fname = $fetchdata['driverFname'];
    $lname = $fetchdata['driverLname'];
    $nic = $fetchdata['driverNic'];
    $email = $fetchdata['driverEmail'];
    $pno = $fetchdata2['driverContactNo'];
    $adress = $fetchdata['driverAddress'];
  }
  else{
    header('location: view.php');
  }
}
else{
  header('location: view.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />


 
  <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport'/>



  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
  <!-- CSS Files -->
  <link href="../assets/css/material-dashboard.css?v=2.1.2" rel="stylesheet" />
  <!-- CSS Just for demo purpose, don't include it in your project -->
  <link href="../assets/demo/demo.css" rel="stylesheet" />
</head>

<body class="">
  <div class="wrapper ">
    <div class="sidebar" data-color="purple" data-background-color="white" data-image="../assets/img/sidebar-1.jpg">
     
      <div class="logo"><a href="#" class="simple-text logo-normal">
        Cashier Dashboard
        </a></div>
      <div class="sidebar-wrapper">
        <ul class="nav">
          <li class="nav-item active ">
            <a class="nav-link" href="./Cashier.php">
              <i class="material-icons">dashboard</i>
              <p>Dashboard</p>
            </a>

          <li class="nav-item ">
              <a class="nav-link" href="./view.php">
                <i class="material-icons">person</i>
                <p>Create Account</p>
              </a>
              <li class="nav-item ">
                <a class="nav-link" href="./Cashier.php">
                  <i class="material-icons">unarchive</i>
                  <p>View Booking Details</p>
                </a>
              </li>

          </li>      
        </ul>
      </div>
    </div>
    <div class="main-panel">
      <!-- Navbar -->
      
      <!-- End Navbar -->
    

      <div class="container-fluid">
 
        <form>
         <b><h3>Driver Details</h3></b>


          <div class="form-group">
            <p><b>First Name</b></p>
            <input type="text" class="form-control" value="<?php echo $fname;?>" readonly>
            </div>
          <div class="form-group">
            <p><b>Last Name</b></p>
            <input type="text" class="form-control" id="#" value="<?php echo $lname;?>" readonly >
          </div>

          <div class="form-group">
            <p><b>NIC</b></p>
            <input type="text" class="form-control" id="#" value="<?php echo $nic;?>" readonly>
          </div>
         
          <div class="form-group">
            <p><b>Email</b></p>
            <input type="email" class="form-control" id="#" value="<?php echo $email;?>" readonly>
          </div>

          <div class="form-group">
            <p><b>Phone Number</b></p>
            <input type="text" class="form-control" id="#" value="<?php echo $pno;?>" readonly>
          </div>
         
          <div class="form-group">
            <p><b>Address</b></p>
            <input type="text" class="form-control" id="#" value="<?php echo $adress;?>" readonly>
          </div>
         
    
         
         
         
        </form>
        </div>

</body>

</html>