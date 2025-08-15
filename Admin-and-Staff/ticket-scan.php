<?php
  include '../php/connection.php';
  $status = false;
  $msg = '';
  if(isset($_GET['code'])){
    $refno = $_GET['code'];
    $compare = $admin->query("SELECT * FROM `tickets` WHERE reference_number = '$refno' AND status = 1");
    if($compare && $compare->num_rows > 0){
      $checked = $admin->query("UPDATE `tickets` SET `status`= 2 WHERE reference_number = '$refno'");
      $msg = "Ticket confirmed";
      $status = true;
    }else{
      $status = false;
      $msg = "This ticket does not Exist";
    }
  }
  if(isset($_POST['back'])){
    $status = false;
    header("Location: " .strtok($_SERVER['REQUEST_URI'], '?'));
  }
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../css/bootstrap.min.css" />
    <script src="../cinema_pages/js/libs/html5-qrcode.min.js"></script>
    <title>TicketScan</title>
    <style>
      h1 {
        font-size: 4rem;
        font-weight: bold;
      }

      #reader {
        width: 600px;
        border-radius: 10px;
        border: 10px dashed #ffc100;
      }
    </style>
  </head>

  <body class="bg-dark">
    <div
      class="container d-flex flex-column justify-content-center align-items-center"
      style="height: 100vh"
    >
      

      <?php 
        if($status){
          echo '<img src="../images/checked.png" class=" w-25" alt="correct">
              <h1 class="text-light">Ticket Confirmed</h1>
              <h3 class="text-light">You may Proceed to your Cinema Room</h3>
              <form action="ticket-scan.php" method="post">
                <button class="btn btn-success" type="submit" name="back">Go back</button>
              </form>';
        }else{
          echo '<h1 class="mb-4 roboto-bold text-light">Please point your ticket here</h1>
                <!-- QR Code Reader -->
                <div id="reader" style="width: 600px; border-radius: 10px"></div>
                <!-- Scan result display -->
                <h3 class="text-light mt-3">'. $msg.'<span id="result"></span></h3>
                <input type="hidden" id="refno" name="confirm">';
        }
      ?>
    </div>

    <script src="ticket-scan.js"></script>
  </body>
</html>
