<?php
//Include database file for $con
require_once("db.php");

if(!checkLogin()){
   mysqli_close($con);
   header('Location: index.php');
   exit;
}

$leave_details;
if(isset($_GET['id'])){
    $leave_details = getLeaveDetails($con, $_GET['id']);
}else{
    mysqli_close($con); 
    header('Location: index.php');
    exit;
}

//Closing mysqli connection
mysqli_close($con);
?><html lang="en">
   <head>
      <meta charset="UTF-8">
      <title>Leave Details</title>
      <link rel="stylesheet" href="styles.css">
   </head>
   <body>
      <div class="wrapper">
         <?php require('sidebar.php'); ?>
      </div>
      <div class="right">
         <?php require('navbar.php'); ?>
         <div class="container create_employee">
            <h1>Leave Details</h1>
            <form action="" method="post">
               <table>
                  <tr>
                     <td width="20%">Leave Subject*</td>
                     <td width="80%">
                        <?= $leave_details['leave_subject']?>
                     </td>
                  </tr>
                  <tr>
                     <td>Leave Reason*</td>
                     <td>
                        <?= $leave_details['leave_reason']?>
                     </td>
                  <tr>                  
                  <tr>
                  	<td>Leave Date From*</td>
                  	<td>
                        <?= date( "Y-m-d", strtotime($leave_details['leave_date_from'])); ?>
                     </td>                               
                  </tr>

                  <tr>
                  	<td>Leave Date To*</td>
                  	<td>
                      <?= date( "Y-m-d", strtotime($leave_details['leave_date_to'])); ?>
                     </td>                               
                  </tr>

                  <tr>
                  	<td>Leave Status</td>
                  	<td>
                      <?= ($leave_details['is_approve'] == 0) ? "Pending": "" ?>
                      <?= ($leave_details['is_approve'] == 1) ? "Approved": "" ?>
                      <?= ($leave_details['is_approve'] == 2) ? "Rejected": "" ?>
                     </td>                               
                  </tr>

                                   
                  
               </table>
            </form>
         </div>
      </div>
   </body>
</html>