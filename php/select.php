<?php 
include '../Cinema-Ticketing/php/connection.php';
$result = $conn->query("SELECT * FROM `overview` WHERE status = 'Now Showing' ");
$result2 = $conn->query("SELECT * FROM `overview` WHERE status = 'Coming Soon' ");

// Cinemas page
$batangasresult = $conn->query("SELECT * FROM `overview` WHERE status = 'Now Showing' ");
$dasmaresult = $conn->query("SELECT * FROM `overview` WHERE status = 'Now Showing' ");
$moaresult = $conn->query("SELECT * FROM `overview` WHERE status = 'Now Showing' ");


?>