<?php
$db = mysqli_connect('localhost', 'root', 'root', 'cabservice');

$merchant_id = $_POST['merchant_id'];
$order_id = $_POST['order_id'];
$bookingId = $_POST['order_id'];
$charges = $_POST['payhere_amount'];
$payhere_currency    = $_POST['payhere_currency'];
$status_code = $_POST['status_code'];
$md5sig = $_POST['md5sig'];
$paymentId = $_POST['payment_id'];
$payDate = date("Y-m-d");
$expiryDate = $_POST['card_expiry'];
$nameOnCard = $_POST['card_holder_name'];
$cardNo = $_POST['card_no'];
$custom_1 = $_POST['custom_1'];
$currentPoints = $_POST['custom_2'];
$str_arr = explode ("#", $custom_1);  

$merchant_secret = "4pAuBRcs5Cg4Evedqw80eK48aUtYKw5I18X58xsHTXNa";
$local_md5sig = strtoupper (md5 ( $merchant_id . $order_id . $charges . $payhere_currency . $status_code . strtoupper(md5($merchant_secret)) ) );



if (($local_md5sig === $md5sig) AND ($status_code == 2) ){
   $p = "pending";
   $sql = "INSERT INTO onlinepayment (paymentId, payDate, charges, expiryDate, nameOnCard, paymentType, cardNo, bookingId) VALUES ('$paymentId','$payDate','$charges','$expiryDate','$nameOnCard','$str_arr[6]','$cardNo','$bookingId')";
   $sql2 = "INSERT INTO booking (bookingId, origin, destination, vehicleType, tourTime, tourDate, customerNic, status) VALUES ('$bookingId', '$str_arr[0]','$str_arr[1]','$str_arr[2]','$str_arr[3]','$str_arr[4]','$str_arr[5]','$p')";
   mysqli_query($db,$sql2); 
   mysqli_query($db,$sql); 


   //add points to customer if full payment
$paymentType = $str_arr[6];
if($paymentType == "full"){
   $points = $charges * 0.07;
   if($currentPoints != null || $currentPoints != 0){
      $points = $points + $currentPoints;
      $sqlPoint = "UPDATE customer SET points = '$points' WHERE customerNic = '$str_arr[5]'";
      mysqli_query($db,$sqlPoint);
   }else{
      $sqlPoint = "UPDATE customer SET points = '$points' WHERE customerNic = '$str_arr[5]'";
      mysqli_query($db,$sqlPoint);
   }
}
   //send email to customer
    $customerEmail = $_SESSION['user_data']['customerEmail'];

   
  $url = 'https://api.sendgrid.com/';
  $user = 'vidurarandika96@gmail';
  $pass = '20168268werty';
  
  $json_string = array(
  
    'to' => array(
      $customerEmail,
    ),
    'category' => 'Booking Success'
  );
  
  $id = 2121;
  
  $params = array(
      'api_user'  => $user,
      'api_key'   => $pass,
      'x-smtpapi' => json_encode($json_string),
      'to'        => $customerEmail,
      'subject'   => 'Booking Success',
      'html'      => '<p>Your booking is success.</p><br><p>Booking id : '.$order_id.'</p><br>If you have any problem please <a href="www.uvacabs.company/user/contactus.php">contact us</a><br><p>Thank you!</p>'
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

   //send email to company email for notify about new booking

   $url = 'https://api.sendgrid.com/';
   $user = 'vidurarandika96@gmail.com';
   $pass = '20168268werty';
   
   $json_string = array(
   
     'to' => array(
       'uvacabs0@gmail.com',
     ),
     'category' => 'New Booking'
   );
   
   $id = 2121;
   
   $params = array(
       'api_user'  => $user,
       'api_key'   => $pass,
       'x-smtpapi' => json_encode($json_string),
       'to'        => 'uvacabs0@gmail.com',
       'subject'   => 'Booking Success',
       'html'      => '<p>There is a new booking. Please respond. </p><br><p>Booking id : '.$order_id.'</p>'
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





?>
