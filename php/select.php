<?php 
include '../Cinema-Ticketing/php/connection.php';
$result = $conn->query("SELECT * FROM `overview` WHERE status = 'Now Showing' ");
$result2 = $conn->query("SELECT * FROM `overview` WHERE status = 'Coming Soon' ");

// Cinemas page
$batangasresult = $conn->query("SELECT * FROM `overview` WHERE status = 'Now Showing' ");
$dasmaresult = $conn->query("SELECT * FROM `overview` WHERE status = 'Now Showing' ");
$moaresult = $conn->query("SELECT * FROM `overview` WHERE status = 'Now Showing' ");

// Converting Dictionary Cookie to associative arrays
function convertCookie($cookieName){
    $json = $_COOKIE[$cookieName];
    return json_decode($json,true);
};

//Convert to timeDate
function dateTime($input){
    $timestamp = strtotime($input);
    return date("Y-m-d H:i:s", $timestamp);
}
    
?>