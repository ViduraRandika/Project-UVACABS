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
      <script>window.alert("Passwords not matched");</script>
    <?php
      unset($_SESSION['error']);
    }
      if($_SESSION['error'] == "2"){?>
      
        <script>window.alert("Password should be equal or greater than 6 characters");</script>
     <?php 
      unset($_SESSION['error']); 
    }
    if($_SESSION['error'] == "code3"){?>
    <script>window.alert("Invalid phone number");</script>
     <?php 
      unset($_SESSION['error']); 
    }
  
  if($_SESSION['error'] == "code4"){?>
    <script>window.alert("Phone number already exists");</script>
     <?php 
      unset($_SESSION['error']); 
    }
    if($_SESSION['error'] == "code5"){?>
        <script>window.alert("Nic already exists");</script>
         <?php 
          unset($_SESSION['error']); 
        }?>
   <?php
  if(isset($_SESSION['success'])){
    ?>
    <script>window.alert("Record added");</script>
    <?php
    unset($_SESSION['success']);
  }}
  
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
                        <a class="nav-link" href="./create.php">
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


            <div class="container-fluid">

                <form action="php/createcashier.php" method="post">
                    
                    <div class="form-group">
                        <p><b>Name</b></p>
                        <input type="text" class="form-control" placeholder="Enter name" name="name">
                    </div>

                    <div class="form-group">
                        <p><b>NIC<b></p>
                        <input type="text" class="form-control" id="#" placeholder="Enter NIC" name="nic">
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
                        <input type="password" class="form-control" id="password_1" placeholder="Enter password" name="password" onkeyup="check();">
                    </div>

                    <div class="form-group">
                        <b>
                            <p>Confirm password</p>
                        </b>
                        <input type="password" class="form-control" id="password_2" placeholder="Enter password" name="cpassword" onkeyup="check();">
                    </div>
                    <div class="form-group">
            <label id="message"></label>
          </div>


                    <input type="submit" class="btn btn-primary" name="createCashier"></input>
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