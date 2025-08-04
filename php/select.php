<?php 
include '../Cinema-Ticketing/php/connection.php';
$result = $conn->query("SELECT * FROM `overview` WHERE status = 'Now Showing' ");
$result2 = $conn->query("SELECT * FROM `overview` WHERE status = 'Coming Soon' ");
?>