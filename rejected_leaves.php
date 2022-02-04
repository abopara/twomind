<?php
//Include database file for $con
require_once("db.php");

if(!checkLogin() || !isAdmin()){
   mysqli_close($con);
   header('Location: index.php');
   exit;
}
$rejected_leaves_list = getRejectedLeaves($con);

//Closing mysqli connection
mysqli_close($con);
?><!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8">
      <title>Rejected Leaves Listing</title>
      <link rel="stylesheet" href="styles.css">
   </head>
   <body>
      <div class="wrapper">
         <?php require('sidebar.php'); ?>
      </div>
      <div class="right">
         <?php require('navbar.php'); ?>
          <div class="container employee_listing">
              
              <h1>Rejected Leaves Lisitng</h1>
               <?php if( count($rejected_leaves_list)> 0) { ?>
              <table>
                <tr>
                  <th>Leave ID</th>
                  <th>Leave Subject</th>
                  <th>Leave Reason</th>                  
                  <th>Leave Date From</th>
                  <th>Leave Date To</th>
                  <th>Employee ID</th> 
                  <th>Status</th>                                                                      
                </tr>
                <?php 
                  foreach($rejected_leaves_list as $leave){                     
                ?>
                  <tr onclick="window.location='leave_details.php?id=<?= $leave['id']?>'">
                     <td><?= $leave['id'] ?></td>
                     <td><?= $leave['leave_subject'] ?></td>
                     <td><?= substr($leave['leave_reason'], 0 , 10) ."..." ?></td>
                     <td><?= date('d-m-Y', strtotime($leave['leave_date_from']))?></td>
                     <td><?= date('d-m-Y', strtotime($leave['leave_date_to']))?></td>
                     <td><a href="employee_details.php?id=<?= $leave['employee_id'] ?>"><?= $leave['employee_id']?></a></td>
                     <td class="error">Rejected</td>
                  </tr>                
                <?php } ?>
              </table>
              <?php } else{
                 print( "No Rejected Leave found.");
              }?>
          </div>
      </div>
   </body>
</html>



