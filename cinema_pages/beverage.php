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
  <link rel="stylesheet" href="../Cinema-Ticketing/fonts/font-style.css">
  <script src="js/cookieReader.js"></script>
</head>
<body>
    <section class="d-flex justify-content-center mt-3">
      <ul class="list-group list-group-horizontal-sm">
        <li class="list-group-item">
          <h1 class="display-6 archerpro">1. Select Tickets</h1>
        </li>
        <li class="list-group-item">
          <h1 class="display-6 archerpro">2. Select Seats</h1>
        </li>
        <li class="list-group-item active-item">
          <h1 class="display-6 archerpro">3. Beverages</h1>
        </li>
        <li class="list-group-item">
          <h1 class="display-6 archerpro">4. Payment</h1>
        </li>
        <li class="list-group-item">
          <h1 class="display-6 archerpro">5. Successful</h1>
        </li>
      </ul>
    </section>
<div class="container-fluid">
  <div class="row">
    <div class="col-lg-8 mt-5">
      <h2 class="section-title roboto-bold">SELECT BEVERAGES</h2>
      <div id="beverage-list" class="row row-cols-1 row-cols-sm-4 row-cols-md-4 row-cols-lg-4 g-2"></div>
      <p class="mt-4 float-start roboto-medium">*Always check your order summary before proceeding to payment. You may proceed if you do not need any beverages.</p>
      <button class="btn btn-warning mt-3 float-end roboto-bold" style=
      "background: linear-gradient(
      359deg,
      rgba(255, 154, 0, 1) 0%,
      rgba(255, 115, 0, 1) 50%,
      rgba(255, 77, 0, 1) 100%
      );"
      id="nextBtn"><span class="roboto-bold">Next</span></button>
    </div>
    <div class="col-lg-4">
      <div class="basket">
        <h5 class="roboto-bold" style="background-color: #bebebe;">YOUR BASKET</h5>
        <p class=" text-break roboto-bold" id="movieTicketInfo"><?php echo $data["movieTitle"] . " - ". $data["selectedQuality"]; ?>  *<span id="qty"><?php echo intval($data["ticketQuantity"]) ?>  </span> - <span> <?php echo intval($data["ticketTotal"])  ?></span></p>
        <p class="roboto-bold" >Seats: <?php foreach($seatTaken as $seats){ echo $seats . " ";} ?></p>
        <hr>
        <ul id="basket-items" class="text-white roboto-bold" style="background-color: #ff7400;"></ul>  
        <hr>
        <div class="total roboto-bold" style="background-color: #ffc100" >TOTAL COST: <span id="total-cost"><?php $data["ticketTotal"] ?></span></div>
      </div>
    </div>
  </div>
</div>

<script src="js/beverage.js">

</script>
</body>
</html>
