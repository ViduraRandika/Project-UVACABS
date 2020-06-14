
<?php
$u = "booking";

include('../php/register.php');

//permissions 
if(isset($_SESSION['user'])){
	if($_SESSION['user']['user_type'] == "admin"){
			header('location: ../admin/index.php');
	}
	if($_SESSION['user']['user_type'] == "cashier"){
		header('location: ../cashier/index.php');
	}
	if($_SESSION['user']['user_type'] == "driver"){
		header('location: ../driver/index.php');
	}
}


include('../php/rememberme.php');
$_SESSION['url'] = $_SERVER['REQUEST_URI'];
if (!isLoggedIn()) {
    $_SESSION['msg'] = "You must log in first";
    header('location: login.php');
}
$n = $_SESSION['user_data']['customerNic'];
$sql = "SELECT * FROM login WHERE nic ='$n'";
$origin = "";
if (isset($_POST['origin'])) {
    $origin = $_POST['origin'];
}
$destination = "";
if (isset($_POST['destination'])) {
    $destination = $_POST['destination'];
}
$distance = "";
if(isset($_POST['distance'])) {
    $distance = $_POST['distance'];
}
$totalCharge = "";
if (isset($_POST['total'])) {
    $totalCharge = $_POST['total'];
}
$time = "";
if (isset($_POST['time'])) {
    $time = $_POST['time'];
}
$date1 = "";
    if(isset($_POST['datenew'])){
        if($_POST['datenew']==""){
        $date1 = $_POST['datehidden'];
    }else{
        $date1 = $_POST['datenew'];
    }
}

$pointsBalance = 0;
if(isset($_POST['pointsBalance'])){
    $pointsBalance = $_POST['pointsBalance'];
}


$vehicle = "";
if (isset($_POST['vehicle'])) {
    $vehicle = $_POST['vehicle'];
}
$paymentType = "";
if(isset($_POST['paymentmethod'])){
    $paymentType = $_POST['paymentmethod'];
}

// if ($date1 == "") {
//     header('location: booking.php');
// }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>Booking</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <script src="//code.jquery.com/jquery-3.3.1.min.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/main.css">
    <script src="../gigo/js/gijgo.min.js" type="text/javascript"></script>
    <link href="../gigo/css/gijgo.min.css" rel="stylesheet" type="text/css">




    <style>
        .top {
            padding-top: 100px;
        }
    </style>
</head>

<body onload="success(); totalCharge();     calcRoute();" onchange="calcRoute();" onmousemove="calcRoute();" ontouchstart="calcRoute();success();" ontouchend="calcRoute();success();">>

    <?php include('navigation.php'); ?>
    <div class="container top">
        <form class="form-horizontal" id="calCharges" name="myform" action="booking.php" method="POST">
            <!-- Form Name -->
            <h1 id="h">Booking Details</h1>
            <!-- Text input-->
            <div class="form-group">
                <label class="col-md-4 control-label"><b>From*</b></label>
                <div class="col-md-8">
                    <input id="location-1" name="origin" class="form-control input-md" value="<?php echo "$origin"; ?>" onkeyup="success();" onchange="calcRoute();success();" placeholder="E.g: Bandarawela" required>
                </div>
            </div>

            <!-- Text input-->
            <div class="form-group">
                <label class="col-md-4 control-label"><b>To*</b> </label>
                <div class="col-md-8">
                    <input id="location-2" name="destination" class="form-control input-md" type="text" required value="<?php echo "$destination"; ?>" onkeyup="success();" onchange="calcRoute(); success();" ontouchstart="calcRoute();success();" ontouchend="calcRoute();success();" placeholder="E.g: Badulla">
                </div>
            </div>
            <div class="form-group">
                <label class="col-md control-label ">Distance*</label>
                <div class="input-group col-md-8">
                    <input disabled name="distance" id="dist" class="form-control input-md dist"  placeholder="Distance" onkeyup="totalCharge();success()" ontouchstart="calcRoute();success();" ontouchend="calcRoute();success();" required value="<?php echo "$distance"; ?>">
                    <div class="input-group-append">
                        <span class="input-group-text">Km</span>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-4 control-label"><b>Date*</b></label>
                <div class="col-md-8">
                    <label id="datelabel" value=""><?php echo "$date1"; ?></label>
                    <input type="hidden" id="datecheck" name="datehidden" value="<?php echo "$date1"; ?>">
                    <input type="text" style="margin-top:-30px;" name="datenew" id="datepicker" readonly onchange="submitform();success()">
                    <script>
                        $('#datepicker').datepicker();
                    </script>
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-4 control-label"><b>Time*</b></label>
                <div class="col-md-8">
                    <input name="time" id="timepicker" readonly required value="<?php echo "$time"; ?>" onchange="submitform();success()">
                    <script>
                        $('#timepicker').timepicker();
                    </script>
                </div>
            </div>

            <!-- Select Basic -->
            <div class="form-group">
                <div class="col-md-8">
                    <?php
                    //BOOKED VEHICLES COUNT BY EACH VEHICLE AT SELECTED DAY

                    $bookedCount_type1 = mysqli_query($db, "SELECT count(*) FROM booking WHERE tourDate = '$date1' and vehicleType = 'Car' and status = 'notcompleted'");
                    $bookedCount_type2 = mysqli_query($db, "SELECT count(*) FROM booking WHERE tourDate = '$date1' and vehicleType = 'Van(Non AC)' and status = 'notcompleted'");
                    $bookedCount_type3 = mysqli_query($db, "SELECT count(*) FROM booking WHERE tourDate = '$date1' and vehicleType = 'Van(AC)' and status = 'notcompleted'");
                    $bc_1 = mysqli_fetch_assoc($bookedCount_type1);
                    $bc_2 = mysqli_fetch_assoc($bookedCount_type2);
                    $bc_3 = mysqli_fetch_assoc($bookedCount_type3);

                    //VEHICLES COUNT BY EACH VEHICLE
                    $vehicleCount_type1 = mysqli_query($db, "SELECT count(*) FROM vehicle WHERE vehicleType = 'Car'");
                    $vehicleCount_type2 = mysqli_query($db, "SELECT count(*) FROM vehicle WHERE vehicleType = 'Van(Non AC)'");
                    $vehicleCount_type3 = mysqli_query($db, "SELECT count(*) FROM vehicle WHERE vehicleType = 'Van(AC)'");
                    $vc_1 = mysqli_fetch_assoc($vehicleCount_type1);
                    $vc_2 = mysqli_fetch_assoc($vehicleCount_type2);
                    $vc_3 = mysqli_fetch_assoc($vehicleCount_type3);
                    ?>

                    <div class="form-group">
                        <label class=" control-label"><b> Vehicle Type*</b></label>
                        <div class="">
                            <select name="vehicle" id="selectVehicle" class="form-control" onchange="totalCharge();success();">
                                <option value="">--SELECT VEHICLE TYPE--</option>
                                <?php if ($bc_1 < $vc_1) { ?>
                                    <option value="Car">Car</option>
                                <?php }
                                if ($bc_2 < $vc_2) { ?>
                                    <option value="Van(Non AC)">Van (Non AC)</option>
                                <?php }
                                if ($bc_3 < $vc_3) { ?>
                                    <option value="Van(AC)">Van (AC)</option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label class="col-md control-label "><b>Total Charge</b></label>
                <div class="input-group col-md-8">
                    <input name="total" class="form-control input-md" id="total" readonly value="<?php echo "$totalCharge"; ?>">
                    <input name= "pointsBalance" id='pointsbal'  value="<?php echo $pointsBalance; ?> hidden">
                    <div class="input-group-append">
                        <span class="input-group-text">LKR</span>
                    </div>
                </div>
            </div>
            <hr>
            <h1 id="h">Payment</h1>

            <div class="col-md-8">
                <div class="form-group">
                    <label class=" control-label"><b> Payment Type*</b><p>  - If you paying full payment at once and if you have enough points in account you can use them. </p></label>
                    <div class="">
                        <select name="paymentmethod" id="payment_method" class="form-control" onchange="totalCharge()" onloadeddata="totalCharge()">
                            <option value="advanced">Advanced Payment</option>
                            <option value="full">Full Payment</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="form-group" id="cus_amount">
                <label class="col-md control-label "><b>Amount (If you paying advanced payment you have to pay 20% from total.)</b></label>
                <div class="input-group col-md-8">
                    <input name="payAmount" class="form-control input-md" id="payAmount" readonly required>
                    <div class="input-group-append">
                        <span class="input-group-text">LKR</span>
                    </div>
                </div>
            </div>
            <?php
            $nic  = $_SESSION['user_data']['customerNic'];
             $cpSql =mysqli_fetch_assoc(mysqli_query($db,"SELECT points FROM customer WHERE customerNic = '$nic'"));
             $currentPoints = $cpSql['points'];
             $restriction = "";
             $c = 0;
            
            //$c = $totalCharge*20/100;
             if($currentPoints>50){
                $restriction = "";
             }else{
                 $restriction = "hidden";
             }
            ?>
            <div id = "hide">
                <div class="form-group" <?php echo $restriction;?>>
                    <label class="col-md control-label ">You have earned <b style="color:red"><?php echo $currentPoints;?></b> points. If you need to use them now, please check below box.</label>
                    <div class="col-md-8">
                        I want to use my points <input type="checkbox"  id="myCheckbox" onclick ="totalCharge()">
                        <input type="hidden" name="" id="curPo" value="<?php echo $currentPoints; ?>">
                    </div>
                </div>
            </div>
        </form>
        <form action="https://sandbox.payhere.lk/pay/checkout" method="POST">
            <!-- Button (Double) -->
            <div class="form-group">
                <label class="col-md-4 control-label"></label>
                <div class="col-md-8">
                    <button type="button" id="button" class="btn btn-primary" data-toggle="modal" data-target="#confirm_details">Continue</button>
                </div>
            </div>

           <!--payment gate-->

            <input type="hidden" name="merchant_id" value="1213832"> <!-- Replace your Merchant ID -->
            <input type="hidden" name="return_url" value="http://uvacabs.company/user/success.php?bs=success">
            <input type="hidden" name="cancel_url" value="http://uvacabs.company/user/success.php?bs=unsuccess">
            <input type="hidden" name="notify_url" value="http://uvacabs.company/user/booking_process.php">

            <input type="hidden" name="order_id" value="<?php echo uniqid(); ?>">
            <input type="hidden" name="items" value="Vehicle Booking"><br>
            <input type="hidden" name="currency" value="LKR">
            <input type="hidden" id="amount" name="amount" value="<?php echo "$totalCharge"; ?>" readonly>

            <input type="hidden" name="first_name" value="<?php echo $_SESSION['user_data']['customerFname']; ?>">
            <input type="hidden" name="last_name" value="<?php echo $_SESSION['user_data']['customerLname']; ?>">
            <input type="hidden" name="email" value="<?php echo $_SESSION['user_data']['customerEmail']; ?>">
            <input type="hidden" name="phone" value="<?php echo $_SESSION['user_data']['customerContactNo']; ?>"><br>
            <input type="hidden" name="address" value="<?php echo $_SESSION['user_data']['customerAddress']; ?>">
            <input type="hidden" name="city" value="Badulla">
            <input type="hidden" name="country" value="Sri Lanka">
            <input type="hidden" name="custom_1" value="<?php echo $origin.",".$destination.",".$vehicle.",".$time.",".$date1.",". $_SESSION['user_data']['customerNic'].",".$paymentType ; ?>"><br><br>
            <input type="hidden" name="custom_2" value="<?php echo $pointsBalance; ?>">


            <!-- Confirm details Modal -->
            <div class="modal fade" id="confirm_details" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Confirm Booking</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <label>By clicking Confirm Booking you agree to our<a href="#"> terms and conditions.</a></label>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" id="button" class="btn btn-primary">Confirm Booking</button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <?php include('footer.php'); ?>
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBuUdKpVImn3M7uF3wBAS79-hxcrxfBjVU&libraries=places"></script>
    <script type="text/javascript">
    google.maps.event.addDomListener(window, 'load', function () {
        var places = new google.maps.places.Autocomplete(document.getElementById('location-1'),options);
        var places = new google.maps.places.Autocomplete(document.getElementById('location-2'),options);
        google.maps.event.addListener(places,'place_changed', function () {
            var place = places.getPlace();
        }
       
        );
    });
    var options = {
    componentRestrictions: {country: "lk"}
}
  
var directionsService = new google.maps.DirectionsService();


function calcRoute(){
  var request = {
        origin: document.getElementById("location-1").value,
        destination: document.getElementById("location-2").value,
        travelMode: google.maps.TravelMode.DRIVING,
        unitSystem: google.maps.UnitSystem.METRIC
  }
  
  directionsService.route(request,function (result,status){
    if(status == google.maps.DirectionsStatus.OK){
            var route = result.routes[0];
            totalDistance = 0;
            for ( var i=0;i<route.legs.length;i++)
            {
              totalDistance+=route.legs[i].distance.value;
            } 
            document.getElementById('dist').value = result.routes[0].legs[0].distance.value/1000;
            totalCharge();
            success();
    }else{
      
      clearRoute();
    }
  });
}
</script>
    <script>
        function success() {
            if ((document.getElementById("location-1").value === "") || (document.getElementById("location-2").value === "") || (document.getElementById("dist").value === "") || (document.getElementById("datecheck").value === "") || (document.getElementById("selectVehicle").value === "")||(document.getElementById("timepicker").value === "")) {
                document.getElementById('button').disabled = true;
            } else {
                document.getElementById('button').disabled = false;
            }
        }
    </script>

    <script>
        var vehicle_rates = new Array();
        vehicle_rates["Car"] = 30;
        vehicle_rates["Van(Non AC)"] = 50;
        vehicle_rates["Van(AC)"] = 80;

        var pay_methods = new Array();
        pay_methods["advanced"] = 0.2;
        pay_methods["full"] = 1;

        function totalCharge() {

            var checkBox = document.getElementById("myCheckbox");
            var po = 0;
            

            var vehicleRate = 0;
            //Get a reference to the form id="calCharges"
            var formCal = document.forms["calCharges"];
            //Get a reference to the select id="selectVehicle"
            var selectedVehicle = formCal.elements["selectVehicle"];
            var selectedMethod = formCal.elements["payment_method"];
            vehicleRate = vehicle_rates[selectedVehicle.value];

            //return selected vehicle rate - per 1km

            var distance = 0;
            var dist = formCal.elements["dist"];
            distance = (1) * dist.value;
            var tot = (distance * vehicleRate);
            var totalCharge = tot.toFixed(2);
            var x = document.getElementById("hide");
            if(totalCharge>100 && selectedMethod.value == "full"){
                x.style.display = "block";
            }else{
                x.style.display = "none";
            }
            var maxUsablePoints = totalCharge - 100;
            po = document.getElementById("curPo").value;
            if(selectedMethod.value == "full"){
            if(checkBox.checked){
                
                if(po<maxUsablePoints){
                    totalCharge = totalCharge - po;
                    document.getElementById('pointsbal').value = 0;
                    document.getElementById('total').value = totalCharge;
                }if(po>=maxUsablePoints){
                    totalCharge = totalCharge - maxUsablePoints;
                    po = po - maxUsablePoints;
                    document.getElementById('pointsbal').value = po; 
                    document.getElementById('total').value = totalCharge;
                }
            }else{
                document.getElementById('pointsbal').value = po;
                document.getElementById('total').value = totalCharge;
            }
            }else{
                document.getElementById('pointsbal').value = po;    
            }


            var am = pay_methods[selectedMethod.value];
            var chg = document.getElementById('total').value * am;
            var finalAmount = chg.toFixed(2);
            document.getElementById('payAmount').value = finalAmount;
            document.getElementById('amount').value = finalAmount;
        }
    </script>

    <script type="text/javascript">
        function submitform() {
            document.myform.submit();
        }
    </script>

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
</body>

</html>