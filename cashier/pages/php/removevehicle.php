<?php include('dbconfig.php');
session_start();
$id = $_POST['rv'];
$sql = "SELECT * FROM vehicle WHERE vehicleNo='$id'";
$result = mysqli_query($db,$sql);


if(mysqli_num_rows($result)==1){
    $del = "DELETE FROM VEHICLE WHERE vehicleNo = '$id'";
    mysqli_query($db,$del);
    echo 1;
    exit;	
}

    echo 0;
    exit;


?>
