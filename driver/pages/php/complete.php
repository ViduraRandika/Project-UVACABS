<?php
session_start();
include('dbconfig.php');
$customerNic = "";
$driverNic ="";
$res = "";
if(isset($_GET['bookingId'])){
    $bookingId = $_GET['bookingId'];
    $sql = "SELECT * FROM booking WHERE bookingId = '$bookingId' LIMIT 1";
    if(mysqli_num_rows(mysqli_query($db,$sql)) == 1){
        $res = mysqli_fetch_assoc(mysqli_query($db,$sql));
        $sql2 = "UPDATE booking SET status = 'completed' WHERE bookingId = '$bookingId'";
        if(mysqli_query($db,$sql2)){
            $_SESSION['completeBooking']="completed";

            sendemailtoDriver($res['driverNic'],$db);
            sendemailtocustomer($res['customerNic'],$db);

            header('location: ../driver.php');
        }else{
            echo "error in sql2";
        }
    }else{
        header('location: ../driver.php');
    }
}else{
    header('location: ../driver.php');
}

function sendemailtodriver($driverNic,$db){
    $sqlD = "SELECT * FROM driver WHERE driverNic = '$driverNic'";
   $resd= mysqli_fetch_assoc(mysqli_query($db,$sqlD));
   $email = $resd['driverEmail'];
    $url = 'https://api.sendgrid.com/';
    $user = 'vidurarandika96@gmail.com';
    $pass = '20168268werty';

    $json_string = array(

        'to' => array(
            $email,
        ),
        'category' => 'Job Complete'
    );


    $params = array(
        'api_user'  => $user,
        'api_key'   => $pass,
        'x-smtpapi' => json_encode($json_string),
        'to'        => $email,
        'subject'   => 'Job complete',
        'html'      => "Your job is complete. Thank you",
        'from'      => 'noreply@uvacabs.company',
    );


    $request =  $url . 'api/mail.send.json';

    // Generate curl request
    $session = curl_init($request);
    // Tell curl to use HTTP POST
    curl_setopt($session, CURLOPT_POST, true);
    // Tell curl that this is the body of the POST
    curl_setopt($session, CURLOPT_POSTFIELDS, $params);
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

function sendemailtocustomer($customerNic,$db){
    $sqlC = "SELECT * FROM customer WHERE customerNic = '$customerNic'";
   $resc= mysqli_fetch_assoc(mysqli_query($db,$sqlC));
   $email = $resc['customerEmail'];
    $url = 'https://api.sendgrid.com/';
    $user = 'vidurarandika96@gmail.com';
    $pass = '20168268werty';

    $json_string = array(

        'to' => array(
            $email,
        ),
        'category' => 'Tour Complete'
    );


    $params = array(
        'api_user'  => $user,
        'api_key'   => $pass,
        'x-smtpapi' => json_encode($json_string),
        'to'        => $email,
        'subject'   => 'Tour complete',
        'html'      => "Your tour is complete.  Thank you",
        'from'      => 'noreply@uvacabs.company',
    );


    $request =  $url . 'api/mail.send.json';

    // Generate curl request
    $session = curl_init($request);
    // Tell curl to use HTTP POST
    curl_setopt($session, CURLOPT_POST, true);
    // Tell curl that this is the body of the POST
    curl_setopt($session, CURLOPT_POSTFIELDS, $params);
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
?>