<?php
//Include database file for $con
require_once("db.php");

if(!checkLogin()){
   mysqli_close($con);
   header('Location: index.php');
   exit;
}

//Closing mysqli connection
mysqli_close($con);
?><!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8">
      <title>Dashboard</title>
      <link rel="stylesheet" href="styles.css">
   </head>
   <body>
      <div class="wrapper">
         <?php require('sidebar.php'); ?>
      </div>
      <div class="right">
          <?php require('navbar.php'); ?>
          <div class="container">
              <h1>Welcome to Two Mind Technology</h1>
          </div>
      </div>
   </body>
</html>