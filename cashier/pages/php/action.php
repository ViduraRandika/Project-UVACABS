<?php
////////////DATABASE CONNECTION//////////////////////////
include('dbconfig.php');


////////////CONFIRM BOOKING AND SEND MESSAGES TO CUSTOMER AND DRIVER//////////////////////
if(isset($_POST['confirmBID'])){
   $bId = $_POST['confirmBID'];
   $vehicle = $_POST['selVehicle'];
   $driver = $_POST['selDriver'];
   ///////UPDATING DATABASE///////
   $sql1 = mysqli_query($db,"UPDATE booking SET status = 'notcompleted', vehicleNo = '$vehicle', driverNic = '$driver' WHERE bookingId = '$bId'");

   /////////BOOKING DETAILS///////
   $sql2 = mysqli_fetch_assoc(mysqli_query($db,"SELECT * FROM booking WHERE bookingId = '$bId'"));
   $org = $sql2['origin'];
   $dest = $sql2['destination'];
   $date = $sql2['tourDate'];
   $time = $sql2['tourTime'];
   $vno = $sql2['vehicleNo'];
   $cusNic = $sql2['customerNic'];
   $drNic = $sql2['driverNic'];

   //////////CUSTOMER DETAILS//////////
   $sql3 = mysqli_fetch_assoc(mysqli_query($db,"SELECT * FROM customer WHERE customerNic = '$cusNic'"));
   $cEmail = $sql3['customerEmail'];
   $cName = $sql3['customerFname']." ".$sql3['customerLname'];
   $cPno = $sql3['customerContactNo'];
   $cAddress = $sql3['customerAddress'];

   //////PAYMENT DETAILS////////
   $sql4 = mysqli_fetch_assoc(mysqli_query($db,"SELECT * FROM onlinepayment WHERE bookingId = '$bId'"));
   $pId = $sql4['paymentId'];
   $cNo = $sql4['cardNo'];
   $pt = $sql4['paymentType'];
   $ch = $sql4['charges'];

   ////////CALCULATION///// 
   $tot = 0;
    if ($pt == "advanced") {
        $tot = $ch * 5;
    } else {
        $tot = $ch;
    }
    $nePay = $tot-$ch;

   ////////VEHICLE DETAILS////////
   $sql5 = mysqli_fetch_assoc(mysqli_query($db,"SELECT * FROM vehicle WHERE vehicleNo = '$vno'"));
   $vehType = $sql5['vehicleType'];
   
   ////////////DRIVER DETAILS///////
   $sql6 = mysqli_fetch_assoc(mysqli_query($db,"SELECT * FROM driver WHERE driverNic = '$drNic'"));
   $drName = $sql6['driverFname']." ".$sql6['driverLname'];
   $dEmail = $sql6['driverEmail'];

   $sql7 = mysqli_fetch_assoc(mysqli_query($db,"SELECT * FROM drivercontactno WHERE driverNic = '$drNic'"));
   $drConNo = $sql7['driverContactNo'];

   ////////////////////////////////FUNCTIONS CALLING/////////////////////////////////////////////
   echo $cEmail.'<br>'.$org.'<br>'.$dest.'<br>'.$date.'<br>'.$time.'<br>'.$vehType.'<br>'.$vno.'<br>'.$drName.'<br>'.$drConNo.'<br>'.$bId.'<br>'.$pId.'<br>'.$cNo.'<br>'.$pt.'<br>'.$tot.'<br>'.$ch.'<br>'.$nePay;
//    sendemailtocustomer($cEmail,$org,$dest,$date,$time,$vehType,$vno,$drName,$drConNo,$bId,$pId,$cNo,$pt,$tot,$ch,$nePay);
//    sendemailtoDriver($dEmail,$org,$dest,$date,$time,$vehType,$vno,$bId,$nePay,$cName,$cPno,$cAddress);


    ////////////////////////////////////SEND EMAIL TO CUSTOMER////////////////////////////////////////////

   function sendemailtocustomer($cusEmail,$origin,$destination,$TourDate,$TourTime,$vehicleType,$vehicleNo,$driverName,$driverContactNo,$bookingId,$paymentId,$cardNo,$paymentType,$totalFare,$payedAmount,$needToPay){
  
   
    $url = 'https://api.sendgrid.com/';
    $user = 'vidurarandika96@gmail.com';
    $pass = '20168268werty';
    
    $json_string = array(
    
      'to' => array(
        $cusEmail,
      ),
      'category' => 'Booking Confirmed (Customer)'
    );
    
    
    $params = array(
        'api_user'  => $user,
        'api_key'   => $pass,
        'x-smtpapi' => json_encode($json_string),
        'to'        => $cusEmail,
        'subject'   => 'Booking Confirmed',
        'html'      => "
 
 <!DOCTYPE html>
 <html lang='en'>
 <head>
     <meta http-equiv='Content-Type' content='text/html; charset=utf-8'>
     <meta name='viewport' content='width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1'>
     <meta http-equiv='X-UA-Compatible' content='IE=Edge'>
     <style type='text/css'>
         body,
         p,
         div {
             font-family: inherit;
             font-size: 14px;
         }
         
         body {
             color: #000000;
         }
         
         body a {
             color: #1188E6;
             text-decoration: none;
         }
         
         p {
             margin: 0;
             padding: 0;
         }
         
         table.wrapper {
             width: 100% !important;
             table-layout: fixed;
             -webkit-font-smoothing: antialiased;
             -webkit-text-size-adjust: 100%;
             -moz-text-size-adjust: 100%;
             -ms-text-size-adjust: 100%;
         }
         
         img.max-width {
             max-width: 100% !important;
         }
         
         .column.of-2 {
             width: 50%;
         }
         
         .column.of-3 {
             width: 33.333%;
         }
         
         .column.of-4 {
             width: 25%;
         }
         
         @media screen and (max-width:480px) {
             .preheader .rightColumnContent,
             .footer .rightColumnContent {
                 text-align: left !important;
             }
             .preheader .rightColumnContent div,
             .preheader .rightColumnContent span,
             .footer .rightColumnContent div,
             .footer .rightColumnContent span {
                 text-align: left !important;
             }
             .preheader .rightColumnContent,
             .preheader .leftColumnContent {
                 font-size: 80% !important;
                 padding: 5px 0;
             }
             table.wrapper-mobile {
                 width: 100% !important;
                 table-layout: fixed;
             }
             img.max-width {
                 height: auto !important;
                 max-width: 100% !important;
             }
             a.bulletproof-button {
                 display: block !important;
                 width: auto !important;
                 font-size: 80%;
                 padding-left: 0 !important;
                 padding-right: 0 !important;
             }
             .columns {
                 width: 100% !important;
             }
             .column {
                 display: block !important;
                 width: 100% !important;
                 padding-left: 0 !important;
                 padding-right: 0 !important;
                 margin-left: 0 !important;
                 margin-right: 0 !important;
             }
         }
     </style>
     <link href='https://fonts.googleapis.com/css?family=Muli&display=swap' rel='stylesheet'>
     <link href='https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css' rel='stylesheet'>
     <style>
         body {
             font-family: 'Muli', sans-serif;
         }
     </style>
 </head>
 
 <body>
     <center class='wrapper' data-link-color='#1188E6' data-body-style='font-size:14px; font-family:inherit; color:#000000; background-color:#FFFFFF;'>
         <div class='webkit'>
             <table cellpadding='0' cellspacing='0' border='0' width='100%' class='wrapper' bgcolor='#FFFFFF'>
                 <tbody>
                     <tr>
                         <td valign='top' bgcolor='#FFFFFF' width='100%'>
                             <table width='100%' role='content-container' class='outer' align='center' cellpadding='0' cellspacing='0' border='0'>
                                 <tbody>
                                     <tr>
                                         <td width='100%'>
                                             <table width='100%' cellpadding='0' cellspacing='0' border='0'>
                                                 <tbody>
                                                     <tr>
                                                         <td>
                                                             <table width='100%' cellpadding='0' cellspacing='0' border='0' style='width:100%; max-width:600px;' align='center'>
                                                                 <tbody>
                                                                     <tr>
                                                                         <td role='modules-container' style='padding:0px 0px 0px 0px; color:#000000; text-align:left;' bgcolor='#FFFFFF' width='100%' align='left'>
                                                                             <table class='module preheader preheader-hide' role='module' data-type='preheader' border='0' cellpadding='0' cellspacing='0' width='100%' style='display: none !important; mso-hide: all; visibility: hidden; opacity: 0; color: transparent; height: 0; width: 0;'>
                                                                                 <tbody>
                                                                                     <tr>
                                                                                         <td role='module-content'>
                                                                                             <p></p>
                                                                                         </td>
                                                                                     </tr>
                                                                                 </tbody>
                                                                             </table>
                                                                             <table border='0' cellpadding='0' cellspacing='0' align='center' width='100%' role='module' data-type='columns' style='padding:30px 20px 30px 20px;' bgcolor='#f6f6f6'>
                                                                                 <tbody>
                                                                                     <tr role='module-content'>
                                                                                         <td height='100%' valign='top'>
                                                                                             <table class='column' width='540' style='width:540px; border-spacing:0; border-collapse:collapse; margin:0px 10px 0px 10px;' cellpadding='0' cellspacing='0' align='left' border='0' bgcolor=''>
                                                                                                 <tbody>
                                                                                                     <tr>
                                                                                                         <td style='padding:0px;margin:0px;border-spacing:0;'>
                                                                                                             <table class='wrapper' role='module' data-type='image' border='0' cellpadding='0' cellspacing='0' width='100%' style='table-layout: fixed;' data-muid='72aac1ba-9036-4a77-b9d5-9a60d9b05cba'>
                                                                                                                 <tbody>
                                                                                                                     <tr>
                                                                                                                         <td style='font-size:6px; line-height:10px; padding:0px 0px 0px 0px;' valign='top' align='center'>
                                                                                                                             <img class='max-width' border='0' style='display:block; color:#000000; text-decoration:none; font-family:Helvetica, arial, sans-serif; font-size:16px;' width='100' alt='' data-proportionally-constrained='true' data-responsive='false' src='http://uvacabs.company/img/logo.png'
                                                                                                                                 height='100'>
                                                                                                                         </td>
                                                                                                                     </tr>
                                                                                                                 </tbody>
                                                                                                             </table>
                                                                                                             <table class='module' role='module' data-type='spacer' border='0' cellpadding='0' cellspacing='0' width='100%' style='table-layout: fixed;' data-muid='331cde94-eb45-45dc-8852-b7dbeb9101d7'>
                                                                                                                 <tbody>
                                                                                                                     <tr>
                                                                                                                         <td style='padding:0px 0px 20px 0px;' role='module-content' bgcolor=''>
                                                                                                                         </td>
                                                                                                                     </tr>
                                                                                                                 </tbody>
                                                                                                             </table>
                                                                                                             <table class='wrapper' role='module' data-type='image' border='0' cellpadding='0' cellspacing='0' width='100%' style='table-layout: fixed;' data-muid='d8508015-a2cb-488c-9877-d46adf313282'>
                                                                                                                 <tbody>
                                                                                                                     <tr>
                                                                                                                         <td style='font-size:6px; line-height:10px; padding:0px 0px 0px 0px;' valign='top' align='center'>
                                                                                                                             <h1><b>UVA CABS</b></h1>
                                                                                                                         </td>
                                                                                                                     </tr>
                                                                                                                 </tbody>
                                                                                                             </table>
                                                                                                             <table class='module' role='module' data-type='spacer' border='0' cellpadding='0' cellspacing='0' width='100%' style='table-layout: fixed;' data-muid='27716fe9-ee64-4a64-94f9-a4f28bc172a0'>
                                                                                                                 <tbody>
                                                                                                                     <tr>
                                                                                                                         <td style='padding:0px 0px 30px 0px;' role='module-content' bgcolor=''>
                                                                                                                         </td>
                                                                                                                     </tr>
                                                                                                                 </tbody>
                                                                                                             </table>
                                                                                                             <table class='module' role='module' data-type='text' border='0' cellpadding='0' cellspacing='0' width='100%' style='table-layout: fixed;' data-muid='948e3f3f-5214-4721-a90e-625a47b1c957' data-mc-module-version='2019-10-22'>
                                                                                                                 <tbody>
                                                                                                                     <tr>
                                                                                                                         <td style='padding:50px 30px 18px 30px; line-height:36px; text-align:inherit; background-color:#ffffff;' height='100%' valign='top' bgcolor='#ffffff' role='module-content'>
                                                                                                                             <div>
                                                                                                                                 <div style='font-family: inherit; text-align: center'><span style='font-size: 30px'>Your booking is success!</span></div>
                                                                                                                                 <div></div>
                                                                                                                             </div>
                                                                                                                         </td>
                                                                                                                     </tr>
                                                                                                                 </tbody>
                                                                                                             </table>
 
                                                                                                             
                                                                                                             
                                                                                                             <table class='wrapper' role='module' data-type='image' border='0' cellpadding='0' cellspacing='0' width='100%' style='table-layout: fixed;' data-muid='d8508015-a2cb-488c-9877-d46adf313282'>
                                                                                                             
                                                                                                             <thead>
                                                                                                                 <th style='background-color:#ffffff; font-size:18px; line-height:10px; padding:50px 0px 0px 0px;' valign='top' align='center'>
                                                                                                                     <b><u>Booking Details<u></b>
                                                                                                                 </th>
                                                                                                             </thead>
                                                                                                             </table>
                                                                                                             <table class='module' role='module' data-type='text' border='0' cellpadding='0' cellspacing='0' width='100%' style='table-layout: fixed;' data-muid='a10dcb57-ad22-4f4d-b765-1d427dfddb4e' data-mc-module-version='2019-10-22'>
                                                                                                                 <tbody >
                                                                                                                     <tr>
                                                                                                                         <td style='padding:50px 5px 2px 60px; width:140px; line-height:36px; text-align:inherit; background-color:#ffffff;' height='100%' valign='top' bgcolor='#ffffff' role='module-content'><b>Origin : </b></td>
                                                                                                                         <td style='padding:50px 30px 2px 5px; line-height:36px; text-align:inherit; background-color:#ffffff;' height='100%' valign='top' bgcolor='#ffffff' role='module-content'>".$origin."</td>
                                                                                                                     </tr>
                                                                                                                     <tr>
                                                                                                                         <td style='padding:2px 5px 2px 60px; line-height:36px; text-align:inherit; background-color:#ffffff;' height='100%' valign='top' bgcolor='#ffffff' role='module-content'><b>Destination : </b></td>
                                                                                                                         <td style='padding:2px 30px 2px 5px; line-height:36px; text-align:inherit; background-color:#ffffff;' height='100%' valign='top' bgcolor='#ffffff' role='module-content'>".$destination."</td>
                                                                                                                     </tr>
                                                                                                                     <tr>
                                                                                                                         <td style='padding:2px 5px 2px 60px; line-height:36px; text-align:inherit; background-color:#ffffff;' height='100%' valign='top' bgcolor='#ffffff' role='module-content'><b>Tour Date : </b></td>
                                                                                                                         <td style='padding:2px 30px 2px 5px; line-height:36px; text-align:inherit; background-color:#ffffff;' height='100%' valign='top' bgcolor='#ffffff' role='module-content'>".$TourDate."</td>
                                                                                                                     </tr>
                                                                                                                     <tr>
                                                                                                                         <td style='padding:2px 5px 2px 60px; line-height:36px; text-align:inherit; background-color:#ffffff;' height='100%' valign='top' bgcolor='#ffffff' role='module-content'><b>Tour Time : </b></td>
                                                                                                                         <td style='padding:2px 30px 2px 5px; line-height:36px; text-align:inherit; background-color:#ffffff;' height='100%' valign='top' bgcolor='#ffffff' role='module-content'>".$TourTime."</td>
                                                                                                                     </tr>
                                                                                                                     <tr>
                                                                                                                         <td style='padding:2px 5px 2px 60px; line-height:36px; text-align:inherit; background-color:#ffffff;' height='100%' valign='top' bgcolor='#ffffff' role='module-content'><b>Vehicle Type : </b></td>
                                                                                                                         <td style='padding:2px 30px 2px 5px; line-height:36px; text-align:inherit; background-color:#ffffff;' height='100%' valign='top' bgcolor='#ffffff' role='module-content'>".$vehicleType."</td>
                                                                                                                     </tr>
                                                                                                                     <tr>
                                                                                                                         <td style='padding:2px 5px 2px 60px; line-height:36px; text-align:inherit; background-color:#ffffff;' height='100%' valign='top' bgcolor='#ffffff' role='module-content'><b>Vehicle No : </b></td>
                                                                                                                         <td style='padding:2px 30px 2px 5px; line-height:36px; text-align:inherit; background-color:#ffffff;' height='100%' valign='top' bgcolor='#ffffff' role='module-content'>".$vehicleNo."</td>
                                                                                                                     </tr>
                                                                                                                     <tr>
                                                                                                                         <td style='padding:2px 5px 2px 60px; line-height:36px; text-align:inherit; background-color:#ffffff;' height='100%' valign='top' bgcolor='#ffffff' role='module-content'><b>Driver Name : </b></td>
                                                                                                                         <td style='padding:2px 30px 2px 5px; line-height:36px; text-align:inherit; background-color:#ffffff;' height='100%' valign='top' bgcolor='#ffffff' role='module-content'>".$driverName."</td>
                                                                                                                     </tr>
                                                                                                                     <tr>
                                                                                                                         <td style='padding:2px 5px 2px 60px; line-height:36px; text-align:inherit; background-color:#ffffff;' height='100%' valign='top' bgcolor='#ffffff' role='module-content'><b>Driver Contact No : </b></td>
                                                                                                                         <td style='padding:2px 30px 2px 5px; line-height:36px; text-align:inherit; background-color:#ffffff;' height='100%' valign='top' bgcolor='#ffffff' role='module-content'>".$driverContactNo."</td>
                                                                                                                     </tr>
                                                                                                                     <tr>
                                                                                                                         <td style='padding:2px 5px 2px 60px; line-height:36px; text-align:inherit; background-color:#ffffff;' height='100%' valign='top' bgcolor='#ffffff' role='module-content'><b>Booking Id : </b></td>
                                                                                                                         <td style='padding:2px 30px 2px 5px; line-height:36px; text-align:inherit; background-color:#ffffff;' height='100%' valign='top' bgcolor='#ffffff' role='module-content'>".$bookingId."</td>
                                                                                                                     </tr>
                                                                                                                 </tbody>             
                                                                                                             </table>
                                                                                                             <table class='wrapper' role='module' data-type='image' border='0' cellpadding='0' cellspacing='0' width='100%' style='table-layout: fixed;' data-muid='d8508015-a2cb-488c-9877-d46adf313282'>
                                                                                                             <thead>
                                                                                                                 <th style='background-color:#ffffff; font-size:18px; line-height:10px; padding:50px 0px 0px 0px;' valign='top' align='center'>
                                                                                                                     <b><u>Payment Details<u></b>
                                                                                                                 </th>
                                                                                                             </thead>
                                                                                                             </table>
                                                                                                             <table class='module' role='module' data-type='text' border='0' cellpadding='0' cellspacing='0' width='100%' style='table-layout: fixed;' data-muid='a10dcb57-ad22-4f4d-b765-1d427dfddb4e' data-mc-module-version='2019-10-22'>
                                                                                                                 <tbody >
                                                                                                                     <tr>
                                                                                                                         <td style='padding:50px 5px 2px 60px; width:140px; line-height:36px; text-align:inherit; background-color:#ffffff;' height='100%' valign='top' bgcolor='#ffffff' role='module-content'><b>Payment Id : </b></td>
                                                                                                                         <td style='padding:50px 30px 2px 5px; line-height:36px; text-align:inherit; background-color:#ffffff;' height='100%' valign='top' bgcolor='#ffffff' role='module-content'>".$paymentId."</td>
                                                                                                                     </tr>
                                                                                                                     <tr>
                                                                                                                         <td style='padding:2px 5px 2px 60px; line-height:36px; text-align:inherit; background-color:#ffffff;' height='100%' valign='top' bgcolor='#ffffff' role='module-content'><b>Card No : </b></td>
                                                                                                                         <td style='padding:2px 30px 2px 5px; line-height:36px; text-align:inherit; background-color:#ffffff;' height='100%' valign='top' bgcolor='#ffffff' role='module-content'>".$cardNo."</td>
                                                                                                                     </tr>
                                                                                                                     <tr>
                                                                                                                         <td style='padding:2px 5px 2px 60px; line-height:36px; text-align:inherit; background-color:#ffffff;' height='100%' valign='top' bgcolor='#ffffff' role='module-content'><b>Payment Type: </b></td>
                                                                                                                         <td style='padding:2px 30px 2px 5px; line-height:36px; text-align:inherit; background-color:#ffffff;' height='100%' valign='top' bgcolor='#ffffff' role='module-content'>".$paymentType."</td>
                                                                                                                     </tr>
                                                                                                                     <tr>
                                                                                                                         <td style='padding:2px 0px 2px 60px; line-height:36px; text-align:inherit; background-color:#ffffff;' height='100%' valign='top' bgcolor='#ffffff' role='module-content'><hr></td>
                                                                                                                         <td style='padding:2px 30px 2px 0px; line-height:36px; text-align:inherit; background-color:#ffffff;' height='100%' valign='top' bgcolor='#ffffff' role='module-content'><hr></td>
                                                                                                                     </tr>
                                                                                                                     <tr>
                                                                                                                         <td style='padding:2px 5px 2px 60px; line-height:36px; text-align:inherit; background-color:#ffffff;' height='100%' valign='top' bgcolor='#ffffff' role='module-content'><b>Total Fare : </b></td>
                                                                                                                         <td style='padding:2px 30px 2px 5px; line-height:36px; text-align:inherit; background-color:#ffffff;' height='100%' valign='top' bgcolor='#ffffff' role='module-content'>".$totalFare."</td>
                                                                                                                     </tr>
                                                                                                                     <tr>
                                                                                                                         <td style='padding:2px 5px 2px 60px; line-height:36px; text-align:inherit; background-color:#ffdfff;' height='100%' valign='top' bgcolor='#ffffff' role='module-content'><b>Payed Amount : </b></td>
                                                                                                                         <td style='padding:2px 30px 2px 5px; line-height:36px; text-align:inherit; background-color:#ffdfff;' height='100%' valign='top' bgcolor='#ffffff' role='module-content'>".$payedAmount."</td>
                                                                                                                     </tr>
                                                                                                                     <tr>
                                                                                                                         <td style='padding:2px 0px 2px 60px; line-height:36px; text-align:inherit; background-color:#ffffff;' height='100%' valign='top' bgcolor='#ffffff' role='module-content'><hr></td>
                                                                                                                         <td style='padding:2px 30px 2px 0px; line-height:36px; text-align:inherit; background-color:#ffffff;' height='100%' valign='top' bgcolor='#ffffff' role='module-content'><hr></td>
                                                                                                                     </tr>
                                                                                                                     <tr>
                                                                                                                         <td style='padding:2px 5px 0px 60px; line-height:36px; text-align:inherit; background-color:#f5d5d5;' height='100%' valign='top' bgcolor='#ffffff' role='module-content'><b>You need to pay: </b></td>
                                                                                                                         <td style='padding:2px 30px 0px 5px; line-height:36px; text-align:inherit; background-color:#f5d5d5; color:red;' height='100%' valign='top' bgcolor='#ffffff' role='module-content'><b>".$needToPay."</b></td>
                                                                                                                     </tr>
                                                                                                                     <tr>
                                                                                                                         <td style='padding:0px 0px 2px 60px; line-height:36px; text-align:inherit; background-color:#ffffff;' height='100%' valign='top' bgcolor='#ffffff' role='module-content'><hr><hr></td>
                                                                                                                         <td style='padding:0px 30px 2px 0px; line-height:36px; text-align:inherit; background-color:#ffffff;' height='100%' valign='top' bgcolor='#ffffff' role='module-content'><hr><hr></td>
                                                                                                                     </tr>
                                                                                                                     </tr>
                                                                                                                 </tbody>             
                                                                                                             </table>
                                                                                                             <table class='module' role='module' data-type='text' border='0' cellpadding='0' cellspacing='0' width='100%' style='table-layout: fixed;' data-muid='a10dcb57-ad22-4f4d-b765-1d427dfddb4e' data-mc-module-version='2019-10-22'>
                                                                                                                 <tbody>
                                                                                                                     <tr>
                                                                                                                         <td style=' text-align:inherit; background-color:#ffffff;' height='100%' valign='top' bgcolor='#ffffff' role='module-content'>
                                                                                                                             <div>
                                                                                                                                 <div style='font-family: inherit; text-align: center'><span style='color: #000; font-size: 14px'><strong><a style='color: #000;' href='mailto:uvacabs0@gmail.com'><i class='fa fa-envelope' aria-hidden='true'> Email</i></strong></span> | <span style='color: #000; font-size: 10px'><strong><a style='color: #000;' href='tel:+94765340878'><i class='fa fa-phone' aria-hidden='true'> Call Us</i></strong></span></div>
                                                                                                                                 
                                                                                                                             </div>
                                                                                                                         </td>
                                                                                                                     </tr>
                                                                                                                 </tbody>
                                                                                                             </table>
                                                                                                             <table class='module' role='module' data-type='spacer' border='0' cellpadding='0' cellspacing='0' width='100%' style='table-layout: fixed;' data-muid='7770fdab-634a-4f62-a277-1c66b2646d8d'>
                                                                                                                 <tbody>
                                                                                                                     <tr>
                                                                                                                         <td style='padding:0px 0px 20px 0px;' role='module-content' bgcolor='#ffffff'>
                                                                                                                         </td>
                                                                                                                     </tr>
                                                                                                                 </tbody>
                                                                                                             </table>
                                                                                                             <table border='0' cellpadding='0' cellspacing='0' class='module' data-role='module-button' data-type='button' role='module' style='table-layout:fixed;' width='100%' data-muid='d050540f-4672-4f31-80d9-b395dc08abe1'>
                                                                                                                 <tbody>
                                                                                                                     <tr>
                                                                                                                         <td align='center' bgcolor='#ffffff' class='outer-td' style='padding:0px 0px 0px 0px;'>
                                                                                                                             <table border='0' cellpadding='0' cellspacing='0' class='wrapper-mobile' style='text-align:center;'>
                                                                                                                                 <tbody>
                                                                                                                                     <tr>
                                                                                                                                     <td align='center' bgcolor='#ffbe00;' class='inner-td' style='border-radius:6px; font-size:16px; text-align:center; background-color:inherit;'>
                                                                                                                                        <b><p style='color: red;'>This is an automatically system genarated email. Don't reply.</p></b>
                                                                                                                                     </td>
                                                                                                                                     </tr>
                                                                                                                                 </tbody>
                                                                                                                             </table>
                                                                                                                         </td>
                                                                                                                     </tr>
                                                                                                                 </tbody>
                                                                                                             </table>
                                                                                                             <table class='module' role='module' data-type='spacer' border='0' cellpadding='0' cellspacing='0' width='100%' style='table-layout: fixed;' data-muid='7770fdab-634a-4f62-a277-1c66b2646d8d.1'>
                                                                                                                 <tbody>
                                                                                                                     <tr>
                                                                                                                         <td style='padding:0px 0px 50px 0px;' role='module-content' bgcolor='#ffffff'>
                                                                                                                         </td>
                                                                                                                     </tr>
                                                                                                                 </tbody>
                                                                                                             </table>
                                                                                                         </td>
                                                                                                     </tr>
                                                                                                 </tbody>
                                                                                             </table>
 
                                                                                         </td>
                                                                                     </tr>
                                                                                 </tbody>
                                                                             </table>
                                                                             <div data-role='module-unsubscribe' class='module' role='module' data-type='unsubscribe' style='color:#444444; font-size:12px; line-height:20px; padding:16px 16px 16px 16px; text-align:Center;' data-muid='4e838cf3-9892-4a6d-94d6-170e474d21e5'>
                                                                                 <div class='Unsubscribe--addressLine'>
                                                                                     <p class='Unsubscribe--senderName' style='font-size:12px; line-height:20px;'>UVA CABS | BADULLA</p>
                                                                                 </div>
                                                                             </div>
                                                                             <table border='0' cellpadding='0' cellspacing='0' class='module' data-role='module-button' data-type='button' role='module' style='table-layout:fixed;' width='100%' data-muid='550f60a9-c478-496c-b705-077cf7b1ba9a'>
                                                                                 <tbody>
                                                                                     <tr>
                                                                                         <td align='center' bgcolor='' class='outer-td' style='padding:0px 0px 20px 0px;'>
                                                                                             <table border='0' cellpadding='0' cellspacing='0' class='wrapper-mobile' style='text-align:center;'>
                                                                                                 <tbody>
                                                                                                     <tr>
                                                                                                         <td align='center' bgcolor='#f5f8fd' class='inner-td' style='border-radius:6px; font-size:16px; text-align:center; background-color:inherit;'>
                                                                                                             <a href='http://www.uvacabs.company' style='background-color:#f5f8fd; border:1px solid #f5f8fd; border-color:#f5f8fd; border-radius:25px; border-width:1px; color:#a8b9d5; display:inline-block; font-size:10px; font-weight:normal; letter-spacing:0px; line-height:normal; padding:5px 18px 5px 18px; text-align:center; text-decoration:none; border-style:solid; font-family:helvetica,sans-serif;'
                                                                                                                 target='_blank'>www.uvacabs.company</a>
                                                                                                             <br>
                                                                                                             <p style='background-color:#f5f8fd; border:1px solid #f5f8fd; border-color:#f5f8fd; border-radius:25px; border-width:1px; color:#a8b9d5; display:inline-block; font-size:10px; font-weight:normal; letter-spacing:0px; line-height:normal; padding:5px 18px 5px 18px; text-align:center; text-decoration:none; border-style:solid; font-family:helvetica,sans-serif;'
                                                                                                                 target='_blank'>&copy; 2020 ALL RIGHT RESERVED</p>
                                                                                                         </td>
                                                                                                     </tr>
                                                                                                 </tbody>
                                                                                             </table>
                                                                                         </td>
                                                                                     </tr>
                                                                                 </tbody>
                                                                             </table>
                                                                         </td>
                                                                     </tr>
                                                                 </tbody>
                                                             </table>
 
                                                         </td>
                                                     </tr>
                                                 </tbody>
                                             </table>
                                         </td>
                                     </tr>
                                 </tbody>
                             </table>
                         </td>
                     </tr>
                 </tbody>
             </table>
         </div>
     </center>
 
 
 </body>
 
 </html>
 
 "
 
 
 
 
 
                        ,
        'from'      => "noreply@uvacabs.company",
      );
    
    
    $request =  $url.'api/mail.send.json';
    
    // Generate curl request
    $session = curl_init($request);
    // Tell curl to use HTTP POST
    curl_setopt ($session, CURLOPT_POST, true);
    // Tell curl that this is the body of the POST
    curl_setopt ($session, CURLOPT_POSTFIELDS, $params);
    // Tell curl not to return headers, but do return the response
    curl_setopt($session, CURLOPT_HEADER, false);
    // Tell PHP not to use SSLv3 (instead opting for TLS)
    curl_setopt($session, CURLOPT_SSLVERSION, CURL_SSLVERSION_TLSv1_2);
    curl_setopt($session, CURLOPT_RETURNTRANSFER, true);
    
    // obtain response
    $response = curl_exec($session);
    curl_close($session);
    
    // print everything out
    print_r($response);
    
 
 }



/////////////////////////////////SEND EMAIL TO DRIVER/////////////////////////////////////

 function sendemailtoDriver($drEmail,$origin,$destination,$TourDate,$TourTime,$vehicleType,$vehicleNo,$bookingId,$needToPay,$cusName,$cusConNo,$cusAddress){
  
   
    $url = 'https://api.sendgrid.com/';
    $user = 'vidurarandika96@gmail.com';
    $pass = '20168268werty';
    
    $json_string = array(
    
      'to' => array(
        $drEmail,
      ),
      'category' => 'New Job Driver'
    );
    
    
    $params = array(
        'api_user'  => $user,
        'api_key'   => $pass,
        'x-smtpapi' => json_encode($json_string),
        'to'        => $drEmail,
        'subject'   => 'New Job',
        'html'      => "
 
        <!DOCTYPE html>
        <html lang='en'>
        <head>
            <meta http-equiv='Content-Type' content='text/html; charset=utf-8'>
            <meta name='viewport' content='width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1'>
            <meta http-equiv='X-UA-Compatible' content='IE=Edge'>
            <style type='text/css'>
                body,
                p,
                div {
                    font-family: inherit;
                    font-size: 14px;
                }
                
                body {
                    color: #000000;
                }
                
                body a {
                    color: #1188E6;
                    text-decoration: none;
                }
                
                p {
                    margin: 0;
                    padding: 0;
                }
                
                table.wrapper {
                    width: 100% !important;
                    table-layout: fixed;
                    -webkit-font-smoothing: antialiased;
                    -webkit-text-size-adjust: 100%;
                    -moz-text-size-adjust: 100%;
                    -ms-text-size-adjust: 100%;
                }
                
                img.max-width {
                    max-width: 100% !important;
                }
                
                .column.of-2 {
                    width: 50%;
                }
                
                .column.of-3 {
                    width: 33.333%;
                }
                
                .column.of-4 {
                    width: 25%;
                }
                
                @media screen and (max-width:480px) {
                    .preheader .rightColumnContent,
                    .footer .rightColumnContent {
                        text-align: left !important;
                    }
                    .preheader .rightColumnContent div,
                    .preheader .rightColumnContent span,
                    .footer .rightColumnContent div,
                    .footer .rightColumnContent span {
                        text-align: left !important;
                    }
                    .preheader .rightColumnContent,
                    .preheader .leftColumnContent {
                        font-size: 80% !important;
                        padding: 5px 0;
                    }
                    table.wrapper-mobile {
                        width: 100% !important;
                        table-layout: fixed;
                    }
                    img.max-width {
                        height: auto !important;
                        max-width: 100% !important;
                    }
                    a.bulletproof-button {
                        display: block !important;
                        width: auto !important;
                        font-size: 80%;
                        padding-left: 0 !important;
                        padding-right: 0 !important;
                    }
                    .columns {
                        width: 100% !important;
                    }
                    .column {
                        display: block !important;
                        width: 100% !important;
                        padding-left: 0 !important;
                        padding-right: 0 !important;
                        margin-left: 0 !important;
                        margin-right: 0 !important;
                    }
                }
            </style>
            <link href='https://fonts.googleapis.com/css?family=Muli&display=swap' rel='stylesheet'>
            <link href='https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css' rel='stylesheet'>
            <style>
                body {
                    font-family: 'Muli', sans-serif;
                }
            </style>
        </head>
        
        <body>
            <center class='wrapper' data-link-color='#1188E6' data-body-style='font-size:14px; font-family:inherit; color:#000000; background-color:#FFFFFF;'>
                <div class='webkit'>
                    <table cellpadding='0' cellspacing='0' border='0' width='100%' class='wrapper' bgcolor='#FFFFFF'>
                        <tbody>
                            <tr>
                                <td valign='top' bgcolor='#FFFFFF' width='100%'>
                                    <table width='100%' role='content-container' class='outer' align='center' cellpadding='0' cellspacing='0' border='0'>
                                        <tbody>
                                            <tr>
                                                <td width='100%'>
                                                    <table width='100%' cellpadding='0' cellspacing='0' border='0'>
                                                        <tbody>
                                                            <tr>
                                                                <td>
                                                                    <table width='100%' cellpadding='0' cellspacing='0' border='0' style='width:100%; max-width:600px;' align='center'>
                                                                        <tbody>
                                                                            <tr>
                                                                                <td role='modules-container' style='padding:0px 0px 0px 0px; color:#000000; text-align:left;' bgcolor='#FFFFFF' width='100%' align='left'>
                                                                                    <table class='module preheader preheader-hide' role='module' data-type='preheader' border='0' cellpadding='0' cellspacing='0' width='100%' style='display: none !important; mso-hide: all; visibility: hidden; opacity: 0; color: transparent; height: 0; width: 0;'>
                                                                                        <tbody>
                                                                                            <tr>
                                                                                                <td role='module-content'>
                                                                                                    <p></p>
                                                                                                </td>
                                                                                            </tr>
                                                                                        </tbody>
                                                                                    </table>
                                                                                    <table border='0' cellpadding='0' cellspacing='0' align='center' width='100%' role='module' data-type='columns' style='padding:30px 20px 30px 20px;' bgcolor='#f6f6f6'>
                                                                                        <tbody>
                                                                                            <tr role='module-content'>
                                                                                                <td height='100%' valign='top'>
                                                                                                    <table class='column' width='540' style='width:540px; border-spacing:0; border-collapse:collapse; margin:0px 10px 0px 10px;' cellpadding='0' cellspacing='0' align='left' border='0' bgcolor=''>
                                                                                                        <tbody>
                                                                                                            <tr>
                                                                                                                <td style='padding:0px;margin:0px;border-spacing:0;'>
                                                                                                                    <table class='wrapper' role='module' data-type='image' border='0' cellpadding='0' cellspacing='0' width='100%' style='table-layout: fixed;' data-muid='72aac1ba-9036-4a77-b9d5-9a60d9b05cba'>
                                                                                                                        <tbody>
                                                                                                                            <tr>
                                                                                                                                <td style='font-size:6px; line-height:10px; padding:0px 0px 0px 0px;' valign='top' align='center'>
                                                                                                                                    <img class='max-width' border='0' style='display:block; color:#000000; text-decoration:none; font-family:Helvetica, arial, sans-serif; font-size:16px;' width='100' alt='' data-proportionally-constrained='true' data-responsive='false' src='http://uvacabs.company/img/logo.png'
                                                                                                                                        height='100'>
                                                                                                                                </td>
                                                                                                                            </tr>
                                                                                                                        </tbody>
                                                                                                                    </table>
                                                                                                                    <table class='module' role='module' data-type='spacer' border='0' cellpadding='0' cellspacing='0' width='100%' style='table-layout: fixed;' data-muid='331cde94-eb45-45dc-8852-b7dbeb9101d7'>
                                                                                                                        <tbody>
                                                                                                                            <tr>
                                                                                                                                <td style='padding:0px 0px 20px 0px;' role='module-content' bgcolor=''>
                                                                                                                                </td>
                                                                                                                            </tr>
                                                                                                                        </tbody>
                                                                                                                    </table>
                                                                                                                    <table class='wrapper' role='module' data-type='image' border='0' cellpadding='0' cellspacing='0' width='100%' style='table-layout: fixed;' data-muid='d8508015-a2cb-488c-9877-d46adf313282'>
                                                                                                                        <tbody>
                                                                                                                            <tr>
                                                                                                                                <td style='font-size:6px; line-height:10px; padding:0px 0px 0px 0px;' valign='top' align='center'>
                                                                                                                                    <h1><b>UVA CABS</b></h1>
                                                                                                                                </td>
                                                                                                                            </tr>
                                                                                                                        </tbody>
                                                                                                                    </table>
                                                                                                                    <table class='module' role='module' data-type='spacer' border='0' cellpadding='0' cellspacing='0' width='100%' style='table-layout: fixed;' data-muid='27716fe9-ee64-4a64-94f9-a4f28bc172a0'>
                                                                                                                        <tbody>
                                                                                                                            <tr>
                                                                                                                                <td style='padding:0px 0px 30px 0px;' role='module-content' bgcolor=''>
                                                                                                                                </td>
                                                                                                                            </tr>
                                                                                                                        </tbody>
                                                                                                                    </table>
                                                                                                                    <table class='module' role='module' data-type='text' border='0' cellpadding='0' cellspacing='0' width='100%' style='table-layout: fixed;' data-muid='948e3f3f-5214-4721-a90e-625a47b1c957' data-mc-module-version='2019-10-22'>
                                                                                                                        <tbody>
                                                                                                                            <tr>
                                                                                                                                <td style='padding:50px 30px 18px 30px; line-height:36px; text-align:inherit; background-color:#ffffff;' height='100%' valign='top' bgcolor='#ffffff' role='module-content'>
                                                                                                                                    <div>
                                                                                                                                        <div style='font-family: inherit; text-align: center'><span style='font-size: 30px'>You have new job</span></div>
                                                                                                                                        <div></div>
                                                                                                                                    </div>
                                                                                                                                </td>
                                                                                                                            </tr>
                                                                                                                        </tbody>
                                                                                                                    </table>
        
                                                                                                                    
                                                                                                                    <!--////////////////////////////////////////////////////////////////////////////////-->
                                                                                                                    <table class='wrapper' role='module' data-type='image' border='0' cellpadding='0' cellspacing='0' width='100%' style='table-layout: fixed;' data-muid='d8508015-a2cb-488c-9877-d46adf313282'>
                                                                                                                    
                                                                                                                    <thead>
                                                                                                                        <th style='background-color:#ffffff; font-size:18px; line-height:10px; padding:50px 0px 0px 0px;' valign='top' align='center'>
                                                                                                                            <b><u>Job Details<u></b>
                                                                                                                        </th>
                                                                                                                    </thead>
                                                                                                                    </table>
                                                                                                                    <table class='module' role='module' data-type='text' border='0' cellpadding='0' cellspacing='0' width='100%' style='table-layout: fixed;' data-muid='a10dcb57-ad22-4f4d-b765-1d427dfddb4e' data-mc-module-version='2019-10-22'>
                                                                                                                        <tbody >
                                                                                                                            <tr>
                                                                                                                                <td style='padding:50px 5px 2px 60px; width:140px; line-height:36px; text-align:inherit; background-color:#ffffff;' height='100%' valign='top' bgcolor='#ffffff' role='module-content'><b>Origin : </b></td>
                                                                                                                                <td style='padding:50px 30px 2px 5px; line-height:36px; text-align:inherit; background-color:#ffffff;' height='100%' valign='top' bgcolor='#ffffff' role='module-content'>".$origin."</td>
                                                                                                                            </tr>
                                                                                                                            <tr>
                                                                                                                                <td style='padding:2px 5px 2px 60px; line-height:36px; text-align:inherit; background-color:#ffffff;' height='100%' valign='top' bgcolor='#ffffff' role='module-content'><b>Destination : </b></td>
                                                                                                                                <td style='padding:2px 30px 2px 5px; line-height:36px; text-align:inherit; background-color:#ffffff;' height='100%' valign='top' bgcolor='#ffffff' role='module-content'>".$destination."</td>
                                                                                                                            </tr>
                                                                                                                            <tr>
                                                                                                                                <td style='padding:2px 5px 2px 60px; line-height:36px; text-align:inherit; background-color:#ffffff;' height='100%' valign='top' bgcolor='#ffffff' role='module-content'><b>Tour Date : </b></td>
                                                                                                                                <td style='padding:2px 30px 2px 5px; line-height:36px; text-align:inherit; background-color:#ffffff;' height='100%' valign='top' bgcolor='#ffffff' role='module-content'>".$TourDate."</td>
                                                                                                                            </tr>
                                                                                                                            <tr>
                                                                                                                                <td style='padding:2px 5px 2px 60px; line-height:36px; text-align:inherit; background-color:#ffffff;' height='100%' valign='top' bgcolor='#ffffff' role='module-content'><b>Tour Time : </b></td>
                                                                                                                                <td style='padding:2px 30px 2px 5px; line-height:36px; text-align:inherit; background-color:#ffffff;' height='100%' valign='top' bgcolor='#ffffff' role='module-content'>".$TourTime."</td>
                                                                                                                            </tr>
                                                                                                                            <tr>
                                                                                                                                <td style='padding:2px 5px 2px 60px; line-height:36px; text-align:inherit; background-color:#ffffff;' height='100%' valign='top' bgcolor='#ffffff' role='module-content'><b>Vehicle Type : </b></td>
                                                                                                                                <td style='padding:2px 30px 2px 5px; line-height:36px; text-align:inherit; background-color:#ffffff;' height='100%' valign='top' bgcolor='#ffffff' role='module-content'>".$vehicleType."</td>
                                                                                                                            </tr>
                                                                                                                            <tr>
                                                                                                                                <td style='padding:2px 5px 2px 60px; line-height:36px; text-align:inherit; background-color:#ffffff;' height='100%' valign='top' bgcolor='#ffffff' role='module-content'><b>Vehicle No : </b></td>
                                                                                                                                <td style='padding:2px 30px 2px 5px; line-height:36px; text-align:inherit; background-color:#ffffff;' height='100%' valign='top' bgcolor='#ffffff' role='module-content'>".$vehicleNo."</td>
                                                                                                                            </tr>
                                                                                                                            <tr>
                                                                                                                                <td style='padding:2px 5px 2px 60px; line-height:36px; text-align:inherit; background-color:#ffffff;' height='100%' valign='top' bgcolor='#ffffff' role='module-content'><b>Booking Id : </b></td>
                                                                                                                                <td style='padding:2px 30px 2px 5px; line-height:36px; text-align:inherit; background-color:#ffffff;' height='100%' valign='top' bgcolor='#ffffff' role='module-content'>".$bookingId."</td>
                                                                                                                            </tr>
                                                                                                                            <tr>
                                                                                                                                <td style='padding:2px 5px 0px 60px; line-height:36px; text-align:inherit; background-color:#f5d5d5;' height='100%' valign='top' bgcolor='#ffffff' role='module-content'><b>Customer needs to pay: </b></td>
                                                                                                                                <td style='padding:2px 30px 0px 5px; line-height:36px; text-align:inherit; background-color:#f5d5d5; color:red;' height='100%' valign='top' bgcolor='#ffffff' role='module-content'><b>".$needToPay."</b></td>
                                                                                                                            </tr>
                                                                                                                            <tr>
                                                                                                                                <td style='padding:2px 5px 2px 60px; line-height:36px; text-align:inherit; background-color:#ffffff;' height='100%' valign='top' bgcolor='#ffffff' role='module-content'><b>Customer Name : </b></td>
                                                                                                                                <td style='padding:2px 30px 2px 5px; line-height:36px; text-align:inherit; background-color:#ffffff;' height='100%' valign='top' bgcolor='#ffffff' role='module-content'>".$cusName."</td>
                                                                                                                            </tr>
                                                                                                                            <tr>
                                                                                                                                <td style='padding:2px 5px 2px 60px; line-height:36px; text-align:inherit; background-color:#ffffff;' height='100%' valign='top' bgcolor='#ffffff' role='module-content'><b>Customer Phone No : </b></td>
                                                                                                                                <td style='padding:2px 30px 2px 5px; line-height:36px; text-align:inherit; background-color:#ffffff;' height='100%' valign='top' bgcolor='#ffffff' role='module-content'>".$cusConNo."</td>
                                                                                                                            </tr>
                                                                                                                            <tr>
                                                                                                                                <td style='padding:2px 5px 2px 60px; line-height:36px; text-align:inherit; background-color:#ffffff;' height='100%' valign='top' bgcolor='#ffffff' role='module-content'><b>Customer Address : </b></td>
                                                                                                                                <td style='padding:2px 30px 2px 5px; line-height:36px; text-align:inherit; background-color:#ffffff;' height='100%' valign='top' bgcolor='#ffffff' role='module-content'>".$cusAddress."</td>
                                                                                                                            </tr>
        
                                                                                                                        </tbody>             
                                                                                                                    </table>
                                                                                                                    <table class='module' role='module' data-type='text' border='0' cellpadding='0' cellspacing='0' width='100%' style='table-layout: fixed;' data-muid='a10dcb57-ad22-4f4d-b765-1d427dfddb4e' data-mc-module-version='2019-10-22'>
                                                                                                                        <tbody>
                                                                                                                            <tr>
                                                                                                                                <td style=' text-align:inherit; background-color:#ffffff;' height='100%' valign='top' bgcolor='#ffffff' role='module-content'>
                                                                                                                                    <div>
                                                                                                                                        <div style='font-family: inherit; text-align: center'><span style='color: #000; font-size: 14px'><strong><a style='color: #000;' href='mailto:uvacabs0@gmail.com'><i class='fa fa-envelope' aria-hidden='true'> Email</i></strong></span> | <span style='color: #000; font-size: 10px'><strong><a style='color: #000;' href='tel:+94765340878'><i class='fa fa-phone' aria-hidden='true'> Call Us</i></strong></span></div>
                                                                                                                                        
                                                                                                                                    </div>
                                                                                                                                </td>
                                                                                                                            </tr>
                                                                                                                        </tbody>
                                                                                                                    </table>
                                                                                                                    <table class='module' role='module' data-type='spacer' border='0' cellpadding='0' cellspacing='0' width='100%' style='table-layout: fixed;' data-muid='7770fdab-634a-4f62-a277-1c66b2646d8d'>
                                                                                                                        <tbody>
                                                                                                                            <tr>
                                                                                                                                <td style='padding:0px 0px 20px 0px;' role='module-content' bgcolor='#ffffff'>
                                                                                                                                </td>
                                                                                                                            </tr>
                                                                                                                        </tbody>
                                                                                                                    </table>
                                                                                                                    <table border='0' cellpadding='0' cellspacing='0' class='module' data-role='module-button' data-type='button' role='module' style='table-layout:fixed;' width='100%' data-muid='d050540f-4672-4f31-80d9-b395dc08abe1'>
                                                                                                                        <tbody>
                                                                                                                            <tr>
                                                                                                                                <td align='center' bgcolor='#ffffff' class='outer-td' style='padding:0px 0px 0px 0px;'>
                                                                                                                                    <table border='0' cellpadding='0' cellspacing='0' class='wrapper-mobile' style='text-align:center;'>
                                                                                                                                        <tbody>
                                                                                                                                            <tr>
                                                                                                                                            <td align='center' bgcolor='#ffbe00;' class='inner-td' style='border-radius:6px; font-size:16px; text-align:center; background-color:inherit;'>
                                                                                                                                               <b><p style='color: red;'>This is an automatically system genarated email. Don't reply.</p></b>
                                                                                                                                            </td>
                                                                                                                                            </tr>
                                                                                                                                        </tbody>
                                                                                                                                    </table>
                                                                                                                                </td>
                                                                                                                            </tr>
                                                                                                                        </tbody>
                                                                                                                    </table>
                                                                                                                    <table class='module' role='module' data-type='spacer' border='0' cellpadding='0' cellspacing='0' width='100%' style='table-layout: fixed;' data-muid='7770fdab-634a-4f62-a277-1c66b2646d8d.1'>
                                                                                                                        <tbody>
                                                                                                                            <tr>
                                                                                                                                <td style='padding:0px 0px 50px 0px;' role='module-content' bgcolor='#ffffff'>
                                                                                                                                </td>
                                                                                                                            </tr>
                                                                                                                        </tbody>
                                                                                                                    </table>
                                                                                                                </td>
                                                                                                            </tr>
                                                                                                        </tbody>
                                                                                                    </table>
        
                                                                                                </td>
                                                                                            </tr>
                                                                                        </tbody>
                                                                                    </table>
                                                                                    <div data-role='module-unsubscribe' class='module' role='module' data-type='unsubscribe' style='color:#444444; font-size:12px; line-height:20px; padding:16px 16px 16px 16px; text-align:Center;' data-muid='4e838cf3-9892-4a6d-94d6-170e474d21e5'>
                                                                                        <div class='Unsubscribe--addressLine'>
                                                                                            <p class='Unsubscribe--senderName' style='font-size:12px; line-height:20px;'>UVA CABS | BADULLA</p>
                                                                                        </div>
                                                                                    </div>
                                                                                    <table border='0' cellpadding='0' cellspacing='0' class='module' data-role='module-button' data-type='button' role='module' style='table-layout:fixed;' width='100%' data-muid='550f60a9-c478-496c-b705-077cf7b1ba9a'>
                                                                                        <tbody>
                                                                                            <tr>
                                                                                                <td align='center' bgcolor='' class='outer-td' style='padding:0px 0px 20px 0px;'>
                                                                                                    <table border='0' cellpadding='0' cellspacing='0' class='wrapper-mobile' style='text-align:center;'>
                                                                                                        <tbody>
                                                                                                            <tr>
                                                                                                                <td align='center' bgcolor='#f5f8fd' class='inner-td' style='border-radius:6px; font-size:16px; text-align:center; background-color:inherit;'>
                                                                                                                    <a href='http://www.uvacabs.company' style='background-color:#f5f8fd; border:1px solid #f5f8fd; border-color:#f5f8fd; border-radius:25px; border-width:1px; color:#a8b9d5; display:inline-block; font-size:10px; font-weight:normal; letter-spacing:0px; line-height:normal; padding:5px 18px 5px 18px; text-align:center; text-decoration:none; border-style:solid; font-family:helvetica,sans-serif;'
                                                                                                                        target='_blank'>www.uvacabs.company</a>
                                                                                                                    <br>
                                                                                                                    <p style='background-color:#f5f8fd; border:1px solid #f5f8fd; border-color:#f5f8fd; border-radius:25px; border-width:1px; color:#a8b9d5; display:inline-block; font-size:10px; font-weight:normal; letter-spacing:0px; line-height:normal; padding:5px 18px 5px 18px; text-align:center; text-decoration:none; border-style:solid; font-family:helvetica,sans-serif;'
                                                                                                                        target='_blank'>&copy; 2020 ALL RIGHT RESERVED</p>
                                                                                                                </td>
                                                                                                            </tr>
                                                                                                        </tbody>
                                                                                                    </table>
                                                                                                </td>
                                                                                            </tr>
                                                                                        </tbody>
                                                                                    </table>
                                                                                </td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
        
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </center>
        
        
        </body>
        
        </html>
 
 "
 
 
 
 
 
                        ,
        'from'      => "cashier@uvacabs.company",
      );
    
    
    $request =  $url.'api/mail.send.json';
    
    // Generate curl request
    $session = curl_init($request);
    // Tell curl to use HTTP POST
    curl_setopt ($session, CURLOPT_POST, true);
    // Tell curl that this is the body of the POST
    curl_setopt ($session, CURLOPT_POSTFIELDS, $params);
    // Tell curl not to return headers, but do return the response
    curl_setopt($session, CURLOPT_HEADER, false);
    // Tell PHP not to use SSLv3 (instead opting for TLS)
    curl_setopt($session, CURLOPT_SSLVERSION, CURL_SSLVERSION_TLSv1_2);
    curl_setopt($session, CURLOPT_RETURNTRANSFER, true);
    
    // obtain response
    $response = curl_exec($session);
    curl_close($session);
    
    // print everything out
    print_r($response);
    
 
 }

 sendemailtocustomer($cEmail,$org,$dest,$date,$time,$vehType,$vno,$drName,$drConNo,$bId,$pId,$cNo,$pt,$tot,$ch,$nePay);
 sendemailtoDriver($dEmail,$org,$dest,$date,$time,$vehType,$vno,$bId,$nePay,$cName,$cPno,$cAddress);
session_start();
 $_SESSION['sendMsg'] = "SENT";
 header('location: ../viewbooking.php');
 
 }

?>
