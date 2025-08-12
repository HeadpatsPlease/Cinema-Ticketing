<?php
  $header = include '../../Cinema-Ticketing/php/Header.php';
  include '../../Cinema-Ticketing/php/connection.php';
  @include '../../Cinema-Ticketing/php/select.php';
  session_start();
  

  

  $data = convertCookie("movieDetails");
  @$beverages = $data['beverages'];
  $seatTaken = $data['seatsTaken'];


  if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $cardName = filter_input(INPUT_POST, "cardName", FILTER_SANITIZE_SPECIAL_CHARS);
    $cardNum = filter_input(INPUT_POST, "cardNumber", FILTER_SANITIZE_NUMBER_INT);
    if(isset($_POST['submitBtn'])){
      if($cardName !== null && $cardNum !== null){
        $_SESSION['cardUser'] = $cardName;
        $_SESSION['cardNumber'] = substr($cardNum, -4);
        echo "<script>window.location.href='successful.php';</script>";
        exit;
      }
    }
  }
?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../css/bootstrap.min.css"/>
    <script src="js/cookieReader.js"></script>
    <title>Payment Section </title>
    <style>
          .basket-color{
         background-color: #bebebe;
        }
       .seat-color{
         background-color: #ff4d00;
        }
        .beverage-color{

        background-color: orange;

        }
       .left{
        margin-top: 20px;
       }
    </style>
  </head>
  <body class="bg-dark">
  <div class="container-fluid row">
  <div class="left col-md-8 col-12 ">
     <div>
      <div class="col  p-2 rounded text-white" style="background-color: #ff4d00;">
        <h1><?php echo $data['movieTitle'] ?></h1>  
      </div>
      <p style="color: white">Schedule: <?php echo $data['selectedDate'] ." - ". $data['selectedTime']  ?> </p>
      <p style="color: white"><?php echo $data['location'] ?> - <?php echo $data['selectedQuality'] . " - " . $data['cinema'] ?>  </p>
    </div>

    <div class="payment d-flex flex-md-row flex-column">
      <div class="about-to-pay me-3">
      <div class=" bg-white text-dark p-2 rounded text-center">
        <p>YOU ARE ABOUT TO PAY</p>
        <h1>PHP <?php echo $data['ticketTotal']?> </h1>
        <p>to POP CINEMA INC.</p>
        <p>Reference No.</p>
        <h5 id="refNo"><?php echo $data['refNo'] ?></h5>
      </div>
    </div>

    
    <div class="">
      <div class=" bg-white text-dark p-2 rounded payment-form mt-4">
        <h3>Pay using credit/debit card</h3>
        <form id="paymentCard" action="payment.php" method="post">
          <div class="mb-3">
            <label for="namecard" class="form-label">Name on Card</label>
            <input type="text" class="form-control" id="namecard" name="cardName" pattern="[A-Za-z\s]+"  placeholder="Enter your name card" required>
            <div class="invalid-feedback">
              Please enter a valid name card.
            </div>
          </div>

          <div class="mb-3">
            <label for="cardnumber" class="form-label">Card number</label>
            <input type="tel" class="form-control" id="cardNumber" name="cardNumber" placeholder="Enter your card number" 
                   required pattern="[0-9]{10,15}">
            <div class="invalid-feedback">
              Please enter a valid card number (10–15 digits).
            </div>
          </div>

          <div class="form-check mb-3">
            <input type="checkbox" class="form-check-input" id="authorize" required>
            <label class="form-check-label" for="authorize">
              I authorize POP CINEMA INC. to debit the above net charges from my credit card and I have read & agreed to
              <a href="#">Pop Cinema's Privacy Statement</a>
            </label>
          </div>

          <p class="text-secondary small">
            ⚠️ Once payment has been processed, the ticket and the payment cannot be refunded
          </p>

          
        </form>
      </div>
    </div>
    </div>
    <div class="next-btn d-flex justify-content-end mt-4">
      <button type="submit" name="submitBtn" class="btn btn-primary w-25 mt-2" form="paymentCard">Submit</button>
    </div>
  </div>
  <div class="right col-md-4 col-12 mt-4">
     <div class="your-basket">
     <div class="container-sm  h-100 basket-color g-flex flex-wrap px-0">
      <div class=" text-center"><h1>Your Basket</h1></div>
      <div class="seat-section seat-color m-0 p-0">
        <h5 class="p-4 text-break" id="movieTicketInfo"><?php echo $data["movieTitle"] . " - ". $data["selectedQuality"]; ?>  *<span id="qty"><?php echo intval($data["ticketQuantity"]) ?>  </span> - <span> <?php echo intval($data["ticketTotal"])  ?></span></h5>
         <h5 id="selectedSeats" class="p-4 m-0 text-break">Seats: <?php foreach($seatTaken as $seats){ echo $seats . " ";} ?> </h5>
        </div>
        <div class="beverage-section beverage-color">
          <?php if (!empty($beverages) && is_array($beverages)) {foreach($beverages as $bev){ if (!empty($bev)) {echo "<h5 class='m-0 p-4'>" . $bev . "</h5>";}}} ?>
        </div>
        <div class="cost-section d-flex justify-content-around flex-wrap bg-warning m-0">
          <h1>Total Cost:</h1>
          <h1><?php echo $data["ticketTotal"] ?></h1>
        </div>
      </div>
      </div>
   

  </div>
  </div>
  <script src="js/payment.js"></script>
  
</body>

</html>