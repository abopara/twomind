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


$createError = "";
//Chech If $_PSOT and Form is submint by user
if(isset($_POST['Update']) ){   
   $createError = submitUpdateEmployee($con, $_GET['id']);
}

//Closing mysqli connection
mysqli_close($con);
?><html lang="en">
   <head>
      <meta charset="UTF-8">
      <title>Update Employee</title>
      <link rel="stylesheet" href="styles.css">
   </head>
   <body>
      <div class="wrapper">
         <?php require('sidebar.php'); ?>
      </div>
      <div class="right">
         <?php require('navbar.php'); ?>
         <div class="container create_employee">
            <h1>Update A Employee</h1>
            <form action="" method="post">
               <table>
                  <tr>
                     <td width="20%">First Name*</td>
                     <td width="80%">
                        <input type="text" name="firstname" value="<?= $employee_details['first_name'] ?>" placeholder="Enter First Name Here">
                     </td>
                  </tr>
                  <tr>
                     <td>Last Name*</td>
                     <td>
                        <input type="text" name="lastname" value="<?= $employee_details['last_name'] ?>" placeholder="Enter Last Name Here">
                     </td>
                  <tr>
                  </tr>
                  <td>Password*</td>
                  <td>
                     <input type="text" name="password" value="<?= $employee_details['password'] ?>" placeholder="Enter Password Here">
                  </td>
                  </tr>
                  <tr>
                     <td>Email*</td>
                     <td>
                        <input type="email" name="email" value="<?= $employee_details['email'] ?>" placeholder="Enter Email Here">
                     </td>
                  </tr>
                  <tr>
                     <td>Gender*</td>
                     <td>                         
                        <input type="radio" name="gender" value="male" <?= ($employee_details['gender'] == 'male'? 'checked': '')?>>Male
                        <input type="radio" name="gender" value="female" <?= ($employee_details['gender'] == 'female'? 'checked': '')?>>Female                        
                     </td>
                  </tr>                  
                  <tr>
                  	<td>Phone*</td>
                  	<td>
                     <input type="phone" name="mobile" value="<?= $employee_details['mobile'] ?>" placeholder="123******" maxlength="10">
                     </td>                               
                  </tr>

                  <tr>
                  	<td>DOB*</td>
                  	<td>
                     <input type="date" name="dob" value="<?= date('Y-m-d', strtotime($employee_details['dob'])) ?>" maxlength="10">
                     </td>                               
                  </tr>

                  <?php
                  if( isset($createError) && strlen($createError) > 0){
                  ?>
                        <tr>
                           
                           <td colspan="2">
                              <div class="error"><?php echo $createError; ?></div>
                           </td>
                        </tr>
                  <?php
                     }
                  ?>

                  <tr>
              			<td colspan="2">
                        	<input type="submit" name="Update" value="Update">
                     	</td>                  	
                  </tr>
                  
               </table>
            </form>
         </div>
      </div>
   </body>
</html>