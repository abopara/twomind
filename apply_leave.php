<?php
//Include database file for $con
require_once("db.php");

if(!checkLogin() || isAdmin()){
   mysqli_close($con);
   header('Location: index.php');
   exit;
}

$applyError = "";
//Chech If $_PSOT and Form is submint by user
if(isset($_POST['apply']) ){   
   $createError = submitApplyLeave($con);
}

//Closing mysqli connection
mysqli_close($con);
?><html lang="en">
   <head>
      <meta charset="UTF-8">
      <title>Apply Leave</title>
      <link rel="stylesheet" href="styles.css">
   </head>
   <body>
      <div class="wrapper">
         <?php require('sidebar.php'); ?>
      </div>
      <div class="right">
         <?php require('navbar.php'); ?>
         <div class="container create_employee">
            <h1>Apply A Leave</h1>
            <form action="" method="post">
               <table>
                  <tr>
                     <td width="20%">Leave Subject*</td>
                     <td width="80%">
                        <input type="text" name="leave_subject" placeholder="Leave Subject">
                     </td>
                  </tr>
                  <tr>
                     <td>Leave Reason*</td>
                     <td>
                        <textarea rows="5" name="leave_reason" placeholder="Leave Reason"></textarea>
                     </td>
                  <tr>                  
                  <tr>
                  	<td>Leave Date From*</td>
                  	<td>
                     <input type="date" name="leave_date_from" min="<?php echo date("Y-m-d"); ?>" placeholder="" maxlength="10">
                     </td>                               
                  </tr>

                  <tr>
                  	<td>Leave Date To*</td>
                  	<td>
                     <input type="date" name="leave_date_to" min="<?php echo date("Y-m-d"); ?>" placeholder="" maxlength="10">
                     </td>                               
                  </tr>

                  <?php
                  if( isset($applyError) && strlen($applyError) > 0){
                  ?>
                        <tr>
                           
                           <td colspan="2">
                              <div class="error"><?php echo $applyError; ?></div>
                           </td>
                        </tr>
                  <?php
                     }
                  ?>
                  <tr>
                      <td colspan="2" class="apply_leave_note">
                        Note<span class="error">*<span> You cannot change leave data after apply.
                      </td>
                  </tr>
                  <tr>
              			<td colspan="2">
                        	<input type="submit" name="apply" value="Apply Leave">
                     	</td>                  	
                  </tr>                  
                  
               </table>
            </form>
         </div>
      </div>
   </body>
</html>