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
$str_arr = explode (",", $custom_1);  

$merchant_secret = "4pAuBRcs5Cg4Evedqw80eK48aUtYKw5I18X58xsHTXNa";
$local_md5sig = strtoupper (md5 ( $merchant_id . $order_id . $charges . $payhere_currency . $status_code . strtoupper(md5($merchant_secret)) ) );



if (($local_md5sig === $md5sig) AND ($status_code == 2) ){
   $p = "pending";
   $sql = "INSERT INTO onlinepayment (paymentId, payDate, charges, expiryDate, nameOnCard, paymentType, cardNo, bookingId) VALUES ('$paymentId','$payDate','$charges','$expiryDate','$nameOnCard','$str_arr[6]','$cardNo','$bookingId')";
   $sql2 = "INSERT INTO booking (bookingId, origin, destination, vehicleType, tourTime, tourDate, customerNic, status) VALUES ('$bookingId', '$str_arr[0]','$str_arr[1]','$str_arr[2]','$str_arr[3]','$str_arr[4]','$str_arr[5]','$p')";
   mysqli_query($db,$sql2); 
   mysqli_query($db,$sql); 

   //send email to customer
    
   sendemailtocustomer();

   //send email to company email for notify about new booking

   sendemailtocompany();
   
   
}



function sendemailtocompany(){


}

?>
