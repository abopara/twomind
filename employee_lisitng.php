<?php
//Include database file for $con
require_once("db.php");

if(!checkLogin() || !isAdmin()){
   mysqli_close($con);
   header('Location: index.php');
   exit;
}
$employee_list = getEmployeeList($con);

//Closing mysqli connection
mysqli_close($con);
?><!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8">
      <title>Employee Listing</title>
      <link rel="stylesheet" href="styles.css">
   </head>
   <body>
      <div class="wrapper">
         <?php require('sidebar.php'); ?>
      </div>
      <div class="right">
         <?php require('navbar.php'); ?>
          <div class="container employee_listing">
              
              <h1>Employee Lisitng</h1>
               <?php if(count($employee_list)> 0) { ?>
              <table>
                <tr>
                  <th>User ID</th>
                  <th>Email</th>
                  <th>First Name</th>
                  <th>Last Name</th>
                  <th>DOB</th>
                  <th>Mobile Number</th>
                  <th>Gender</th>
                  <th>Actions</th>
                </tr>
                <?php 
                  foreach($employee_list as $emp){                     
                ?>
                  <tr>
                     <td><?= $emp['id'] ?></td>
                     <td><?= $emp['email'] ?></td>
                     <td><?= $emp['first_name'] ?></td>
                     <td><?= $emp['last_name']?></td>
                     <td><?= $emp['dob']?></td>
                     <td><?= $emp['mobile']?></td>
                     <td><?= $emp['gender'] ?></td>
                     <td>
                        <a href="employee_update.php?id=<?=$emp['id']?>">Edit</a> / 
                        <a href="employee_details.php?id=<?=$emp['id']?>">View</a>
                        <!-- <a class="error" href="employee_delete.php?id=<?=$emp['id']?>">Delete</a> -->
                     </td>
                  </tr>                
                <?php } ?>
              </table>
              <?php } else{
                 echo "No Employee found.";
              }?>
          </div>
      </div>
   </body>
</html>



