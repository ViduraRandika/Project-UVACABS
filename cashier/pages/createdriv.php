<?php include('php/createUser.php'); 
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


 
  <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport'/>



  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
  <!-- CSS Files -->
  <link href="../assets/css/material-dashboard.css?v=2.1.2" rel="stylesheet" />
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
                    <li class="nav-item active-pro ">
                            <a class="nav-link" href="Cashier.php?logout='1'">
                                <i class="material-icons">save_alt</i>
                                <p>LOGOUT</p>
                            </a>
                        </li>


          </li>      
        </ul>
      </div>
    </div>
    <div class="main-panel">
      <!-- Navbar -->
      
      <!-- End Navbar -->
    

      <div class="container-fluid">
 
      <form action="createdriv.php" method="POST">
          <?php if (count($errors) > 0) : ?>

            <?php if (isset($url)) {
              echo $_SESSION['url'];
            } ?>
            <div class="error">
              <?php foreach ($errors as $error) : ?>
                <p><?php echo $error ?></p>
              <?php endforeach ?>
            </div>
          <?php endif ?>
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
            <input type="password_1" class="form-control" id="#" placeholder="Enter password" name="password" onkeyup="check();">
          </div>

          <div class="form-group">
            <b>
              <p>password</p>
            </b>
            <input type="password_2" class="form-control" id="#" placeholder="Enter password" name="cpassword" onkeyup="check();">
          </div>

          <div class="form-group">
            <label id="message"></label>
          </div>


          <button type="submit" class="btn btn-primary" name="createDriver">Create</button>
        </form>
        </div>

</body>

</html>