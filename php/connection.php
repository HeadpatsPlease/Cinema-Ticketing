<?php
    $db_server="localhost";
    $db_user="root";
    $db_pass="";
    $db_name="cinema_ticketing_db"; // main
    $db_admin="admin_cinema_ticketing_db"; // admin
    $db_cash="lovecash"; //payment vrification
    $conn = "";
    $admin = "";


    try{
        $conn = mysqli_connect($db_server,$db_user,$db_pass,$db_name); //main
        $admin = mysqli_connect($db_server,$db_user,$db_pass,$db_admin); //admin
        $cash = mysqli_connect($db_server,$db_user,$db_pass,$db_cash); //payment verification
    }catch(mysqli_sql_exception){
        echo "could not connect";
    }
?>