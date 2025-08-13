<?php
    $db_server="localhost";
    $db_user="root";
    $db_pass="";
    $db_admin="admin_cinema_ticketing_db";
    $conn = "";
    $admin = "";


    try{
        header('Content-Type: application/json');
        $adminAJAX = mysqli_connect($db_server,$db_user,$db_pass,$db_admin);
    }catch(mysqli_sql_exception){
        echo "could not connect";
    }
    $data = convertCookie("movieDetails");
    $date = $data['selectedDate'] . " " . $data['selectedTime'];
    $dateTime = dateTime($date);
    $movieName = $data['movieTitle'];

      $ajax = $adminAJAX->query("SELECT `seat_num` FROM `reservedseats` WHERE movie_name = '$movieName' AND schedule = '$dateTime'");
  $reservedSeats = $ajax->fetch_all(MYSQLI_ASSOC);
?>