<?php
if (!isset($_SESSION)) {
    session_start();
}

if (!isset($_SESSION['role'])) {
    header('location: ./login.php');
}

// SET TIMEOUT SESSION
if (strtotime("now") >= $_SESSION['expired_time']) {
    session_destroy();
    header("Location: ./login.php");
}
