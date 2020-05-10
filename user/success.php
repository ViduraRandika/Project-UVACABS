<?php
if(isset($_GET['bs'])){
    $bs = $_GET['bs'];
    if($bs=="success"){
        $_SESSION['bookingSuccess']="success";
        header('location: ../index.php');
    }
    if($bs=="unsuccess"){
        $_SESSION['bookingUnsuccess']="unsuccess";
        header('location: ../index.php');
    }
}
?>