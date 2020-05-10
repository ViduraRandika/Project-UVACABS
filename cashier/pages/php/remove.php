<?php include('dbconfig.php');
session_start();
$id = $_GET['rc'];
$sql = "SELECT * FROM login WHERE nic='$id'";
$result = mysqli_query($db,$sql);


if(mysqli_num_rows($result)==1){
    $del = "UPDATE login SET user_type = 'removed' WHERE nic = '$id';";
    mysqli_query($db,$del);
    header('location: ../view.php');	
}
else{
    $_SESSION['notfound']="NIC NOT FOUND";
    header('location: ../view.php');	
}
if(isset($_GET['rembooking'])){
    $rbid = $_GET['rembooking'];
    $sql2 = mysqli_query($db,"UPDATE booking set status = 'cancelled' where bookingId = '$rbid' ");

}

?>
