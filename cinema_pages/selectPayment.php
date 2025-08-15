<?php
$header = include '../../Cinema-Ticketing/php/Header.php';
  include '../../Cinema-Ticketing/php/connection.php';
  @include '../../Cinema-Ticketing/php/select.php';
  $data = convertCookie("movieDetails");
  @$beverages = $data['beverages'];
  $seatTaken = $data['seatsTaken'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="../css/bootstrap.min.css">
  <link rel="stylesheet" href="../fonts/font-style.css">
  <link rel="stylesheet" href="css/selectpayment.css">
  <script src="js/cookieReader.js"></script>
  <title>Pop Cinema - Payment</title>  
</head>
<body>
<!--options(keemop.)-->

  <div class="container mt-4">
    <div class="row">
      <!-- Payment Options -->
      <div class="col-md-7">
        <h4 class="mb-3 roboto-bold text-white">SELECT PAYMENT OPTION</h4>
        
        <h5 class="mb-3 roboto-bold text-center" style="color: #bebebe;">Choose e-Wallets:</h5>
        <div class="e-Wallets d-flex flex-row justify-content-center ">
        <div class="form-check form-check-inline">
          <input class="form-check-input epay" type="radio" name="payment" id="gcash" checked>
          <label class="form-check-label " for="gcash">
            <img src="../images/gcash.png" width="60" alt="GCash">
          </label>
        </div>
        <div class="form-check form-check-inline">
          <input class="form-check-input epay" type="radio" name="payment" id="maya">
          <label class="form-check-label" for="maya">
            <img src="../images/maya.png" width="60" alt="Maya">
          </label>
        </div>
      </div>

        <h5 class="mt-4 mb-3 roboto-bold text-center" style="color: #bebebe;">Choose Banks:</h5>
        <div class="banks d-flex flex-row justify-content-center">
        <div class="form-check form-check-inline ">
          <input class="form-check-input cardpay" type="radio" name="payment" id="bpi">
          <label class="form-check-label" for="bpi">
            <img src="../images/bpi.png" width="60" alt="BPI">
          </label>
        </div>
        <div class="form-check form-check-inline">
          <input class="form-check-input cardpay" type="radio" name="payment" id="bdo">
          <label class="form-check-label" for="bdo">
            <img src="../images/bdo.png" width="60" alt="BDO">
          </label>
        </div>
        <div class="form-check form-check-inline">
          <input class="form-check-input cardpay" type="radio" name="payment" id="visa">
          <label class="form-check-label" for="visa">
            <img src="../images/visa.png" width="60" alt="Visa">
        </label>
        </div>
        <div class="form-check form-check-inline">
          <input class="form-check-input cardpay" type="radio" name="payment" id="mastercard">
          <label class="form-check-label" for="mastercard">
            <img src="../images/mastercard.png" width="60" alt="MasterCard">
          </label>
        </div>
      </div>


        <div class="next-btn d-flex justify-content-end mt-4">
          <button type="submit" name="submitBtn" class="btn text-white"
          style=
          "background: linear-gradient(
          359deg,
          rgba(255, 154, 0, 1) 0%,
          rgba(255, 115, 0, 1) 50%,
          rgba(255, 77, 0, 1) 100%
          );"
           form="paymentCard" id="nextBtn"><span class="roboto-bold">Next</span></button>
        </div>

      </div>

      <!-- Basket -->
      <div class="col-md-5">
    <div class="your-basket">
     <div class="container-sm h-100 basket-color g-flex flex-wrap px-0">
      <div class=" text-center roboto-bold"><h1>Your Basket</h1></div>
      <div class="seat-section seat-color m-0 p-0 ">
        <h5 class="p-4 text-break roboto-bold" id="movieTicketInfo"><?php echo $data["movieTitle"] . " - ". $data["selectedQuality"]; ?>  *<span id="qty"><?php echo intval($data["ticketQuantity"]) ?>  </span> - <span> <?php echo intval($data["ticketTotal"])  ?></span></h5>
         <h5 id="selectedSeats" class="p-4 m-0 text-break roboto-bold">Seats: <?php foreach($seatTaken as $seats){ echo $seats . " ";} ?> </h5>
        </div>
        <div class="beverage-section beverage-color roboto-bold">
          <?php if (!empty($beverages) && is_array($beverages)) {foreach($beverages as $bev){ if (!empty($bev)) {echo "<h5 class='m-0 p-4'>" . $bev . "</h5>";}}} ?>
        </div>
        <div class="cost-section d-flex justify-content-around flex-wrap bg-warning m-0">
          <h1 class="roboto-bold">Total Cost:</h1>
          <h1><?php echo $data["ticketTotal"] ?></h1>
        </div>
      </div>
      </div>
      </div>
    </div>
  </div>

  <script src="js/selectPayment.js"></script>
</body>
</html>