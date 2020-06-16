
<?php 
session_start();
 
if (isset($_SESSION['user'])) {
  if ($_SESSION['user']['user_type'] == "admin") {
    header('location: ../../admin/index.php');
  }
  if ($_SESSION['user']['user_type'] == "cashier") {
    header('location: ../../cashier/index.php');
  }
  if ($_SESSION['user']['user_type'] == "user") {
    header('location: ../../index.php');
  }
}else{
  header('location: ../../user/login.php');
}

?>

<?php 
include('../../php/dbconfig.php');
$nic = $_SESSION['user_data']['driverNic'];
$sql1 = "SELECT * FROM booking INNER JOIN onlinepayment ON booking.bookingId = onlinepayment.bookingId WHERE booking.driverNic = '$nic' AND booking.status = 'completed'";

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
  <link href="../assets/css/new1.css" rel="stylesheet" />
 
  <link href="../assets/demo/demo.css" rel="stylesheet" />
</head>

<body class="">
  <?php 
  if(isset($_SESSION['completeBooking'])){
    ?>
    <script>window.alert("Tour completed");</script>
    <?php
    unset($_SESSION['completeBooking']);
  }
  ?>
  <div class="wrapper ">
    <div class="sidebar" data-color="purple" data-background-color="white" data-image="../assets/img/sidebar-1.jpg">
      
    <div class="logo"><a href="./Driver.html" class="simple-text logo-normal">
      Driver Dashboard
    </a></div>
  <div class="sidebar-wrapper">
    <ul class="nav">
      <li class="nav-item">
        <a class="nav-link" href="./driver.php">
          <i class="material-icons">dashboard</i>
          <p>Driver Dashboard</p>
        </a>
      </li>
      <li class="nav-item active ">
            <a class="nav-link" href="history.php">
              <i class="material-icons">unarchive</i>
              <p>History</p>
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
    
      </nav>
      <!-- End Navbar -->
      <div class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header card-header-primary">
                  <h4 class="card-title ">History</h4>
                  
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table">
                      <thead class=" text-primary">

                        <th>Origin</th>
                        <th>Destination</th>
                        <th>Date</th>
                        <th>Booking Id</th>
                      </thead>
                      
                      
                         <?php if ($result1 = mysqli_query($db, $sql1)) : ?>  
                      <tbody>
                      <?php while ($row = mysqli_fetch_array($result1)) : ?>
                        <tr>
                          <a>
                          <td><a href="viewbooking.php?bookingId=<?php echo $row['bookingId'];?>"><?php echo $row['origin'];?></a></td>
                          <td><a href="viewbooking.php?bookingId=<?php echo $row['bookingId'];?>"><?php echo $row['destination'];?></a></td>
                          <td><a href="viewbooking.php?bookingId=<?php echo $row['bookingId'];?>"><?php echo $row['tourDate'];?></a></td>
                          <td><a href="viewbooking.php?bookingId=<?php echo $row['bookingId'];?>"><?php echo $row['bookingId'];?></a></td>
                          
                          
                          <tr>
                        <?php endwhile ?>
                         </tbody>
                         <?php endif ?>
                    </table>
                  </div>
                </div>
              </div>
            </div>



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
</body>

</html>