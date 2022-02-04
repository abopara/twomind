<?php
//Include database file for $con
require_once("db.php");

if(!checkLogin() or !isAdmin()){
   mysqli_close($con);
   header('Location: index.php');
   exit;
}
$pending_leaves_list = getPendingLeaves($con);

//Closing mysqli connection
mysqli_close($con);
?><!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8">
      <title>Pending Leaves Listing</title>
      <link rel="stylesheet" href="styles.css">
   </head>
   <body>
      <div class="wrapper">
         <?php require('sidebar.php'); ?>
      </div>
      <div class="right">
         <?php require('navbar.php'); ?>
          <div class="container employee_listing">
              
              <h1>Pending Leaves Lisitng</h1>
               <?php if(count($pending_leaves_list)> 0) { ?>
              <table>
                <tr>
                  <th>Leave ID</th>
                  <th>Leave Subject</th>
                  <th>Leave Reason</th>                  
                  <th>Leave Date From</th>
                  <th>Leave Date To</th>
                  <th>Employee ID</th>                                                    
                  <th>Actions</th>
                </tr>
                <?php 
                  foreach($pending_leaves_list as $leave){                     
                ?>
                  <tr>
                     <td><?= $leave['id'] ?></td>
                     <td><?= $leave['leave_subject'] ?></td>
                     <td><?= substr($leave['leave_reason'], 0 , 10) ."..." ?></td>
                     <td><?= date('d-m-Y', strtotime($leave['leave_date_from']))?></td>
                     <td><?= date('d-m-Y', strtotime($leave['leave_date_to']))?></td>
                     <td><a href="employee_details.php?id=<?= $leave['employee_id'] ?>"><?= $leave['employee_id']?></a></td>                                         
                     <td>
                        <a class="success" href="approve_leave.php?id=<?=$leave['id']?>">Approve</a> / 
                        <a class="error" href="reject_leave.php?id=<?=$leave['id']?>">Rejected</a> / 
                        <a class="warning" href="leave_details.php?id=<?=$leave['id']?>">Details</a>
                     </td>
                  </tr>                
                <?php } ?>
              </table>
              <?php } else{
                 echo "No Pending Leave found.";
              }?>
          </div>
      </div>
   </body>
</html>



