<?php
    require_once("db.php");
?>
<div class="sidebar">
    <img src="logo.png" width="175"/>
    <ul>
        <li><a href="page.php"><i class="fas fa-home"></i>Home</a></li>

        <?php if(isAdmin()){ ?>
             <!-- Admin menu   -->
            <li><a href="employee_lisitng.php"><i class="fas fa-user"></i>List Employees</a></li>
            <li><a href="create.php"><i class="fas fa-user"></i>Create Employee</a></li>
            <li><a href="pending_leaves.php"><i class="fas fa-project-diagram"></i>Pending Leave</a></li>
            <li><a href="approved_leaves.php"><i class="fas fa-project-diagram"></i>Approved Leave</a></li>
            <li><a href="rejected_leaves.php"><i class="fas fa-project-diagram"></i>Rejected Leave</a></li>
        <?php  }else { ?>
             <!-- Employee menu   -->
            <li><a href="apply_leave.php"><i class="fas fa-project-diagram"></i>Apply Leave</a></li>
            <li><a href="previous_leaves.php"><i class="fas fa-project-diagram"></i>Previous Leave</a></li>
        <?php } ?>          
        
        <li><a href="logout.php"><i class="fas fa-address-book"></i>Logout</a></li>
    </ul>
</div>