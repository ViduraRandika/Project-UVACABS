<?php 
include('php/dbconfig.php');
include('../../php/register.php');


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
    <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="../assets/img/favicon.png">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>

    </title>
    <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
    <!--     Fonts and icons     -->
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
    <!-- CSS Files -->
    <link href="../assets/css/new.css" rel="stylesheet" />
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
                    <li class="nav-item active  ">
                        <a class="nav-link" href="./Cashier.php">
                            <i class="material-icons">dashboard</i>
                            <p>Cashier Dashboard</p>
                        </a>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link" href="./view.php">
                            <i class="material-icons">person</i>
                            <p>Create Account</p>
                        </a>
                        <li class="nav-item active-pro ">
                            <a class="nav-link" href="./viewbooking.php">
                                <i class="material-icons">unarchive</i>
                                <p>View Booking Details</p>
                            </a>
                        </li>
                        <li class="nav-item active-pro ">
                            <a class="nav-link" href="Cashier.php?logout='1'">
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
            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-3 col-md-6 col-sm-6">
                            <div class="card card-stats">
                                <div class="card-header card-header-warning card-header-icon">
                                    <div class="card-icon">
                                        <i class="material-icons">local_taxi</i>
                                    </div>
                                    <p class="card-category">No of vehicles</p>
                                    <h3 class="card-title">
                                    <?php 
                                    $noOfVehicles = mysqli_num_rows(mysqli_query($db,"SELECT * FROM vehicle"));
                                    echo $noOfVehicles;
                                    ?>   
                                    </h3>
                                </div>
                                <div class="card-footer">
                                    <div class="stats">
                                       
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-6">
                            <div class="card card-stats">
                                <div class="card-header card-header-success card-header-icon">
                                    <div class="card-icon">
                                        <i class="material-icons">notifications_active</i>
                                    </div>
                                    <p class="card-category">New Bookings</p>
                                    <h3 class="card-title">
                                    <?php 
                                    $noOfNewBookings = mysqli_num_rows(mysqli_query($db,"SELECT * FROM booking WHERE status = 'pending'"));
                                    echo $noOfNewBookings;
                                    ?>    </h3>
                                </div>
                                <div class="card-footer">
                                    <div class="stats">
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-6">
                            <div class="card card-stats">
                                <div class="card-header card-header-primary card-header-icon">
                                    <div class="card-icon">
                                        <i class="material-icons">person</i>
                                    </div>
                                    <p class="card-category">Total Users</p>
                                    <h3 class="card-title">
                                        <?php
                                        echo mysqli_num_rows(mysqli_query($db,"SELECT * FROM login"));
                                        ?>

                                    </h3>
                                </div>
                                <div class="card-footer">
                                    <div class="stats">
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>


            <!--   Core JS Files   -->
            <script src="../assets/js/core/jquery.min.js"></script>
            <script src="../assets/js/core/popper.min.js"></script>
            <script src="../assets/js/core/bootstrap-material-design.min.js"></script>
            <script src="../assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
            
           
            <script>
                $(document).ready(function() {
                    // Javascript method's body can be found in assets/js/demos.js
                    md.initDashboardPageCharts();

                });
            </script>
</body>

</html>