<?php 
session_start();
 
if (isset($_SESSION['user'])) {
  if ($_SESSION['user']['user_type'] == "admin") {
    header('location: ../../admin/index.php');
  }
  if ($_SESSION['user']['user_type'] == "driver") {
    header('location: ../../driver/index.php');
  }
  if ($_SESSION['user']['user_type'] == "user") {
    header('location: ../../index.php');
  }
}else{
  header('location: ../../user/login.php');
}

 ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />



    <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />



    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
    <!-- CSS Files -->
    <link href="../assets/css/material-dashboard.css?v=2.1.2" rel="stylesheet" />
    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link href="../assets/demo/demo.css" rel="stylesheet" />
</head>

<body class="">
<?php
  if(isset($_SESSION['error'])){
      if($_SESSION['error'] == "code1"){?>
      <script>window.alert("Vehicle Number already exixt");</script>
    <?php
      unset($_SESSION['error']);
    }
  }
      ?>
   <?php
  if(isset($_SESSION['vehadded'])){
    ?>
    <script>window.alert("Record added");</script>
    <?php
    unset($_SESSION['vehadded']);
  }
  
  ?>
    <div class="wrapper ">
        <div class="sidebar" data-color="purple" data-background-color="white" data-image="../assets/img/sidebar-1.jpg">

            <div class="logo"><a href="#" class="simple-text logo-normal">
                    Admin Dashboard
                </a></div>
            <div class="sidebar-wrapper">
                <ul class="nav">
                    <li class="nav-item ">
                        <a class="nav-link" href="./Cashier.php">
                            <i class="material-icons">dashboard</i>
                            <p>Cashier Dashboard</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./view.php">
                            <i class="material-icons">content_paste</i>
                            <p>Create Account</p>
                        </a>
                    </li>
                    <li class="nav-item ">
            <a class="nav-link" href="viewbooking.php">
              <i class="material-icons">unarchive</i>
              <p>View Booking Details</p>
            </a>
          </li>
          <li class="nav-item active">
                        <a class="nav-link" href="./vehicle.php">
                            <i class="material-icons">local_taxi</i>
                            <p>Vehicles</p>
                        </a>
                    </li>
                    <li class="nav-item active-pro ">
                            <a class="nav-link" href="php/function.php?logout='1'">
                                <i class="material-icons">save_alt</i>
                                <p>LOGOUT</p>
                            </a>
                        </li>
                </ul>
            </div>
        </div>
        <div class="main-panel">
            <!-- Navbar -->

            <!-- End Navbar -->


            <div class="container-fluid">

                <form action="php/createvehicle.php" method="post">
                    
                    <div class="form-group">
                        <p><b>Vehicle number</b></p>
                        <input type="text" class="form-control" placeholder="Enter vehicle number" name="vehNo" required> 
                    </div>

                    <div class="form-group">
                    <p><b>Vehicle Type</b></p>
                        <input type="radio" class="" id="#" style="margin: 10px;" name="vehType" value="Car" required><span>Car</span>
                        <input type="radio" class="" id="#" style="margin: 10px;" name="vehType" value="Van(Non Ac)" required><span>Van(Non Ac)</span>
                        <input type="radio" class="" id="#" style="margin: 10px;" name="vehType" value="Van(Ac)" required><span>Van(Ac)</span>
                    </div>

                   


                    <input type="submit" class="btn btn-primary" name="createVehicle"></input>
                </form>
            </div>

</body>

</html>