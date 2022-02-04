<?php
//Include database file for $con
require_once("db.php");

if(!checkLogin() || !isAdmin()){
   mysqli_close($con);
   header('Location: pending_leaves.php');
   exit;
}

rejectLeave($con, $_GET['id']);

//Closing mysqli connection
mysqli_close($con);
header('Location: pending_leaves.php');
?>