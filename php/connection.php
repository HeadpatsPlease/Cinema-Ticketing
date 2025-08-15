<?php
    $db_server="localhost";
    $db_user="root";
    $db_pass="";
    $db_name="cinema_ticketing_db";
    $db_admin="admin_cinema_ticketing_db";
    $db_admin="admin_cinema_ticketing_db";
    $db_cash="lovecash";
    $conn = "";
    $admin = "";


    try{
        $conn = mysqli_connect($db_server,$db_user,$db_pass,$db_name);
        $admin = mysqli_connect($db_server,$db_user,$db_pass,$db_admin);
        $cash = mysqli_connect($db_server,$db_user,$db_pass,$db_cash);
    }catch(mysqli_sql_exception){
        echo "could not connect";
    }
?>