<?php include('dbconfig.php');
session_start();
if(isset($_GET['au'])){
$id = $_GET['au'];
$sql = "SELECT * FROM login WHERE nic='$id'";

$result = mysqli_query($db,$sql);


if(mysqli_num_rows($result)==1){
    $del = "UPDATE login SET user_type = 'user' WHERE nic = '$id';";
    mysqli_query($db,$del);
    header('location: ../view.php');	
}
else{
    $_SESSION['notfound']="NIC NOT FOUND";
    header('location: ../view.php');	
}
}

if(isset($_GET['ad'])){
    $id = $_GET['ad'];
    $sql = "SELECT * FROM login WHERE nic='$id'";
    $result = mysqli_query($db,$sql);
    
    
    if(mysqli_num_rows($result)==1){
        $del = "UPDATE login SET user_type = 'driver' WHERE nic = '$id';";
        mysqli_query($db,$del);
        header('location: ../view.php');	
    }
    else{
        $_SESSION['notfound']="NIC NOT FOUND";
        header('location: ../view.php');	
    }
}


?>
