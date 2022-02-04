<?php
//Include database file for $con
require_once("db.php");


if(!checkLogin() || !isAdmin()){
    mysqli_close($con);
    header('Location: index.php');
    exit;
 }

$employee_details;
if(isset($_GET['id'])){
    $employee_details = getEmployeeDetails($con, $_GET['id']);
}else{
    mysqli_close($con); 
   header('Location: employee_lisitng.php');
   exit;
}

//Closing mysqli connection
mysqli_close($con);
?><html lang="en">
   <head>
      <meta charset="UTF-8">
      <title>Employee Details</title>
      <link rel="stylesheet" href="styles.css">
   </head>
   <body>
      <div class="wrapper" >
         <?php require('sidebar.php'); ?>
      </div>
      <div class="right">
         <?php require('navbar.php'); ?>
         <div class="container create_employee">
            <h1>Employee Details</h1>
            <form action="" method="post">
               <table>
                  <tr>
                     <td width="20%">First Name*</td>
                     <td width="80%">
                        <?= $employee_details['first_name'] ?>
                     </td>
                  </tr>
                  <tr>
                     <td>Last Name*</td>
                     <td>
                        <?= $employee_details['last_name'] ?>
                     </td>
                  
                  </tr>
                  
                  <tr>
                     <td>Email*</td>
                     <td>
                        <?= $employee_details['email'] ?>
                     </td>
                  </tr>
                  <tr>
                     <td>Gender*</td>
                     <td>                         
                        <?= ($employee_details['gender'] == 'male'? 'Male': 'Female')?>
                                                
                     </td>
                  </tr>                  
                  <tr>
                  	<td>Phone*</td>
                  	<td>
                     <?= $employee_details['mobile'] ?>
                     </td>                               
                  </tr>

                  <tr>
                  	<td>DOB*</td>
                  	<td>
                     <?= date('Y-m-d', strtotime($employee_details['dob'])) ?>
                     </td>                               
                  </tr>
                                    
               </table>
            </form>
         </div>
      </div>
   </body>
</html>