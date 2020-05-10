<?php
include('../php/dbconfig.php');
if(isset($_POST['reset-password-submit'])){
    $selector = $_POST['selector'];
    $validator = $_POST['validator'];
    $password = $_POST['pwd'];
    $passwordRepeat = $_POST['pwd-repeat'];

    if(empty($password)||empty($passwordRepeat)){
        header('location: create-new-password.php?newpwd=empty');
        exit();
    }elseif($password != $passwordRepeat){
        header('location: create-new-password.php?newpwd=pwdnotsame'); 
        exit();
    }else{
        $currentDate = date("U");
        $sql = "SELECT * FROM pwdreset WHERE pwdResetSelector=? AND pwdResetExpires>=?;";
        $stmt = mysqli_stmt_init($db);

        if (!mysqli_stmt_prepare($stmt, $sql)) {
            echo "There was an error!";
            exit();
        } else {
            mysqli_stmt_bind_param($stmt, "ss", $selector,$currentDate);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            if(!$row = mysqli_fetch_assoc($result)){
                echo "You need to resubmit your reset request";
                exit();
            }else{
               // $row = mysqli_fetch_assoc($result);
                $tokenBin = hex2bin($validator);
                $tokenCheck = password_verify($tokenBin,$row['pwdResetToken']);

                if($tokenCheck === false){
                    echo "You need to resubmit your reset request";
                    exit();
                }elseif($tokenCheck === true){
                    $tokenEmail = $row['pwdResetEmail'];

                    //SEARCH IN CUSTOMER
                    $sql2 = "SELECT * FROM customer WHERE customerEmail =?;";

                    //SEARCH IN DRIVER 
                    $search1 = "SELECT * FROM driver WHERE driverEmail=?;";

                    //SEARCH IN CASHIER
                    $search2 = "SELECT * FROM cashier WHERE cashierEmail=?;";

                    //SEARCH IN ADMIN
                    $search3 = "SELECT * FROM admin WHERE adminEmail=?;";

                    $stmt2 = mysqli_stmt_init($db);
                    
                    if(mysqli_stmt_prepare($stmt2,$sql2)){
                        mysqli_stmt_prepare($stmt2,$sql2);
                        mysqli_stmt_bind_param($stmt2,"s",$tokenEmail);
                        mysqli_stmt_execute($stmt2);
                        $result2 = mysqli_stmt_get_result($stmt2);
                        if(!$row2 = mysqli_fetch_assoc($result2)){
                            if(mysqli_stmt_prepare($stmt2,$search1)){
                                mysqli_stmt_prepare($stmt2,$search1);
                                mysqli_stmt_bind_param($stmt2,"s",$tokenEmail);
                                mysqli_stmt_execute($stmt2);
                                $result2 = mysqli_stmt_get_result($stmt2);
                                if(!$row2 = mysqli_fetch_assoc($result2)){
                                    if(mysqli_stmt_prepare($stmt2,$search2)){
                                        mysqli_stmt_prepare($stmt2,$search2);
                                        mysqli_stmt_bind_param($stmt2,"s",$tokenEmail);
                                        mysqli_stmt_execute($stmt2);
                                        $result2 = mysqli_stmt_get_result($stmt2);
                                        if(!$row2 = mysqli_fetch_assoc($result2)){
                                            if(mysqli_stmt_prepare($stmt2,$search3)){
                                                mysqli_stmt_prepare($stmt2,$search3);
                                                mysqli_stmt_bind_param($stmt2,"s",$tokenEmail);
                                                mysqli_stmt_execute($stmt2);
                                                $result2 = mysqli_stmt_get_result($stmt2);
                                                if(!$row2 = mysqli_fetch_assoc($result2)){
                                                    echo "You need to resubmit your reset request SEC4";
                                                    exit();
                                                }else{
                                                   // $row2 = mysqli_fetch_assoc($result2);
                                                    $customerNic = $row2['adminNic'];
                                                    $sql3 = "UPDATE login SET password=? WHERE nic=?";
                                                    $stmt3 = mysqli_stmt_init($db);
                                                    if(!mysqli_stmt_prepare($stmt3,$sql3)){
                                                        echo "There was an error";
                                                        exit();
                                                    }else{
                                                        mysqli_stmt_bind_param($stmt3,"ss",md5($password),$customerNic);
                                                        mysqli_stmt_execute($stmt3);
                        
                                                        $sql4 = "DELETE FROM pwdreset WHERE pwdResetEmail=?";
                                                        $stmt4 = mysqli_stmt_init($db);
                                                        if(!mysqli_stmt_prepare($stmt4,$sql4)){
                                                            echo "There was an error";
                                                            exit();
                                                        }else{
                                                            mysqli_stmt_bind_param($stmt4,"s",$tokenEmail);
                                                            mysqli_stmt_execute($stmt4);
                                                            header('location: ../user/login.php?newpwd=updated');
                                                        }
                        
                                                    }
                                                }
                                                
                                            }
                                        }else{
                                           // $row2 = mysqli_fetch_assoc($result2);
                                            $customerNic = $row2['cashierNic'];
                                            $sql3 = "UPDATE login SET password=? WHERE nic=?";
                                            $stmt3 = mysqli_stmt_init($db);
                                            if(!mysqli_stmt_prepare($stmt3,$sql3)){
                                                echo "There was an error";
                                                exit();
                                            }else{
                                                mysqli_stmt_bind_param($stmt3,"ss",md5($password),$customerNic);
                                                mysqli_stmt_execute($stmt3);
                
                                                $sql4 = "DELETE FROM pwdreset WHERE pwdResetEmail=?";
                                                $stmt4 = mysqli_stmt_init($db);
                                                if(!mysqli_stmt_prepare($stmt4,$sql4)){
                                                    echo "There was an error";
                                                    exit();
                                                }else{
                                                    mysqli_stmt_bind_param($stmt4,"s",$tokenEmail);
                                                    mysqli_stmt_execute($stmt4);
                                                    header('location: ../user/login.php?newpwd=updated');
                                                }
                
                                            }
                                        }
                                        
                                    }
                                }else{
                                   // $row2 = mysqli_fetch_assoc($result2);
                                    $customerNic = $row2['driverNic'];
                                    $sql3 = "UPDATE login SET password=? WHERE nic=?";
                                    $stmt3 = mysqli_stmt_init($db);
                                    if(!mysqli_stmt_prepare($stmt3,$sql3)){
                                        echo "There was an error";
                                        exit();
                                    }else{
                                        mysqli_stmt_bind_param($stmt3,"ss",md5($password),$customerNic);
                                        mysqli_stmt_execute($stmt3);
        
                                        $sql4 = "DELETE FROM pwdreset WHERE pwdResetEmail=?";
                                        $stmt4 = mysqli_stmt_init($db);
                                        if(!mysqli_stmt_prepare($stmt4,$sql4)){
                                            echo "There was an error";
                                            exit();
                                        }else{
                                            mysqli_stmt_bind_param($stmt4,"s",$tokenEmail);
                                            mysqli_stmt_execute($stmt4);
                                            header('location: ../user/login.php?newpwd=updated');
                                        }
        
                                    }
                                }
                                
                            }
                        }else{
                           // $row2 = mysqli_fetch_assoc($result2);
                            $customerNic = $row2['customerNic'];
                            $sql3 = "UPDATE login SET password=? WHERE nic=?";
                            $stmt3 = mysqli_stmt_init($db);
                            if(!mysqli_stmt_prepare($stmt3,$sql3)){
                                echo "There was an error";
                                exit();
                            }else{
                                mysqli_stmt_bind_param($stmt3,"ss",md5($password),$customerNic);
                                mysqli_stmt_execute($stmt3);

                                $sql4 = "DELETE FROM pwdreset WHERE pwdResetEmail=?";
                                $stmt4 = mysqli_stmt_init($db);
                                if(!mysqli_stmt_prepare($stmt4,$sql4)){
                                    echo "There was an error";
                                    exit();
                                }else{
                                    mysqli_stmt_bind_param($stmt4,"s",$tokenEmail);
                                    mysqli_stmt_execute($stmt4);
                                    header('location: ../user/login.php?newpwd=updated');
                                }

                            }
                        }
                    }else{
                        echo "There was an error";
                        exit();
                    }
                }
            }
        }
    }

}else{
    header('location: ../index.php');
}


?>