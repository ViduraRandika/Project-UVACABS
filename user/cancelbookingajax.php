<?php
include "../php/dbconfig.php";

if (isset($_POST['id'])) {
    $id =  $_POST['id'];

    $sql = "UPDATE booking SET status = 'cancelled' WHERE bookingId='$id'";
    mysqli_query($db, $sql);
    echo 1;
    exit;
}

echo 0;
exit;
