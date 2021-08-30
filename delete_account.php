<?php
session_start();
include("connection.php");
$user_id=$_SESSION['ID'];
$delete_acc="update reg set reg_account_status='Deactive' where reg_id='$user_id'";
$delete_acc1=mysqli_query($conn,$delete_acc);
if($delete_acc1){
    unset($_SESSION['ID']);
    header("location:index.php");
}



  
?>
