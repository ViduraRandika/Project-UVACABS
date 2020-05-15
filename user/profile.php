<?php

include('../php/register.php');
include('../php/rememberme.php');

$_SESSION['url'] = $_SERVER['REQUEST_URI'];
if (!isLoggedIn()) {
    $_SESSION['msg'] = "You must log in first";
    header('location: login.php');
}



//INCLUDE DATABASE CONNECTION
include('../php/dbconfig.php');
$n = $_SESSION['user']['nic'];
$sql = "SELECT * FROM booking WHERE status ='completed' AND customerNic ='$n'";
$sql2 = "SELECT * FROM booking WHERE customerNic ='$n' AND (status ='pending' OR status = 'notcompleted')";
if (isset($_POST['update_btn'])) {

    profile_edit();
}

//create prfile edit function
function profile_edit()
{

    global $db;
    $fname = "";
    $lname = "";
    $email = "";
    $phone = "";
    $address = "";
    $nicEdit = "";


    $fname = $_POST['fnameEdit'];
    $_SESSION['user_data']['customerFname'] = $fname;

    $lname = $_POST['lnameEdit'];
    $_SESSION['user_data']['customerLname'] = $lname;

    $email = $_POST['emailEdit'];
    $_SESSION['user_data']['customerEmail'] = $email;

    $phone = $_POST['phoneEdit'];
    $_SESSION['user_data']['customerContactNo'] = $phone;

    $address = $_POST['addressEdit'];
    $_SESSION['user_data']['customerAddress'] = $address;

    $nicEdit = $_POST['nicEdit'];


    $qupdate = "UPDATE customer SET customerFname = '$fname', customerLname = '$lname', customerEmail = '$email',customerContactNo = '$phone',customerAddress = '$address' WHERE customerNic ='$nicEdit'";

    $resultEdit = mysqli_query($db, $qupdate);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>User Profile</title>

    <!--FONT AWESOME CSS-->
    <link rel="stylesheet" href="../css/main.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/style1.css">
</head>

<body>

    <?php include('navigation.php') ?>

    <div class="container emp-profile">
        <form method="post">
            <div class="row">

                <div class="col-sm-8">
                    <div class="profile-head">
                        <h5>
                            Profile
                        </h5>
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home">About</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile">History</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="profile-tab" data-toggle="tab" href="#booking">Booking</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="row">

                <div class="col-md-12">
                    <div class="tab-content profile-tab" id="myTabContent">
                        <div class="tab-pane fade show active" id="home" role="tabpanel">
                            <form action="profile.php" method="POST">
                                <?php if (isset($_SESSION['user'])) : ?>

                                    <div class="row">
                                        <div class="col-md-4">
                                            <label>First Name</label>
                                        </div>
                                        <div class="col-md-5">
                                            <div class="input-group">
                                                <input type="text" class="form-control" id="t_fedit" name="fnameEdit" value="<?php echo $_SESSION['user_data']['customerFname']; ?>" readonly>
                                                <div class="input-group-append">
                                                    <button class="btn btn-outline-secondary" type="button" onclick="myFunctionfedit()" id="fedit">Edit</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label>Last Name</label>
                                        </div>
                                        <div class="col-md-5">
                                            <div class="input-group">
                                                <input type="text" class="form-control" id="t_ledit" name="lnameEdit" value="<?php echo $_SESSION['user_data']['customerLname']; ?>" readonly>
                                                <div class="input-group-append">
                                                    <button class="btn btn-outline-secondary" type="button" onclick="myFunctionledit()" id="fedit">Edit</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label>NIC</label>
                                        </div>
                                        <div class="col-md-5">
                                            <div class="input-group">
                                                <input type="text" class="form-control" name="nicEdit" value="<?php echo $_SESSION['user_data']['customerNic']; ?>" readonly>
                                                <div class="input-group-append">

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label>Phone No</label>
                                        </div>
                                        <div class="col-md-5">
                                            <div class="input-group">
                                                <input type="text" class="form-control" id="t_pedit" name="phoneEdit" value="<?php echo $_SESSION['user_data']['customerContactNo']; ?>" readonly>
                                                <div class="input-group-append">
                                                    <button class="btn btn-outline-secondary" type="button" onclick="myFunctionpedit()" id="pedit">Edit</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label>E-mail</label>
                                        </div>
                                        <div class="col-md-5">
                                            <div class="input-group">
                                                <input type="text" class="form-control" id="t_eedit" name="emailEdit" value="<?php echo $_SESSION['user_data']['customerEmail']; ?>" readonly>
                                                <div class="input-group-append">
                                                    <button class="btn btn-outline-secondary" type="button" onclick="myFunctioneedit()" id="eedit">Edit</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label>Address</label>
                                        </div>
                                        <div class="col-md-5">
                                            <div class="input-group">
                                                <input type="text" class="form-control" id="t_aedit" name="addressEdit" value="<?php echo $_SESSION['user_data']['customerAddress']; ?>" readonly>
                                                <div class="input-group-append">
                                                    <button class="btn btn-outline-secondary" type="button" onclick="myFunctionaedit()" id="fedit">Edit</button>
                                                </div>
                                            </div>
                                            <br><br><button type="submit" name="update_btn">Update</button>
                                        </div>
                                    </div>
                                <?php endif ?>
                            </form>
                            <div class="content">
                                <br>
                            </div>
                        </div>
                        <!--History-->
                        <div class="tab-pane fade" id="profile" role="tabpanel">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="table-responsive">
                                        <table id="mytable" class="table table-bordred table-striped">
                                            <thead>
                                                <th>Start</th>
                                                <th>Destination</th>
                                                <th>Price</th>
                                                <th>Points</th>
                                            </thead>
                                            <?php if ($result = mysqli_query($db, $sql)) : ?>
                                                <tbody>
                                                    <?php while ($row = mysqli_fetch_array($result)) : ?>
                                                        <?php echo "<tr>"; ?>
                                                        <?php echo "<td>" . $row['origin'] . "</td>"; ?>
                                                        <?php echo "<td>" . $row['destination'] . "</td>"; ?>
                                                        <?php
                                                        $bid = $row['bookingId'];
                                                        $fd = mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM onlinepayment WHERE bookingId = '$bid'"));
                                                        $charges = "";
                                                        if ($fd['paymentType'] == "advanced") {
                                                            $charges = $fd['charges'] * 5;
                                                        } else {
                                                            $charges = $fd['charges'];
                                                        }
                                                        ?>
                                                        <?php echo "<td>" . $charges . "</td>"; ?>
                                                        <?php $sqlPoints = mysqli_fetch_assoc(mysqli_query($db, "SELECT points FROM customer where customerNic = '$n'"));
                                                        $points = $sqlPoints['points'];
                                                        ?>
                                                        <?php echo "<td>" . $points . "</td>"; ?>
                                                        <?php echo "</tr>"; ?>
                                                    <?php endwhile ?>
                                                </tbody>
                                                <?php mysqli_free_result($result); ?>
                                            <?php endif ?>
                                        </table>

                                        <!--PAGINATION-->
                                        <ul class="pagination justify-content-end">
                                            <li class="page-item"><a class="page-link" href="#">Previous</a></li>
                                            <li class="page-item active"><a class="page-link " href="#">1</a></li>
                                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                                            <li class="page-item"><a class="page-link" href="#">Next</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--Booking-->
                        <div class="tab-pane fade" id="booking" role="tabpanel">
                            <div class="row">
                                <div class="col-md-12">
                                    <h4>Current Bookings</h4>
                                    <div class="table-responsive">
                                        <table id="mytable" class="table table-bordred table-striped">
                                            <thead>
                                                <th>Booking ID</th>
                                                <th>Origin</th>
                                                <th>Destination</th>
                                                <th>Vehicle Type</th>
                                                <th>Vehicle No</th>
                                                <th>Time</th>
                                                <th>Date</th>
                                                <th>Driver Details</th>
                                                <th>Cancel Booking</th>
                                            </thead>
                                            <?php if ($result2 = mysqli_query($db, $sql2)) : ?>
                                                <tbody>
                                                    <?php while ($row2 = mysqli_fetch_array($result2)) : ?>
                                                        <?php echo "<tr>"; ?>
                                                        <?php echo "<td>" . $row2['bookingId'] . "</td>"; ?>
                                                        <?php echo "<td>" . $row2['origin'] . "</td>"; ?>
                                                        <?php echo "<td>" . $row2['destination'] . "</td>"; ?>
                                                        <?php echo "<td>" . $row2['vehicleType'] . "</td>"; ?>
                                                        <?php echo "<td>" . $row2['vehicleNo'] . "</td>"; ?>
                                                        <?php echo "<td>" . $row2['tourTime'] . "</td>"; ?>
                                                        <?php echo "<td>" . $row2['tourDate'] . "</td>"; ?>
                                                        <?php echo "<td>" . $row2['driverNic'] . "</td>"; ?>
                                                        <?php
                                                        $cncl = $row2['bookingId'];
                                                        echo "<td><button type='button' class='btn btn-danger delete' id=del_" . $row2['bookingId'] . " data-id=" . $row2['bookingId'] . ">Cancel</button></td>"; ?>
                                                        <?php echo "</tr>"; ?>
                                                    <?php endwhile ?>
                                                </tbody>
                                                <?php mysqli_free_result($result2); ?>
                                            <?php endif ?>
                                            <?php mysqli_close($db); ?>
                                        </table>

                                        <ul class="pagination justify-content-end">
                                            <li class="page-item"><a class="page-link" href="#">Previous</a></li>
                                            <li class="page-item active"><a class="page-link " href="#">1</a></li>
                                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                                            <li class="page-item"><a class="page-link" href="#">Next</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>


    <script>
        function myFunctionfedit() {

            document.getElementById("t_fedit").readOnly = false;
        }

        function myFunctionledit() {

            document.getElementById("t_ledit").readOnly = false;
        }


        function myFunctionpedit() {

            document.getElementById("t_pedit").readOnly = false;
        }


        function myFunctioneedit() {

            document.getElementById("t_eedit").readOnly = false;
        }


        function myFunctionaedit() {

            document.getElementById("t_aedit").readOnly = false;
        }
    </script>

    <script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <script src="../js/bootbox.min.js"></script>
    <script>
        $(document).ready(function() {

            // Delete 
            $('.delete').click(function() {
                var el = this;

                // Delete id
                var deleteid = $(this).data('id');

                // Confirm box
                bootbox.confirm("Do you really want to cancel this booking?", function(result) {

                    if (result) {
                        // AJAX Request
                        $.ajax({
                            url: 'cancelbookingajax.php',
                            type: 'POST',
                            data: {
                                id: deleteid
                            },
                            success: function(response) {

                                // Removing row from HTML Table
                                if (response == 1) {
                                    $(el).closest('tr').css('background', 'tomato');
                                    $(el).closest('tr').fadeOut(800, function() {
                                        $(this).remove();
                                    });
                                } else {
                                    bootbox.alert('Cancelling failed. Please try again');
                                }

                            }
                        });
                    }

                });

            });
        });
    </script>
    <?php include('footer.php') ?>


</body>

</html>