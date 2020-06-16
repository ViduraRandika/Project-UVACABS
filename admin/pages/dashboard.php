<?php 
session_start();
 if(isset($_SESSION['success'])){
   unset($_SESSION['success']);
 }
if (isset($_SESSION['user'])) {
  if ($_SESSION['user']['user_type'] == "cashier") {
    header('location: ../../cashier/index.php');
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


      include('php/dbconfig.php');
      $sql1 = "SELECT count(*) FROM customer";
      $result1 = mysqli_query($db,$sql1);
      $c1 = mysqli_fetch_assoc($result1);
      $sql2 = "SELECT count(*) FROM driver";
      $result2 = mysqli_query($db,$sql2);
      $c2 = mysqli_fetch_assoc($result2);
      $sql3 = "SELECT count(*) FROM driver";
      $result3 = mysqli_query($db,$sql3);
      $c3 = mysqli_fetch_assoc($result3);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="../assets/img/favicon.png">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>
    Material Dashboard by Creative Tim
  </title>
  <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
  <!--     Fonts and icons     -->
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
  <!-- CSS Files -->
  <link href="../assets/css/new.css" rel="stylesheet" />
  <!-- CSS Just for demo purpose, don't include it in your project -->
  <link href="../assets/demo/demo.css" rel="stylesheet" />

  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Date', 'Customers'],
          <?php 
          $sql = "SELECT * FROM customer "
          ?>
          ['2004',  1000],
          ['2005',  1170],
          ['2006',  660],
          ['2007',  1030]
        ]);

        var options = {
          title: 'Customer Registration',
          curveType: 'function',
          legend: { position: 'bottom' }
        };

        var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));

        chart.draw(data, options);
      }
    </script>
</head>

<body class="">
  <div class="wrapper ">
    <div class="sidebar" data-color="purple" data-background-color="white" data-image="../assets/img/sidebar-1.jpg">
      <div class="logo"><a href="#" class="simple-text logo-normal">
          Admin Dashboard
        </a></div>
      <div class="sidebar-wrapper">
        <ul class="nav">
          <li class="nav-item active  ">
            <a class="nav-link" href="./dashboard.php">
              <i class="material-icons">dashboard</i>
              <p>Dashboard</p>
            </a>
          </li>
          <li class="nav-item ">
            <a class="nav-link" href="./create.php">
              <i class="material-icons">person</i>
              <p>Manage Accounts</p>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="viewbooking.php">
              <i class="material-icons">unarchive</i>
              <p>View Booking Details</p>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="vehicle.php">
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
  <!-- Plugin for the momentJs  -->
  <script src="../assets/js/plugins/moment.min.js"></script>
  <!--  Plugin for Sweet Alert -->
  <script src="../assets/js/plugins/sweetalert2.js"></script>
  <!-- Forms Validations Plugin -->
  <script src="../assets/js/plugins/jquery.validate.min.js"></script>
  <!-- Plugin for the Wizard, full documentation here: https://github.com/VinceG/twitter-bootstrap-wizard -->
  <script src="../assets/js/plugins/jquery.bootstrap-wizard.js"></script>
  <!--	Plugin for Select, full documentation here: http://silviomoreto.github.io/bootstrap-select -->
  <script src="../assets/js/plugins/bootstrap-selectpicker.js"></script>
  <!--  Plugin for the DateTimePicker, full documentation here: https://eonasdan.github.io/bootstrap-datetimepicker/ -->
  <script src="../assets/js/plugins/bootstrap-datetimepicker.min.js"></script>
  <!--  DataTables.net Plugin, full documentation here: https://datatables.net/  -->
  <script src="../assets/js/plugins/jquery.dataTables.min.js"></script>
  <!--	Plugin for Tags, full documentation here: https://github.com/bootstrap-tagsinput/bootstrap-tagsinputs  -->
  <script src="../assets/js/plugins/bootstrap-tagsinput.js"></script>
  <!-- Plugin for Fileupload, full documentation here: http://www.jasny.net/bootstrap/javascript/#fileinput -->
  <script src="../assets/js/plugins/jasny-bootstrap.min.js"></script>
  <!--  Full Calendar Plugin, full documentation here: https://github.com/fullcalendar/fullcalendar    -->
  <script src="../assets/js/plugins/fullcalendar.min.js"></script>
  <!-- Vector Map plugin, full documentation here: http://jvectormap.com/documentation/ -->
  <script src="../assets/js/plugins/jquery-jvectormap.js"></script>
  <!--  Plugin for the Sliders, full documentation here: http://refreshless.com/nouislider/ -->
  <script src="../assets/js/plugins/nouislider.min.js"></script>
  <!-- Include a polyfill for ES6 Promises (optional) for IE11, UC Browser and Android browser support SweetAlert -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/core-js/2.4.1/core.js"></script>
  <!-- Library for adding dinamically elements -->
  <script src="../assets/js/plugins/arrive.min.js"></script>
  <!--  Google Maps Plugin    -->
  <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>
  <!-- Chartist JS -->
  <script src="../assets/js/plugins/chartist.min.js"></script>
  <!--  Notifications Plugin    -->
  <script src="../assets/js/plugins/bootstrap-notify.js"></script>
  <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="../assets/js/material-dashboard.js?v=2.1.2" type="text/javascript"></script>
  <!-- Material Dashboard DEMO methods, don't include it in your project! -->
  <script src="../assets/demo/demo.js"></script>
  
  <script>
    $(document).ready(function() {
      // Javascript method's body can be found in assets/js/demos.js
      md.initDashboardPageCharts();

    });
  </script>
</body>

</html>