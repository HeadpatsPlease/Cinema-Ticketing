<?php
  $header = include '../../Cinema-Ticketing/php/Header.php';
  include '../../Cinema-Ticketing/php/connection.php';
  @include '../../Cinema-Ticketing/php/select.php';

  $data = convertCookie("movieDetails");
  $seatTaken = $data["seatsTaken"];
  

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Pop Cinema - Beverages</title>
  <link rel="stylesheet" href="../css/bootstrap.min.css"/>
  <link rel="stylesheet" href="css/beverage.css">
  <script src="js/cookieReader.js"></script>
</head>
<body>
<div class="container-fluid">
  <div class="row">
    <div class="col-lg-8 mt-5">
      <h2 class="section-title">SELECT BEVERAGES</h2>
      <div id="beverage-list" class="row row-cols-1 row-cols-sm-4 row-cols-md-4 row-cols-lg-4 g-2"></div>
      <p class="mt-4 float-start">*Always check your order summary before proceeding to payment. You may proceed if you do not need any beverages.</p>
      <button class="btn btn-warning mt-3 float-end" id="nextBtn">Next</button>
    </div>
    <div class="col-lg-4">
      <div class="basket">
        <h5 style="font-style: oblique; font-family: 'Courier New', Courier, monospace; font-size: 2rem;">YOUR BASKET</h5>
        <p class=" text-break" id="movieTicketInfo"><?php echo $data["movieTitle"] . " - ". $data["selectedQuality"]; ?>  *<span id="qty"><?php echo intval($data["ticketQuantity"]) ?>  </span> - <span> <?php echo intval($data["ticketTotal"])  ?></span></p>
        <p>Seats: <?php foreach($seatTaken as $seats){ echo $seats . " ";} ?></p>
        <hr>
        <ul id="basket-items" class="text-white"></ul>  
        <hr>
        <div class="total">TOTAL COST: <span id="total-cost"><?php $data["ticketTotal"] ?></span></div>
      </div>
    </div>
  </div>
</div>

<script src="js/beverage.js">

</script>
</body>
</html>
