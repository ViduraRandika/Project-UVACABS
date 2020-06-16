-<?php 

  //permissions
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

include('../../php/dbconfig.php');
  $sql1 = "SELECT * FROM customer INNER JOIN login ON customer.customerNic = login.nic WHERE login.user_type != 'removed'";
  $sql2 = "SELECT * FROM driver INNER JOIN login ON driver.driverNic = login.nic WHERE login.user_type != 'removed'";

  
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

<body>
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

          <li class="nav-item active">

            <a class="nav-link" href="view.php">
              <i class="material-icons">person</i>
              <p>Manage Accounts</p>
            </a>
          </li>


          <li class="nav-item ">
            <a class="nav-link" href="./viewbooking.php">
              <i class="material-icons">unarchive</i>
              <p>View Booking Details</p>
            </a>
          </li>

          <li class="nav-item">
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

      </nav>
      <!-- End Navbar -->
      <div class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header card-header-primary row">
                  <div class="col-3">
                    <h4 class="card-title ">Customer Details</h4>

                  </div>
                  <div class="col">
                    <input class="form-control" style="color: white;" id="customerInput" style="color:white;" onkeyup="customerSearch();" type="search" placeholder="Search" aria-label="Search">
                  </div>
                  <div class="col-3">
                    <button style="margin-left:50px;" class="btn btn-secondary my-2 my-sm-0" onclick="window.location.href='createcus.php';">ADD A CUSTOMER</button>
                  </div>


                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table id="customer" class="table">
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
                            <?php echo "<td>" . $row['customerNic'] . "</td>"; ?>
                            <?php echo "<td>" . $row['customerFname'] . "</td>"; ?>
                            <?php echo "<td>" . $row['customerLname'] . "</td>"; ?>
                            <?php echo "<td>" . $row['customerAddress'] . "</td>"; ?>
                            <?php echo "<td>" . $row['customerEmail'] . "</td>"; ?>
                            <?php echo "<td>" . $row['customerContactNo'] . "</td>"; ?>
                            <?php echo "<td>" . $row['customerRegDate'] . "</td>"; ?>
                            <?php echo "<td>" . $row['points'] . "</td>"; ?>
                            <?php echo "<td><button class='btn btn-danger customerdelete' id='del_$id' data-id='$id'>REMOVE</button></td>" ?>
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
                <div class="card-header card-header-primary row">

                  <div class="col-3">
                    <h4 class="card-title ">Driver Details</h4>

                  </div>
                  <div class="col">
                    <input class="form-control" style="color: white;" id="driverInput" onkeyup="driverSearch();" type="search" placeholder="Search" aria-label="Search">
                  </div>
                  <div class="col-3">
                    <button style="margin-left:50px;" class="btn btn-secondary my-2 my-sm-0" onclick="window.location.href='createdriv.php';">ADD A DRIVER</button>
                  </div>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table id="driver" class="table">
                      <thead class=" text-primary">

                        <th>NIC</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Address</th>
                        <th>Email</th>
                        <th>Contact No
                        <th>
                        <th></th>
                      </thead>
                      <tbody>
                        <?php if ($result2 = mysqli_query($db, $sql2)) : ?>
                          <?php while ($row = mysqli_fetch_array($result2)) : ?>
                            <?php $id = $row['driverNic'] ?>
                            <?php $sq3 = "SELECT * FROM drivercontactno WHERE driverNic = '$id'";
                            $res = mysqli_fetch_array(mysqli_query($db, $sq3));
                            ?>
                            <?php "<tr>"; ?>
                            <?php echo "<td>" . $row['driverNic'] . "</td>"; ?>
                            <?php echo "<td>" . $row['driverFname'] . "</td>"; ?>
                            <?php echo "<td>" . $row['driverLname'] . "</td>"; ?>
                            <?php echo "<td>" . $row['driverAddress'] . "</td>"; ?>
                            <?php echo "<td>" . $row['driverEmail'] . "</td>"; ?>
                            <?php echo "<td>" . $res['driverContactNo'] . "</td>"; ?>
                            <?php echo "<td><button class='btn btn-danger customerdelete' id='del_$id' data-id='$id'>REMOVE</button></td>" ?>
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
                <div class="card-header card-header-primary row">

                  <div class="col-3">
                    <h4 class="card-title ">Removed Users</h4>

                  </div>
                  <div class="col">
                    <input class="form-control" style="color: white;" id="removeInput" onkeyup="removedUsers();" type="search" placeholder="Search" aria-label="Search">
                  </div>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table id="remove" class="table">
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
                            $re1 = mysqli_query($db, $ru1);
                            $re2 = mysqli_query($db, $ru2);
                            if (mysqli_num_rows($re1) == 1) {
                              $r = mysqli_fetch_assoc($re1);
                              echo "<td>" . $r['customerNic'] . "</td>";
                              echo "<td>" . $r['customerFname'] . "</td>";
                              echo "<td>" . $r['customerLname'] . "</td>";
                              echo "<td>Customer</td>";
                              echo "<td><button class='btn btn-success adduser' id='del_$id' data-id='$id' value=''>ADD</button></td>";
                            }
                            if (mysqli_num_rows($re2) == 1) {
                              $r = mysqli_fetch_assoc($re2);
                              echo "<td>" . $r['driverNic'] . "</td>";
                              echo "<td>" . $r['driverFname'] . "</td>";
                              echo "<td>" . $r['driverLname'] . "</td>";
                              echo "<td>Driver</td>";
                              echo "<td><button class='btn btn-success adddriver' id='del_$id' data-id='$id' value=''>ADD</button></td>";
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
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/5.4.0/bootbox.js"></script>
  <script>
 
 $(document).ready(function(){
 
 // Delete 
 $('.customerdelete').click(function(){
   var el = this;
 
   // Delete id
   var deleteid = $(this).data('id');
 
   // Confirm box
   bootbox.confirm("Do you really want to delete record? ", function(result) {
 
      if(result){
        // AJAX Request
        $.ajax({
          url: 'php/remove.php',
          type: 'POST',
          data: { rc:deleteid },
          success: function(response){
 
            // Removing row from HTML Table
            if(response == 1){
       $(el).closest('tr').css('background','tomato');
               $(el).closest('tr').fadeOut(800,function(){
          $(this).remove();
       });
        }else{
       window.alert('Record not deleted.');
        }
 
          }
        });
      }
 
   });
 
 });
 });
 
 </script>

<script>
 
 $(document).ready(function(){
 
 // ADD 
 $('.adduser').click(function(){
   var el = this;
 
   // ADD id
   var deleteid = $(this).data('id');
 
   // Confirm box
   bootbox.confirm("Do you really want to add this record? ", function(result) {
 
      if(result){
        // AJAX Request
        $.ajax({
          url: 'php/add.php',
          type: 'POST',
          data: { au:deleteid },
          success: function(response){
 
            // Removing row from HTML Table
            if(response == 1){
       $(el).closest('tr').css('background','tomato');
               $(el).closest('tr').fadeOut(800,function(){
          $(this).remove();
       });
        }else{
       window.alert('Record not Added.');
        }
 
          }
        });
      }
 
   });
 
 });
 });
 
 </script>
 <script>
 
 $(document).ready(function(){
 
 // add
 $('.adddriver').click(function(){
   var el = this;
 
   // add id
   var deleteid = $(this).data('id');
 
   // Confirm box
   bootbox.confirm("Do you really want to add this record? ", function(result) {
 
      if(result){
        // AJAX Request
        $.ajax({
          url: 'php/add.php',
          type: 'POST',
          data: { ad:deleteid },
          success: function(response){
 
            // Removing row from HTML Table
            if(response == 1){
       $(el).closest('tr').css('background','tomato');
               $(el).closest('tr').fadeOut(800,function(){
          $(this).remove();
       });
        }else{
       window.alert('Record not added.');
        }
 
          }
        });
      }
 
   });
 
 });
 });
 
 </script>
</body>

</html>