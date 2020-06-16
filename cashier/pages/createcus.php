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

<body>
    <div class="wrapper ">
        <div class="sidebar" data-color="purple" data-background-color="white" data-image="../assets/img/sidebar-1.jpg">

            <div class="logo"><a href="#" class="simple-text logo-normal">
                    Cashier Dashboard
                </a></div>
            <div class="sidebar-wrapper">
                <ul class="nav">
                    <li class="nav-item ">
                        <a class="nav-link" href="Cashier.php">
                            <i class="material-icons">dashboard</i>
                            <p>Dashboard</p>
                        </a>

                    <li class="nav-item active">
                        <a class="nav-link" href="view.php">
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
            <!-- End Navbar -->
            <div class="container-fluid">

            <form action="createcus.php" method="POST">
          
          <div class="form-group">
            <p><b>First Name</b></p>
            <input type="text" class="form-control" placeholder="Enter first name" name="fname">
          </div>
          <div class="form-group">
            <p><b>Last Name<b></p>
            <input type="text" class="form-control" id="#" placeholder="Enter last name" name="lname">
          </div>

          <div class="form-group">
            <p><b>NIC<b></p>
            <input type="text" class="form-control" id="#" placeholder="Enter NIC" name="nic">
          </div>

          <div class="form-group">
            <p><b>Email<b></p>
            <input type="email" class="form-control" id="#" placeholder="Enter E-mail" name="email">
          </div>

          <div class="form-group">
            <p><b>Phone Number<b></p>
            <input type="text" class="form-control" id="#" placeholder="Enter Phone Number" name="pno">
          </div>

          <div class="form-group">
            <p><b>Address</b></p>
            <input type="text" class="form-control" id="#" placeholder="Enter Address" name="address">
          </div>

          <div class="form-group">
            <b>
              <p>password</p>
            </b>
            <input type="password" class="form-control" id="password_1" onkeyup='check();' placeholder="Enter password" name="password">
          </div>

          <div class="form-group">
            <b>
              <p>Confirm password*</p>
            </b>
            <input type="password" class="form-control" id="password_2" onkeyup='check();' placeholder="Enter password" name="cpassword">
          </div>
          <div class="form-group">
            <label id="message"></label>
          </div>

          <button type="submit" class="btn btn-primary" name="createCus">Create</button>
        </form>
            </div>

</body>
<script>
  var check = function() {

    if (document.getElementById('password_1').value ==
      document.getElementById('password_2').value) {
      document.getElementById('message').style.color = 'green';
      document.getElementById('message').innerHTML = 'matching';
      if (document.getElementById('password_1').value == "") {
        document.getElementById('message').innerHTML = '';
      }
    } else if (document.getElementById('password_1').value !=
      document.getElementById('password_2').value) {
      document.getElementById('message').style.color = 'red';
      document.getElementById('message').innerHTML = 'not matching';
    }

  }
</script>

</html>