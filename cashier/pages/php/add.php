<?php include('dbconfig.php');
//session_start();
if(isset($_POST['au'])){
$id = $_POST['au'];
$sql = "SELECT * FROM login WHERE nic='$id'";

$result = mysqli_query($db,$sql);


if(mysqli_num_rows($result)==1){
    $del = "UPDATE login SET user_type = 'user' WHERE nic = '$id';";
    mysqli_query($db,$del);
    echo 1;
    exit;	
}
else{
    echo 0;
    exit;
}
}

if(isset($_POST['ad'])){
    $id = $_POST['ad'];
    $sql = "SELECT * FROM login WHERE nic='$id'";
    $result = mysqli_query($db,$sql);
    
    
    if(mysqli_num_rows($result)==1){
        $del = "UPDATE login SET user_type = 'driver' WHERE nic = '$id';";
        mysqli_query($db,$del);
        echo 1;
        exit;	
    }
    else{
        echo 0;
        exit;
    }
}


?>
