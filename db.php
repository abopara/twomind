<?php

session_start();


// isAPprove values 
// 0 = Pending, 1 = Approved, 2 = Rejected
$con = mysqli_connect("localhost","root","","two_mind_technology");

// Check connection
if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  exit();
}


function checkLogin(){  
  if((isset($_SESSION['id']) && $_SESSION['id'] > 0)) return true;   
  return false;
}

function submitLogin($con){  
  if($_POST['user_id'] != null && $_POST['user_pass'] != null){    
    $user_id = trim($_POST['user_id']);
    $user_pass = trim($_POST['user_pass']);
    $sqlQuery = "Select * from `users` where `id`='".$user_id."' and `password`='".$user_pass."' limit 1";
    $query = mysqli_query($con, $sqlQuery);  
    
    if($query->num_rows <= 0) return "No user found.";    
    $result = mysqli_fetch_assoc($query);
    if(count($result) > 0){      
     
        $_SESSION['id'] = $user_id;
        $_SESSION['user_type'] = trim($result['user_type']);
        $_SESSION['user_name'] = $result['first_name'] . " " . $result['last_name'];
        
        //Closing mysqli connection
        mysqli_close($con);
        header('Location: page.php');
        exit;
      
    }
    return "No user found with this ID";
  }
  return "Please fill the login credentials";
}

function submitCreateEmployee($con){ 
  
  //validating the form data
  if(isset($_POST['firstname']) && strlen($_POST['firstname']) <= 0) return "Firstname is requied!";
  if(isset($_POST['lastname']) && strlen($_POST['lastname'])  <= 0) return "Lastname is requied!";
  if(isset($_POST['password']) && strlen($_POST['password']) <= 0) return "Email is requied!";
  if(isset($_POST['email']) && strlen($_POST['email']) <= 0) return "Email is requied!";
  if(isset($_POST['gender']) && strlen($_POST['gender']) <= 0) return "Gender is requied!";
  if(isset($_POST['mobile']) && strlen($_POST['mobile']) <= 0) return "Mobile is requied!";
  if(isset($_POST['dob']) && strlen($_POST['dob']) <= 0) return "Dob is requied!";
  // end validating the form data
  

  //Getiinng the data from html form
  $firstname = $_POST['firstname'];
  $lastname = $_POST['lastname'];
  $password = $_POST['password'];
  $email = $_POST['email'];
  $gender = $_POST['gender'];
  $mobile = $_POST['mobile'];
  $dob = $_POST['dob'];

  // Checking if email id already exists
  if(checkIfEmailExists($con, $email)){
    return "Email Id already exists.";
  }

  //Insert Employee Query
  $sqlQuery = "Insert into `users` Values(null, '$email', '$password', '$firstname', '$lastname', '$mobile', '$gender', '$dob', 'employee')";
  //Executing the sqlQry
  if (mysqli_query($con, $sqlQuery)){
    //Closing mysqli connection
    mysqli_close($con);
    header('Location: employee_lisitng.php');
  }
}

function checkIfEmailExists($con, $email){
  $sqlQuery = "Select * from `users` where `email`='$email' limit 1";
  $result = mysqli_fetch_assoc( mysqli_query($con, $sqlQuery));
  if(isset($result['id']) && $result['id'] > 0) return true;
  return false;
}

function submitUpdateEmployee($con, $user_id){  
  if(isset($_POST['firstname']) && strlen($_POST['firstname']) <= 0) return "Firstname is requied!";
  if(isset($_POST['lastname']) && strlen($_POST['lastname'])  <= 0) return "Lastname is requied!";
  if(isset($_POST['password']) && strlen($_POST['password']) <= 0) return "Email is requied!";
  if(isset($_POST['email']) && strlen($_POST['email']) <= 0) return "Email is requied!";
  if(isset($_POST['gender']) && strlen($_POST['gender']) <= 0) return "Gender is requied!";
  if(isset($_POST['mobile']) && strlen($_POST['mobile']) <= 0) return "Mobile is requied!";
  if(isset($_POST['dob']) && strlen($_POST['dob']) <= 0) return "Dob is requied!";
  
  $firstname = $_POST['firstname'];
  $lastname = $_POST['lastname'];
  $password = $_POST['password'];
  $email = $_POST['email'];
  $gender = $_POST['gender'];
  $mobile = $_POST['mobile'];
  $dob = $_POST['dob'];
  
  $sqlQuery = "UPDATE `users` SET 
    `email` = '$email', 
    `password`='$password', 
    `first_name`='$firstname', 
    `last_name`='$lastname',
    `mobile`='$mobile',
    `gender`='$gender',
    `dob`='$dob',
    `user_type`='employee' where `id`=$user_id";    
  if (mysqli_query($con, $sqlQuery)){
    //Closing mysqli connection
    mysqli_close($con);
    header('Location: employee_update.php?id='.$user_id);
  }
}



function getEmployeeList($con){
  $sqlQuery = "Select * from `users` where `user_type`='employee'";
  $list = [];
  $result = mysqli_query($con, $sqlQuery);
  while ( $row = mysqli_fetch_array( $result)){    
    $list[] = $row;
  }
  return $list;  
}

function getEmployeeDetails($con, $user_id){
  $sqlQuery = "Select * from `users` where `id`=".$user_id." limit 1";
  return mysqli_fetch_assoc( mysqli_query($con, $sqlQuery));
}

function getLoginName(){
  return $_SESSION['user_name'];
}

function isAdmin(){
  return $_SESSION['user_type'] == "admin";
}

function getPendingLeaves($con){
  $list = [];
  $sqlQuery = "Select * from `employee_leave` where `is_approve`=0";
  $result = mysqli_query($con, $sqlQuery);
  while ( $row = mysqli_fetch_array( $result)){    
    $list[] = $row;
  }
  return $list;
}

function getAppovedLeaves($con){
  $list = [];
  $sqlQuery = "Select * from `employee_leave` where `is_approve`=1";
  $result = mysqli_query($con, $sqlQuery);
  while ( $row = mysqli_fetch_array( $result)){    
    $list[] = $row;
  }
  return $list;
}

function getRejectedLeaves($con){
  $list = [];
  $sqlQuery = "Select * from `employee_leave` where `is_approve`=2";
  $result = mysqli_query($con, $sqlQuery);
  while ( $row = mysqli_fetch_array( $result)){    
    $list[] = $row;
  }
  return $list;
}

function appovedLeave($con, $id){
  $sqlQuery = "UPDATE `employee_leave` SET 
    `is_approve` = 1     
    where `id`=$id";    
  mysqli_query($con, $sqlQuery);
}

function rejectLeave($con, $id){
  $sqlQuery = "UPDATE `employee_leave` SET 
    `is_approve` = 2     
    where `id`=$id";    
  mysqli_query($con, $sqlQuery);
}


function getEmployeeLeaves($con, $employee_id){
  $list = [];
  $sqlQuery = "Select * from `employee_leave` where `employee_id`=".$employee_id." order by id desc";
  $result = mysqli_query($con, $sqlQuery);
  while ( $row = mysqli_fetch_array( $result)){    
    $list[] = $row;
  }
  return $list; 
}

function submitApplyLeave($con){
  if(isset($_POST['leave_subject']) && strlen($_POST['leave_subject']) <= 0) return "Leave Subject is requied!";
  if(isset($_POST['leave_reason']) && strlen($_POST['leave_reason']) <= 0) return "Leave Reason is requied!";
  if(isset($_POST['leave_date_from']) && strlen($_POST['leave_date_from']) <= 0) return "Leave Date From is requied!";
  if(isset($_POST['leave_date_to']) && strlen($_POST['leave_date_to']) <= 0) return "Leave Date To is requied!";
  $leaveSubject = $_POST['leave_subject'];
  $leaveReason = $_POST['leave_reason'];
  $leaveDateFrom = $_POST['leave_date_from'];
  $leaveDateTo = $_POST['leave_date_to'];
  $employeeId = $_SESSION['id'];

  $sqlQuery = "Insert into `employee_leave` Values(null, '$leaveSubject', '$leaveReason', '$leaveDateTo', 0, $employeeId , '$leaveDateFrom')"; 
  if (mysqli_query($con, $sqlQuery)){
    //Closing mysqli connection
    mysqli_close($con);
    header('Location: previous_leaves.php');
  }
}

function getLeaveDetails($con, $user_id){
  $sqlQuery = "Select * from `employee_leave` where `id`=".$user_id." limit 1";
  return mysqli_fetch_assoc( mysqli_query($con, $sqlQuery));
}

?>
