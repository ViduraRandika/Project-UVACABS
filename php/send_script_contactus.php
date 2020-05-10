<?php
$email = $_POST['email'];
$fname = $_POST['fname'];
$lname = $_POST['lname'];
$msg = $_POST['msg'];

$url = 'https://api.sendgrid.com/';
$user = 'vidura1996';
$pass = '20168268werty';

$json_string = array(

  'to' => array(
    'uvacabs0@gmail.com',
  ),
  'category' => 'Customer Feedback'
);

$id = 2121;
$msg = "http://www.uvacabs.company?id"+$id;
$params = array(
    'api_user'  => $user,
    'api_key'   => $pass,
    'x-smtpapi' => json_encode($json_string),
    'to'        => 'vidurarandika96@gmail.com',
    'subject'   => 'Customer Feedback',
    'html'      => '<h3>From: '.$fname.' '.$lname.'</h3>
                    <br>
                    <p><a href =http://www.uvacabs.company/index.php?id='.$id.'rem='.$id.'>LINK</a></p>'
                    ,
    'from'      => "admin@uvacabs.company",
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


?>
