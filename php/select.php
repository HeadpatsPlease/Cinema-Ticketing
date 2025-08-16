<?php 
include '../Cinema-Ticketing/php/connection.php';
$result = $conn->query("SELECT * FROM `overview` WHERE status = 'Now Showing' ");
$result2 = $conn->query("SELECT * FROM `overview` WHERE status = 'Coming Soon' ");
$result3 = $conn->query("SELECT * FROM `overview`");

// Cinemas page
$batangasresult = $conn->query("SELECT * FROM `overview` WHERE status = 'Now Showing' ");
$dasmaresult = $conn->query("SELECT * FROM `overview` WHERE status = 'Now Showing' ");
$moaresult = $conn->query("SELECT * FROM `overview` WHERE status = 'Now Showing' ");

//admin
$genre = $conn->query("SELECT * FROM `genre`");
$rating = $conn->query("SELECT * FROM `rating`");
$status = $conn->query("SELECT * FROM `statusmovie`");
$time = $conn->query("SELECT * FROM `availabletime`");
$quality = $conn->query("SELECT * FROM `availability`");
$cinema = $conn->query("SELECT * FROM `cinemas`");
$director = $conn->query("SELECT * FROM `director`");
$location = $conn->query("SELECT * FROM `locations`");


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