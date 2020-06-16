<?php
include('dbconfig.php');
if (isset($_POST['createVehicle'])) {
    session_start();
    $vehNo = $_POST['vehNo'];
    $vehType = $_POST['vehType'];

    $sql_u = "SELECT * FROM vehicle WHERE vehicleNo='$vehNo' ";

    $res_u = mysqli_query($db, $sql_u);
    if (mysqli_num_rows($res_u) >0) {
		$_SESSION['error']= "code1";
        header('location: ../createveh.php');

	}else{
                $query1 = "INSERT INTO vehicle (vehicleNo,vehicleType) VALUES('$vehNo','$vehType')";
                if(mysqli_query($db,$query1)){
                        $_SESSION['vehadded'] = "success";
                        header('location: ../createveh.php');
                } else{
                        echo "ERROR IN QUERY 1";
                } 
        }

}else{
        header('location: ../../index.php');
}
?>