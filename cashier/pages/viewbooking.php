<?php include('php/dbconfig.php'); ?>
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
if(isset($_SESSION['sendMessagesandConfirmBooking'])){
  echo "";
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
            <a class="nav-link" href="./Cashier.php">
              <i class="material-icons">dashboard</i>
              <p>Cashier Dashboard</p>
            </a>
          </li>

          <li class="nav-item">

            <a class="nav-link" href="view.php">
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
                <div class="card-header card-header-primary">
                  <h4 class="card-title ">Booking Details</h4>

                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    
                    <table class="table">
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
                        <th>Confirm</th>
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
                            <!-- Button trigger order details modal -->
                            <?php echo "<td><button type='button' class='btn btn-link' data-toggle='modal' data-target='#orderDetails'>" . $payFetch['paymentId']  . "</button></td>"; ?>
                            <!-- Order details Modal -->
                            <div class="modal fade" id="orderDetails" tabindex="-1" role="dialog" aria-labelledby="orderDetailsLongTitle" aria-hidden="true">
                              <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLongTitle"><b>PAYMENT DETAILS</b></h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                    </button>
                                  </div>
                                  <div class="modal-body">
                                    <?php
                                    echo "<p>Payment Id : " . $payFetch['paymentId'] . "</p>";
                                    echo "<p>Booking Id  : " . $payFetch['bookingId'] . "</p>";
                                    echo "<p>Pay Date  : " . $payFetch['payDate'] . "</p>";
                                    echo "<p>Payment  : " . $payFetch['charges'] . "</p>";
                                    echo "<p>Payment Type  : " . $payFetch['paymentType'] . "</p>";
                                    echo "<p>Name on Card  : " . $payFetch['nameOnCard'] . "</p>";
                                    ?>
                                  </div>
                                </div>
                              </div>
                            </div>
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

                              <?php echo "<td>"; ?>
                              <?php echo "<select required name='selVehicle' class='form-control' id='exampleFormControlSelect1'>"; ?>
                              <?php echo "<option value=''>--SELECT VEHICLE--</option>" ?>
                              <?php while ($rowVeh = mysqli_fetch_array($resVehicles)) : ?>
                                <?php echo "<option>" . $rowVeh['vehicleNo'] . "</option>";

                                echo  $td;
                                ?>
                              <?php endwhile ?>
                              <?php echo "</select>"; ?>
                              <?php echo "</td>"; ?>
                            <?php endif ?>


                            <?php echo "<td>" . $row1['tourTime'] . "</td>"; ?>
                            <?php echo "<td>" . $td . "</td>"; ?>
                            <?php echo "<td>" ?>
                            <?php
                            $sqlDriverNic = "SELECT driver.driverNic FROM driver WHERE driver.driverNic NOT IN (SELECT booking.driverNic FROM booking where STATUS = 'notcompleted' AND booking.tourDate = '$td' )";
                            $sql4 = mysqli_query($db, $sqlDriverNic);
                            ?>
                            <?php echo "<select required name='selDriver' class='form-control' id='exampleFormControlSelect1'>"; ?>
                            <?php echo "<option value=''>--SELECT DRIVER--</option>" ?>
                            <?php while ($resDriverNic = mysqli_fetch_assoc($sql4)) : ?>
                              <?php echo "<option>" . $resDriverNic['driverNic'] . "</option>" ?>
                            <?php endwhile ?>
                            <?php echo "</select>"; ?>
                            <?php echo "</td>"; ?>

                            <?php echo "<td>" . $row1['customerNic'] . "</td>"; ?>
                            <?php echo "<input type='hidden' name = 'confirmBID' value ='".$row1['bookingId']."' readonly>";?>
                            <?php echo "<td><button type='submit'>Confirm</button></td>" ?>
                            <?php echo "</form>"?>
                            <?php
                            $rbId = $row1['bookingId'];
                            echo "<td><a href=php/remove.php?rembooking=$rbId>Remove</a></td>" ?>
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
                <div class="card-header card-header-primary">
                  <h4 class="card-title ">Confirmed Bookings</h4>

                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table">
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
                            <!-- Button trigger order details modal -->
                            <?php echo "<td><button type='button' class='btn btn-link' data-toggle='modal' data-target='#orderDetails'>" . $payFetchConf['paymentId']  . "</button></td>"; ?>

                            <!-- Order details Modal -->
                            <div class="modal fade" id="orderDetails" tabindex="-1" role="dialog" aria-labelledby="orderDetailsLongTitle" aria-hidden="true">
                              <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLongTitle"><b>PAYMENT DETAILS</b></h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                    </button>
                                  </div>
                                  <div class="modal-body">
                                    <?php
                                    echo "<p>Payment Id : " . $payFetchConf['paymentId'] . "</p>";
                                    echo "<p>Booking Id  : " . $payFetchConf['bookingId'] . "</p>";
                                    echo "<p>Pay Date  : " . $payFetchConf['payDate'] . "</p>";
                                    echo "<p>Payment  : " . $payFetchConf['charges'] . "</p>";
                                    echo "<p>Payment Type  : " . $payFetchConf['paymentType'] . "</p>";
                                    echo "<p>Name on Card  : " . $payFetchConf['nameOnCard'] . "</p>";
                                    ?>
                                  </div>
                                </div>
                              </div>
                            </div>
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
                <div class="card-header card-header-primary">
                  <h4 class="card-title ">Cancelled Bookings</h4>

                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table">
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
                            <!-- Button trigger order details modal -->
                            <?php echo "<td><button type='button' class='btn btn-link' data-toggle='modal' data-target='#orderDetails'>" . $payFetchCancelled['paymentId'] . "</button></td>"; ?>

                            <!-- Order details Modal -->
                            <div class="modal fade" id="orderDetails" tabindex="-1" role="dialog" aria-labelledby="orderDetailsLongTitle" aria-hidden="true">
                              <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLongTitle"><b>PAYMENT DETAILS</b></h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                    </button>
                                  </div>
                                  <div class="modal-body">
                                    <?php
                                    echo "<p>Payment Id : " . $payFetchCancelled['paymentId'] . "</p>";
                                    echo "<p>Booking Id  : " . $payFetchCancelled['bookingId'] . "</p>";
                                    echo "<p>Pay Date  : " . $payFetchCancelled['payDate'] . "</p>";
                                    echo "<p>Payment  : " . $payFetchCancelled['charges'] . "</p>";
                                    echo "<p>Name on Card  : " . $payFetchCancelled['nameOnCard'] . "</p>";
                                    ?>
                                  </div>
                                </div>
                              </div>
                            </div>
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
</body>

</html>