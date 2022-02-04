<?php
    session_start();
    unset($_SESSION['id']);
    unset($_SESSION['user_type']);
    unset($_SESSION['user_name']);
    header('Location: index.php');
    exit;
?>