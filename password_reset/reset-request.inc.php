<?php

include('../php/dbconfig.php');

if ($_POST['reset-request-submit']) {
    
    $userEmail = $_POST['email'];
    echo $userEmail;

    //SEARCH IN CUSTOMER TABLE
    $search1 = mysqli_query($db, "SELECT * FROM customer where customerEmail = '$userEmail' limit 1");
    $res1 = mysqli_fetch_assoc($search1); 
    
    //SEARCH IN DRIVER TABLE
    $search2 = mysqli_query($db, "SELECT * FROM driver where driverEmail = '$userEmail' limit 1");
    $res2 = mysqli_fetch_assoc($search2);

    //SEARCH IN CASHIER TABLE
    $search3 = mysqli_query($db, "SELECT * FROM cashier where cashierEmail = '$userEmail' limit 1");
    $res3 = mysqli_fetch_assoc($search3);

    //SEARCH IN ADMIN TABLE
    $search4 = mysqli_query($db, "SELECT * FROM admin where adminEmail = '$userEmail' limit 1");
    $res4 = mysqli_fetch_assoc($search4);

    if (mysqli_num_rows($search1) == 1 || mysqli_num_rows($search2) == 1 || mysqli_num_rows($search3) == 1 || mysqli_num_rows($search4) == 1 ) {

        $selector = bin2hex(random_bytes(8));
        $token = random_bytes(32);

        $url2 = "http://www.uvacabs.company/password_reset/create-new-password.php?selector=" . $selector . "&validator=" . bin2hex($token);
        $expires = date("U") + 1800;

        /////////IF THERE WAS PREVIOUS TOKEN/////////
        $sql  = "DELETE FROM pwdreset WHERE pwdResetEmail=?";
        $stmt = mysqli_stmt_init($db);

        if (!mysqli_stmt_prepare($stmt, $sql)) {
            echo "There was an error!";
            exit();
        } else {
            mysqli_stmt_bind_param($stmt, "s", $userEmail);
            mysqli_stmt_execute($stmt);
        }

        ////////INSERT VALUES///////
        $sql2 = "INSERT INTO pwdreset (pwdResetEmail, pwdResetSelector, pwdResetToken, pwdResetExpires) VALUES (?,?,?,?);";
        $stmt2 = mysqli_stmt_init($db);
        if (!mysqli_stmt_prepare($stmt2, $sql2)) {
            echo "There was an error!";
            exit();
        } else {
            $hashedToken = password_hash($token, PASSWORD_DEFAULT);
            mysqli_stmt_bind_param($stmt2, "ssss", $userEmail, $selector, $hashedToken, $expires);
            mysqli_stmt_execute($stmt2);
        }

        mysqli_stmt_close($stmt);
        mysqli_stmt_close($stmt2);

        $url = 'https://api.sendgrid.com/';
        $user = 'vidura1996';
        $pass = '20168268werty';

        $json_string = array(

            'to' => array(
                $userEmail,
            ),
            'category' => 'Customer Feedback'
        );

        $id = 2121;
        $msg = "http://www.uvacabs.company?id" + $id;
        $params = array(
            'api_user'  => $user,
            'api_key'   => $pass,
            'x-smtpapi' => json_encode($json_string),
            'to'        => $userEmail,
            'subject'   => 'Reset your password for uvacabs',
            'html'      => '<p>We received apassword reset request.Click below link</p>
                    <a href="' . $url2 . '">' . $url2 . '</a>',
            'from'      => "noreply@uvacabs.company",
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
        header('location: reset-password.php?reset=success');
    } else {
       header('location: reset-password.php?reset=invalid');
    }
} else {
   header('location: reset-password.php?reset=invalid');
}
?>
