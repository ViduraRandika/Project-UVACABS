<?php include('dbconfig.php');
session_start();

$id = $_POST['rc'];
$sql = "SELECT * FROM login WHERE nic='$id'";
$result = mysqli_query($db,$sql);


if(mysqli_num_rows($result)==1){
    $del = "UPDATE login SET user_type = 'removed' WHERE nic = '$id';";
    mysqli_query($db,$del);
   echo 1;
   exit;	
}
else{
   // $_SESSION['notfound']="NIC NOT FOUND";
    echo 0;
    exit;	
}


?>
