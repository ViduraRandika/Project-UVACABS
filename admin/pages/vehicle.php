<?php

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
<?php include('../../php/dbconfig.php');
$sql1 = "SELECT * FROM vehicle";
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
          <li class="nav-item dropdown">

            <a class="nav-link" href="create.php" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="material-icons">person</i>
              <p>Manage Accounts</p>
            </a>
          </li>
          <li class="nav-item ">
            <a class="nav-link" href="viewbooking.php">
              <i class="material-icons">unarchive</i>
              <p>View Booking Details</p>
            </a>
          </li>
          <li class="nav-item active">
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
          <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="container">
                  <div class="card-header card-header-primary row">

                    <div class="col-3">
                      <h4 class="card-title ">Vehicle Details</h4>

                    </div>
                    <div class="col">
                      <input class="form-control" style="color: white;"  id="customerInput" style="color:white;" onkeyup="customerSearch();" type="search" placeholder="Search" aria-label="Search">
                    </div>
                    <div class="col-3">
                      <button style="margin-left:50px;" class="btn btn-light my-2 my-sm-0" onclick="window.location.href='createveh.php';" >ADD A VEHICLE</button>
                    </div>
                  </div>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table" id="customer">
                      <thead class=" text-primary">

                        <th>Vehicle No</th>
                        <th>Vehicle Type</th>
                         <th>Action</th>
                      </thead>
                      <?php if ($result1 = mysqli_query($db, $sql1)) : ?>
                        <tbody>
                          <?php while ($row = mysqli_fetch_array($result1)) : ?>
                            <?php "<tr>"; ?>
                            <?php echo "<td>" . $row['vehicleNo'] . "</td>"; ?>
                            <?php echo "<td>" . $row['vehicleType'] . "</td>"; ?>
                            <?php $id = $row['vehicleNo'] ?>
                           <?php echo "<td><button class='btn btn-danger vehicledelete' id='del_$id' data-id='$id' value=''>REMOVE</button></td>" ?>
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
        tr[i].style.display = "none";  
      }
    }  
      }
    }       
  }
}
</script>






 

 
<script src="../assets/js/core/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/5.4.0/bootbox.js"></script>  <!-- REMOVE CUSTOMER  -->
  <!--   Core JS Files   -->
  
  <script src="../assets/js/core/bootstrap-material-design.min.js"></script>
<script>
 
 $(document).ready(function(){
 
 // Delete 
 $('.vehicledelete').click(function(){
   var el = this;
 
   // Delete id
   var deleteid = $(this).data('id');
 
   // Confirm box
   bootbox.confirm("Do you really want to delete record? ", function(result) {
 
      if(result){
        // AJAX Request
        $.ajax({
          url: 'php/removevehicle.php',
          type: 'POST',
          data: { rv:deleteid },
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


 
  
</body>

</html>