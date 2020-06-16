<?php include('php/dbconfig.php'); 
session_start();
 
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
  <link href="../assets/css/material-dashboard.css?v=2.1.2" rel="stylesheet" />

  <link href="../assets/demo/demo.css" rel="stylesheet" />
</head>

<body class="">
<!--DISPLAY ALERT BOOKING DETAILS CONFIRMED AND MESSAGES SENT-->
<?php

if(isset($_SESSION['sendMsg'])){?>
<script>
  window.alert("Confirmed and Sent emails");
</script>
<?php
unset($_SESSION['sendMsg']);
}
?>

  <div class="wrapper ">
    <div class="sidebar" data-color="purple" data-background-color="white" data-image="../assets/img/sidebar-1.jpg">

      <div class="logo"><a href="#" class="simple-text logo-normal">
          Cashier Dashboard
        </a></div>
      <div class="sidebar-wrapper">
        <ul class="nav">
          <li class="nav-item ">
            <a class="nav-link" href="dashboard.php">
              <i class="material-icons">dashboard</i>
              <p>Dashboard</p>
            </a>
          </li>

          <li class="nav-item">

            <a class="nav-link" href="create.php">
              <i class="material-icons">person</i>
              <p>Manage Accounts</p>
            </a>
          </li>

          <li class="nav-item active ">
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

      </nav>
      <!-- End Navbar -->
      <div class="content">
        <div class="container-fluid">

        <!-- /////////////////////////////////////NEW BOOKINGS/////////////////////////////////// -->

          <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header card-header-primary row">
                 
                  <div class="col-3">
                      
                      <h4 class="card-title ">New Bookings</h4>
                    </div>
                    <div class="col">
                      <input class="form-control" style="color: white;" onkeyup="newBookings();" id="newInput" type="search" placeholder="Search" aria-label="Search">
                    </div>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    
                    <table class="table" id="new">
                      <thead class=" text-primary">

                        <th>Booking ID</th>
                        <th>Payement ID</th>
                        <th>Total Charges</th>
                        <th>Origin</th>
                        <th>Destination</th>
                        <th>Vehicle Type</th>
                        <th>Tour Time</th>
                        <th>Tour Date</th>
                        <th>Customer NIC</th>
                      </thead>
                      <?php
                      $sql1 = "SELECT * FROM booking where status != 'completed' and status!='notcompleted' and status !='cancelled'";
                      if ($result1 = mysqli_query($db, $sql1)) : ?>
                        <tbody>
                          <?php while ($row1 = mysqli_fetch_array($result1)) : ?>
                            <?php echo "<tr>"; ?>
                            <?php
                            $sqlBid = $row1['bookingId'];
                            $sql2 = "SELECT * FROM onlinepayment WHERE bookingId = '$sqlBid'";
                            $result2 = mysqli_query($db, $sql2);
                            $row2 = mysqli_fetch_array($result2);
                            ?>
                            <?php echo "<td>" . $row1['bookingId'] . "</td>"; ?>
                            
                            <?php
                            $pid = $row1['bookingId'];
                            $sql3 = "SELECT * FROM onlinepayment WHERE bookingId = '$pid'";
                            $result3 = mysqli_query($db, $sql3);
                            $payFetch = mysqli_fetch_assoc($result3);

                            ?>
                            
                            <?php echo "<td>" . $payFetch['paymentId']  . "</button></td>"; ?>
                            
                            
                            <?php
                            
                            $st = $payFetch['paymentType'];

                            $ch = $payFetch['charges'];
                            $tot = 0;

                            if ($st == "advanced"){
                              $tot = $ch * 5;
                            }else{
                              $tot = $ch;
                            }

                            ?>
                            <?php echo "<td> $tot </td>"; ?>
                            <?php echo "<td>" . $row1['origin'] . "</td>"; ?>
                            <?php echo "<td>" . $row1['destination'] . "</td>"; ?>
                            <?php echo "<td>" . $row1['vehicleType'] . "</td>"; ?>

                            <!--VEHICLE NO DROP DOWN-->
                            
                            <?php echo "<form action='php/action.php' method='POST'>"?>
                            <?php

                            $td = $row1['tourDate'];
                            $vehicleType = $row1['vehicleType'];
                            $vehicles = "SELECT vehicleNo FROM vehicle WHERE vehicleType = '$vehicleType' AND vehicleNo NOT IN (SELECT vehicleNo FROM booking WHERE vehicleType = '$vehicleType' and STATUS = 'notcompleted' AND tourDate = '$td')";

                            if ($resVehicles = mysqli_query($db, $vehicles)) : ?>

                              
                            <?php endif ?>


                            <?php echo "<td>" . $row1['tourTime'] . "</td>"; ?>
                            <?php echo "<td>" . $td . "</td>"; ?>
                            <?php echo "<td>" ?>
                            <?php
                            $sqlDriverNic = "SELECT driver.driverNic FROM driver WHERE driver.driverNic NOT IN (SELECT booking.driverNic FROM booking where STATUS = 'notcompleted' AND booking.tourDate = '$td' )";
                            $sql4 = mysqli_query($db, $sqlDriverNic);
                            ?>
                            
                            <?php echo "</td>"; ?>

                            <?php echo "<td>" . $row1['customerNic'] . "</td>"; ?>
                            <?php echo "<input type='hidden' name = 'confirmBID' value ='".$row1['bookingId']."' readonly>";?>
                            
                            <?php echo "</form>"?>
                            
                            <?php echo "</tr>"; ?>
                            
                          <?php endwhile ?>

                        </tbody>
                        <?php mysqli_free_result($result1); ?>
                      <?php endif ?>
                    </table>
                  </div>
                </div>
              </div>

            </div>
          </div>

          <!-- ////////////////////////////CONFIRMED BOOKINGS BY CASHIER /////////////////////////////////////////////// -->

          <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header card-header-primary row">
                  <div class="col-3">
                      <h4 class="card-title ">Confirmed Bookings</h4>

                    </div>
                    <div class="col">
                      <input class="form-control" style="color: white;" onkeyup="confirmedBookings();" id="confirmedInput" type="search" placeholder="Search" aria-label="Search">
                    </div>

                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table" id="confirmed">
                      <thead class=" text-primary">

                        <th>Booking ID</th>
                        <th>Payement ID</th>
                        <th>Total Charges</th>
                        <th>Origin</th>
                        <th>Destination</th>
                        <th>Vehicle Type</th>
                        <th>Vehicle Number</th>
                        <th>Tour Time</th>
                        <th>Tour Date</th>
                        <th>Driver NIC</th>
                        <th>Customer NIC</th>
                      </thead>
                      <?php
                      $sql1Conf = "SELECT * FROM booking where status='notcompleted' ";
                      if ($result1Conf = mysqli_query($db, $sql1Conf)) : ?>
                        <tbody>
                          <?php while ($row1Conf = mysqli_fetch_array($result1Conf)) : ?>
                            <?php echo "<tr>"; ?>
                            <?php
                            $sqlBidConf = $row1Conf['bookingId'];
                            $sql2Conf = "SELECT * FROM onlinepayment WHERE bookingId = '$sqlBidConf'";
                            $result2Conf = mysqli_query($db, $sql2Conf);
                            $row2Conf = mysqli_fetch_array($result2Conf);
                            ?>
                            <?php echo "<td>" . $row1Conf['bookingId'] . "</td>"; ?>
                            <?php
                            $pidConf = $row1Conf['bookingId'];
                            $sql3Conf = "SELECT * FROM onlinepayment WHERE bookingId = '$pidConf'";
                            $result3Conf = mysqli_query($db, $sql3Conf);
                            $payFetchConf = mysqli_fetch_assoc($result3Conf);

                            ?>
                            
                            <?php echo "<td>" . $payFetchConf['paymentId']  . "</td>"; ?>

                            <?php

                            $stConf = $payFetchConf['paymentType'];

                            $chConf = $payFetchConf['charges'];
                            $totConf = 0;
                            if ($stConf == "advanced") {
                              $totConf = $chConf * 5;
                            } else {
                              $totConf = $chConf;
                            }
                            ?>
                            <?php echo "<td> $totConf </td>"; ?>
                            <?php echo "<td>" . $row1Conf['origin'] . "</td>"; ?>
                            <?php echo "<td>" . $row1Conf['destination'] . "</td>"; ?>
                            <?php echo "<td>" . $row1Conf['vehicleType'] . "</td>"; ?>
                            <?php echo "<td>" . $row1Conf['vehicleNo'] . "</td>"; ?>
                            <?php echo "<td>" . $row1Conf['tourTime'] . "</td>"; ?>
                            <?php echo "<td>" . $row1Conf['tourDate'] . "</td>"; ?>
                            <?php echo "<td>" . $row1Conf['driverNic'] . "</td>"; ?> 
                            <?php echo "<td>" . $row1Conf['customerNic'] . "</td>"; ?>
                            <?php
                            //if customer needs to cancel 
                            //$rbId = $row1Conf['bookingId'];
                            //echo "<td><a >Cancel</a></td>" ?>
                            <?php echo "</tr>"; ?>
                          <?php endwhile ?>

                        </tbody>
                        <?php mysqli_free_result($result1Conf); ?>
                      <?php endif ?>
                    </table>
                  </div>
                </div>
              </div>

            </div>
          </div>
          
          <!-- /////////////////////////////////////CANCELLED BOOKINGS////////////////////////////////////////////////////////////// -->

          <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header card-header-primary row">
                  
                  <div class="col-3">
                  <h4 class="card-title ">Cancelled Bookings</h4>

                    </div>
                    <div class="col">
                      <input class="form-control" style="color: white;" onkeyup="cancelledBookings();" id="cancelledInput" type="search" placeholder="Search" aria-label="Search">
                    </div>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table" id="cancelled">
                      <thead class=" text-primary">

                        <th>Booking ID</th>
                        <th>Payement ID</th>
                        <th>Total Charges</th>
                        <th>Current Payment</th>
                        <th>Origin</th>
                        <th>Destination</th>
                        <th>Vehicle Type</th>
                        <th>Tour Time</th>
                        <th>Tour Date</th>
                        <th>Customer NIC</th>
                      </thead>
                      <?php
                      $sqlCancelled = "SELECT * FROM booking where status ='cancelled'";
                      if ($resultCancelled = mysqli_query($db, $sqlCancelled)) : ?>
                        <tbody>
                          <?php while ($rowCancelled = mysqli_fetch_array($resultCancelled)) : ?>
                            <?php echo "<tr>"; ?>
                            <?php
                            $sqlBidCancelled = $rowCancelled['bookingId'];
                            $sqlCancelled2 = "SELECT * FROM onlinepayment WHERE bookingId = '$sqlBidCancelled'";
                            $resultCancelled2 = mysqli_query($db, $sqlCancelled2);
                            $rowCancelled2 = mysqli_fetch_array($resultCancelled2);
                            ?>
                            <?php echo "<td>" . $rowCancelled['bookingId'] . "</td>"; ?>
                            <?php
                            $pidCancelled = $rowCancelled['bookingId'];
                            $sqlCancelled3 = "SELECT * FROM onlinepayment WHERE bookingId = '$pidCancelled'";
                            $resultCancelled3 = mysqli_query($db, $sqlCancelled3);
                            $payFetchCancelled = mysqli_fetch_assoc($resultCancelled3);

                            ?>
                            
                            <?php echo "<td>" . $payFetchCancelled['paymentId'] . "</td>"; ?>

                            <?php

                            $stCancelled = $payFetchCancelled['paymentType'];

                            $chCancelled = $payFetchCancelled['charges'];
                            $totCancelled = 0;
                            if ($stCancelled == "advanced") {
                              $totCancelled = $chCancelled * 5;
                            } else {
                              $totCancelled = $chCancelled;
                            }
                            ?>
                            <?php echo "<td> $totCancelled </td>"; ?>
                            <?php echo "<td> $chCancelled </td>"; ?>
                            <?php echo "<td>" . $rowCancelled['origin'] . "</td>"; ?>
                            <?php echo "<td>" . $rowCancelled['destination'] . "</td>"; ?>
                            <?php echo "<td>" . $rowCancelled['vehicleType'] . "</td>"; ?>
                            <?php echo "<td>" . $rowCancelled['tourTime'] . "</td>"; ?>
                            <?php echo "<td>" . $rowCancelled['tourDate'] . "</td>"; ?>
                            <?php echo "<td>" . $rowCancelled['customerNic'] . "</td>"; ?>
                            <?php echo "</tr>"; ?>
                          <?php endwhile ?>

                        </tbody>
                        <?php mysqli_free_result($resultCancelled); ?>
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

  </div>
  </div>
  </div>
  </div>

   <!-- SEARCH NEW BOOKINGS TABLE -->
<script>
function newBookings() {
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("newInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("new");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[0];
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        td = tr[i].getElementsByTagName("td")[1];
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        td = tr[i].getElementsByTagName("td")[6];
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        td = tr[i].getElementsByTagName("td")[8];
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        td = tr[i].getElementsByTagName("td")[9];
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        td = tr[i].getElementsByTagName("td")[10];
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }
      }
    }  
      }
    }  
      }
    }  
      }
    }  
      }
    }       
  }
}
</script>

 <!-- SEARCH CONFIRMED TABLE -->
 <script>
function confirmedBookings() {
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("confirmedInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("confirmed");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[0];
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        td = tr[i].getElementsByTagName("td")[1];
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        td = tr[i].getElementsByTagName("td")[6];
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        td = tr[i].getElementsByTagName("td")[8];
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        td = tr[i].getElementsByTagName("td")[9];
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        td = tr[i].getElementsByTagName("td")[10];
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }  
      }
    }  
      }
    }  
      }
    }  
      }
    }  
      }
    }       
  }
}
</script>
 <!-- SEARCH CANCELLED TABLE -->
 <script>
function cancelledBookings() {
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("cancelledInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("cancelled");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[0];
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        td = tr[i].getElementsByTagName("td")[1];
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        td = tr[i].getElementsByTagName("td")[9];
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }  
      }
    }  
      }
    }       
  }
}
</script>
  <!--   Core JS Files   -->
  <script src="../assets/js/core/jquery.min.js"></script>
  <script src="../assets/js/core/popper.min.js"></script>
  <script src="../assets/js/core/bootstrap-material-design.min.js"></script>
  <script src="../assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>

</body>

</html>