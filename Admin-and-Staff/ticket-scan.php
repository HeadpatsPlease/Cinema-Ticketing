<?php
  
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
      <h1 class="mb-4 roboto-bold text-light">Please point your ticket here</h1>

      <!-- QR Code Reader -->
      <div id="reader" style="width: 600px; border-radius: 10px"></div>
      <!-- Scan result display -->
      <p class="text-light mt-3">Result: <span id="result"></span></p>
      <input type="hidden" id="refno" name="confirm">
    </div>

    <script src="ticket-scan.js"></script>
  </body>
</html>
