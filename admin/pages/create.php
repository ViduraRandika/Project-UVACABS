<?php

//permissions
if (isset($_SESSION['user'])) {
  if ($_SESSION['user']['user_type'] == "cashier") {
    header('location: ../../cashier/index.php');
  }
  if ($_SESSION['user']['user_type'] == "driver") {
    header('location: ../../driver/index.php');
  }
  if ($_SESSION['user']['user_type'] == "customer") {
    header('location: ../../index.php');
  }
}


if (isset($_SESSION['success'])) {
  echo "<h5>Success</h5>";
  unset($_SESSION['success']);
}
?>
<?php include('../../php/dbconfig.php');
$sql1 = "SELECT * FROM customer INNER JOIN login ON customer.customerNic = login.nic WHERE login.user_type != 'removed'";
$sql2 = "SELECT * FROM driver INNER JOIN login ON driver.driverNic = login.nic WHERE login.user_type != 'removed'";
$sql3 = "SELECT * FROM cashier INNER JOIN login ON cashier.cashierNic = login.nic WHERE login.user_type != 'removed'"
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="../assets/img/favicon.png">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>User Details</title>
  <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
  <!--     Fonts and icons     -->
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
  <!-- CSS Files -->
  <link href="../assets/css/material-dashboard.css?v=2.1.2" rel="stylesheet" />
  <!-- CSS Just for demo purpose, don't include it in your project -->
  <link href="../assets/demo/demo.css" rel="stylesheet" />
</head>

<body class="">
  <?php
  if (isset($_SESSION['notfound'])) {
    echo "<h5>NIC NOT FOUND</h5>";
    unset($_SESSION['notfound']);
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
            <a class="nav-link" href="./dashboard.php">
              <i class="material-icons">dashboard</i>
              <p>Dashboard</p>
            </a>
          </li>

          <li class="nav-item active">
          <li class="nav-item dropdown active">

            <a class="nav-link" href="" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="material-icons">person</i>
              <p>Create Accounts</p>
            </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
              <a class="dropdown-item" href="createcus.php">Add Customer</a>
              <a class="dropdown-item" href="createdriv.php">Add Driver</a>
              <a class="dropdown-item" href="createcash.php">Add Cashier</a>

            </div>
          </li>


          </li>
          </li>
          <li class="nav-item ">
            <a class="nav-link" href="./notifications.php">
              <i class="material-icons">notifications</i>
              <p>Notifications</p>
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
                <div class="container">
                  <div class="card-header card-header-primary row">

                    <div class="col-3">
                      <h4 class="card-title ">Customer Details</h4>

                    </div>
                    <div class="col">
                      <input class="form-control" style="color: white;"  id="customerInput" style="color:white;" onkeyup="customerSearch();" type="search" placeholder="Search" aria-label="Search">
                    </div>
                    <div class="col-3">
                      <button style="margin-left:50px;" class="btn btn-light my-2 my-sm-0" type="submit">ADD A CUSTOMER</button>
                    </div>
                  </div>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table" id="customer">
                      <thead class=" text-primary">

                        <th>NIC</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Address</th>
                        <th>Email</th>
                        <th>Contact No</th>
                        <th>Registration Date</th>
                        <th>Points</th>
                        <th></th>
                      </thead>
                      <?php if ($result1 = mysqli_query($db, $sql1)) : ?>
                        <tbody>
                          <?php while ($row = mysqli_fetch_array($result1)) : ?>
                            <?php "<tr>"; ?>
                            <?php $id = $row['customerNic'] ?>
                            <?php echo "<td><a href=selectcus.php?sc=$id>" . $row['customerNic'] . "</a></td>"; ?>
                            <?php echo "<td>" . $row['customerFname'] . "</td>"; ?>
                            <?php echo "<td>" . $row['customerLname'] . "</td>"; ?>
                            <?php echo "<td>" . $row['customerAddress'] . "</td>"; ?>
                            <?php echo "<td>" . $row['customerEmail'] . "</td>"; ?>
                            <?php echo "<td>" . $row['customerContactNo'] . "</td>"; ?>
                            <?php echo "<td>" . $row['customerRegDate'] . "</td>"; ?>
                            <?php echo "<td>" . $row['points'] . "</td>"; ?>
                            <?php echo "<td><a href=php/remove.php?rc=$id>Remove</a></td>" ?>
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



            <div class="col-md-12">
              <div class="card">
              <div class="container">
                  <div class="card-header card-header-primary row">

                    <div class="col-3">
                      <h4 class="card-title ">Driver Details</h4>

                    </div>
                    <div class="col">
                      <input class="form-control" style="color: white;"  id="driverInput" onkeyup="driverSearch();" type="search" placeholder="Search" aria-label="Search">
                    </div>
                    <div class="col-3">
                      <button style="margin-left:50px;" class="btn btn-light my-2 my-sm-0" type="submit">ADD A CUSTOMER</button>
                    </div>
                  </div>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table" id="driver">
                      <thead class=" text-primary">

                        <th>NIC</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Address</th>
                        <th>Email</th>
                        <th></th>
                      </thead>
                      <?php if ($result2 = mysqli_query($db, $sql2)) : ?>
                        <tbody>
                          <?php while ($row = mysqli_fetch_array($result2)) : ?>
                            <?php "<tr>"; ?>
                            <?php $id = $row['driverNic'] ?>
                            <?php echo "<td><a href=selectdrive.php?sd=$id>" . $row['driverNic'] . "</a></td>"; ?>
                            <?php echo "<td>" . $row['driverFname'] . "</td>"; ?>
                            <?php echo "<td>" . $row['driverLname'] . "</td>"; ?>
                            <?php echo "<td>" . $row['driverAddress'] . "</td>"; ?>
                            <?php echo "<td>" . $row['driverEmail'] . "</td>"; ?>
                            <?php echo "<td><a href=php/remove.php?rc=$id>Remove</a></td>" ?>
                            <?php echo "</tr>"; ?>
                          <?php endwhile ?>
                        </tbody>
                        <?php mysqli_free_result($result2); ?>
                      <?php endif ?>
                    </table>
                  </div>
                </div>
              </div>
            </div>



            <div class="col-md-12">
              <div class="card">
              <div class="container">
                  <div class="card-header card-header-primary row">

                    <div class="col-3">
                      <h4 class="card-title ">Cashier Details</h4>

                    </div>
                    <div class="col">
                      <input class="form-control" onkeyup="cashierSearch();" id="cashierInput" type="search" placeholder="Search" aria-label="Search">
                    </div>
                    <div class="col-3">
                      <button style="margin-left:50px;" class="btn btn-light my-2 my-sm-0" type="submit">ADD A CUSTOMER</button>
                    </div>
                  </div>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table" id="cashier">
                      <thead class=" text-primary">

                        <th>NIC</th>
                        <th>First Name</th>
                        <th>Address</th>
                        <th>Contact No</th>
                        <th></th>
                      </thead>
                      <?php if ($result3 = mysqli_query($db, $sql3)) : ?>
                        <tbody>
                          <?php while ($row = mysqli_fetch_array($result3)) : ?>
                            <?php "<tr>"; ?>
                            <?php $id = $row['cashierNic'] ?>
                            <?php echo "<td><a href=selectcash.php?sca=$id>" . $row['cashierNic'] . "</a></td>"; ?>
                            <?php echo "<td>" . $row['cashierName'] . "</td>"; ?>
                            <?php echo "<td>" . $row['cashierAddress'] . "</td>"; ?>
                            <?php echo "<td>" . $row['cashierContactNo'] . "</td>"; ?>
                            <?php echo "<td><a href=php/remove.php?rc=$id>Remove</a></td>" ?>
                            <?php echo "</tr>"; ?>
                          <?php endwhile ?>
                        </tbody>
                        <?php mysqli_free_result($result3); ?>
                      <?php endif ?>
                    </table>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-md-12">
              <div class="card">
              <div class="container">
                  <div class="card-header card-header-primary row">

                    <div class="col-3">
                      <h4 class="card-title ">Removed Users</h4>

                    </div>
                    <div class="col">
                      <input class="form-control" style="color: white;" onkeyup="removedUsers();" id="removeInput" type="search" placeholder="Search" aria-label="Search">
                    </div>
                   
                  </div>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table" id="remove">
                      <thead class=" text-primary">
                        <th>NIC</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>User Type</th>
                        <th></th>
                      </thead>

                      <?php
                      $ru = "SELECT nic FROM login WHERE user_type='removed'";
                      if ($result2 = mysqli_query($db, $ru)) : ?>
                        <tbody>
                          <?php while ($row = mysqli_fetch_array($result2)) : ?>
                            <?php "<tr>"; ?>
                            <?php $id = $row['nic'];
                            $ru1 = "SELECT * FROM customer WHERE customerNic =  '$id' ";
                            $ru2 = "SELECT * FROM driver WHERE driverNic =  '$id'";
                            $ru3 = "SELECT * FROM cashier WHERE cashierNic =  '$id'";
                            $re1 = mysqli_query($db, $ru1);
                            $re2 = mysqli_query($db, $ru2);
                            $re3 = mysqli_query($db, $ru3);
                            if (mysqli_num_rows($re1) == 1) {
                              $r = mysqli_fetch_assoc($re1);
                              echo "<td>" . $r['customerNic'] . "</td>";
                              echo "<td>" . $r['customerFname'] . "</td>";
                              echo "<td>" . $r['customerLname'] . "</td>";
                              echo "<td>Customer</td>";
                              echo "<td><a href=php/add.php?au=$id>Add</a></td>";
                            }
                            if (mysqli_num_rows($re2) == 1) {
                              $r = mysqli_fetch_assoc($re2);
                              echo "<td>" . $r['driverNic'] . "</td>";
                              echo "<td>" . $r['driverFname'] . "</td>";
                              echo "<td>" . $r['driverLname'] . "</td>";
                              echo "<td>Driver</td>";
                              echo "<td><a href=php/add.php?ad=$id>Add</a></td>";
                            }
                            if (mysqli_num_rows($re3) == 1) {
                              $r = mysqli_fetch_assoc($re3);
                              echo "<td>" . $r['cashierNic'] . "</td>";
                              echo "<td>" . $r['cashierName'] . "</td>";
                              echo "<td></td>";
                              echo "<td>Cashier</td>";
                              echo "<td><a href=php/add.php?ac=$id>Add</a></td>";
                            }

                            ?>
                            <?php echo "</tr>"; ?>
                          <?php endwhile ?>
                        </tbody>
                        <?php mysqli_free_result($result2); ?>
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


  <!-- SEARCH CUSTOMER TABLE -->
<script>
function customerSearch() {
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("customerInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("customer");
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
        td = tr[i].getElementsByTagName("td")[2];
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        td = tr[i].getElementsByTagName("td")[4];
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        td = tr[i].getElementsByTagName("td")[5];
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
</script>

<!-- Driver details table search -->
<script>
function driverSearch() {
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("driverInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("driver");
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
        td = tr[i].getElementsByTagName("td")[2];
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        td = tr[i].getElementsByTagName("td")[4];
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
</script>

<!-- cashier table search -->
<script>
function cashierSearch() {
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("cashierInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("cashier");
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
        td = tr[i].getElementsByTagName("td")[3];
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }tr[i].style.display = "none";
      }
    }
      }
    }       
  }
}
</script>


<!-- removed users details -->
<script>
function removedUsers() {
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("removeInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("remove");
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
        td = tr[i].getElementsByTagName("td")[2];
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        td = tr[i].getElementsByTagName("td")[3];
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
</script>


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

  <script src="a.js"> </script>
</body>

</html>