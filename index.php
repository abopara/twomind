<?php
//Include database file for $con
require_once("db.php");
$loginError = "";
//Chech If $_PSOT and Form is submint by user
if(isset($_POST['user_id']) ){
   $loginError = submitLogin($con);
}

if(checkLogin()){
   mysqli_close($con);
   header('Location: page.php');
   exit;
}

//Closing mysqli connection
mysqli_close($con);
?><!DOCTYPE html>
<!DOCTYPE html>
<html>
   <head>
      <link rel="stylesheet" type="text/css" href="styles.css">
      <title>LOGIN</title>
      <head>
   <body class="login-page">
      <div class="login-form">
         <h1>TWO MIND TECHNOLOGY</h1>
         <div class="divider"></div>
         <form action="" method="post">
            <table width="100%">
               <?php
                  if( isset($loginError) && strlen($loginError) > 0){
               ?>
                     <tr>
                        
                        <td colspan="2">
                           <div class="error"><?php echo $loginError; ?></div>
                        </td>
                     </tr>
               <?php
                  }
               ?>
               <tr>
                  <td width="20%">ID:</td>
                  <td width="80%">
                     <input type="text" name="user_id">
                  </td>
               </tr>
               <tr>
                  <td>Password: </td>
                  <td>
                     <input type="password" name="user_pass">
                  </td>
               </tr>
               <tr>
                  <td colspan="2">
                     <input type="submit" name="submit" 
                        value="Login">
                  </td>
               </tr>
              <!--  <tr>
                  <td colspan="2">
                     <a href="submit" class="forgot-password">Forget Passoword</a>
                  </td>
               </tr> -->
            </table>
         </form>
      </div>
   </body>
</html>