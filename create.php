<?php
//Include database file for $con
require_once("db.php");

if(!checkLogin() || !isAdmin()){
   mysqli_close($con);
   header('Location: index.php');
   exit;
}

$createError = "";
//Chech If $_PSOT and Form is submint by user
if(isset($_POST['Create']) ){   
   $createError = submitCreateEmployee($con);
}

//Closing mysqli connection
mysqli_close($con);
?><html lang="en">
   <head>
      <meta charset="UTF-8">
      <title>Create Employee</title>
      <link rel="stylesheet" href="styles.css">
   </head>
   <body>
      <div class="wrapper">
         <?php require('sidebar.php'); ?>
      </div>
      <div class="right">
         <?php require('navbar.php'); ?>
         <div class="container create_employee">
            <h1>Create A Employee</h1>
            <form action="" method="post">
               <table>
                  <tr>
                     <td width="20%">First Name*</td>
                     <td width="80%">
                        <input type="text" name="firstname" placeholder="Enter First Name Here">
                     </td>
                  </tr>
                  <tr>
                     <td>Last Name*</td>
                     <td>
                        <input type="text" name="lastname" placeholder="Enter Last Name Here">
                     </td>
                  <tr>
                  </tr>
                  <td>Password*</td>
                  <td>
                     <input type="text" name="password" placeholder="Enter Password Here">
                  </td>
                  </tr>
                  <tr>
                     <td>Email*</td>
                     <td>
                        <input type="email" name="email" placeholder="Enter Email Here">
                     </td>
                  </tr>
                  <tr>
                     <td>Gender*</td>
                     <td>
                        <input type="radio" name="gender" value="male">Male
                        <input type="radio" name="gender" value="female">Female                        
                     </td>
                  </tr>                  
                  <tr>
                  	<td>Phone*</td>
                  	<td>
                     <input type="phone" name="mobile" placeholder="123******" maxlength="10">
                     </td>                               
                  </tr>

                  <tr>
                  	<td>DOB*</td>
                  	<td>
                     <input type="date" name="dob" placeholder="" maxlength="10">
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
                        	<input type="submit" name="Create" value="Create">
                     	</td>                  	
                  </tr>
                  
               </table>
            </form>
         </div>
      </div>
   </body>
</html>