<?php
  $header = include '../../Cinema-Ticketing/php/Header.php';
  include '../../Cinema-Ticketing/php/connection.php';
  @include '../../Cinema-Ticketing/php/select.php';
  session_start();
  $method = $_COOKIE['method'];
  $data = convertCookie("movieDetails");
  @$beverages = $data['beverages'];
  $seatTaken = $data['seatsTaken'];
  $errmsg = '';
  $qualitySelected = $data["selectedQuality"];
  $cinemaPrice = $conn->query("SELECT * FROM `availability` WHERE available_quality = '$qualitySelected' ");
  $Cprice= $cinemaPrice->fetch_assoc();

  if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $epayName = filter_input(INPUT_POST, "epayName", FILTER_SANITIZE_SPECIAL_CHARS);
    $epayNumber = filter_input(INPUT_POST, "epayNumber", FILTER_SANITIZE_NUMBER_INT);

    $nameCard = filter_input(INPUT_POST, "cardName", FILTER_SANITIZE_SPECIAL_CHARS);
    $cardNumber = filter_input(INPUT_POST, "cardNumber", FILTER_SANITIZE_NUMBER_INT);
    $cardExpiry = filter_input(INPUT_POST, "cardexpiry", FILTER_SANITIZE_SPECIAL_CHARS);
    $cardExpiryformatted = str_replace("/", "-", $cardExpiry);
    $cardPin = filter_input(INPUT_POST, "cardpin", FILTER_SANITIZE_NUMBER_INT);

    $ePaymentCheck = $cash->query("SELECT * FROM `vw_dashboard` WHERE card_num = '$epayNumber';");
    $cardPaymentCheck = $cash->query("SELECT * FROM `vw_dashboard` WHERE card_num = '$cardNumber' AND pin = '$cardPin' AND fullname = '$nameCard';");

    $cardPayment = $cardPaymentCheck->fetch_assoc();
    $ePayment = $ePaymentCheck->fetch_assoc();
    if(isset($_POST['submitBtn'])){
      if($epayName !== null && $epayNumber !== null){
        if(isset($ePayment)){
          if(intval($ePayment['balance']) >= intval($data["ticketTotal"])){
            $_SESSION['paymentUser'] = $epayName;
            $_SESSION['paymentNumber'] = substr($epayNumber, -4);
            echo "<script>window.location.href='successful.php';</script>";
            exit;
          }else{
            $errmsg = "Insufficient Balance";
          }
        }else{
          $errmsg = "The Card number does not exist";
        }
      }else if($nameCard !== null && $cardNumber !== null && $cardExpiry !== null && $cardPin !== null){
        if(isset($cardPayment) && strpos($cardPayment['expiry_date'],$cardExpiryformatted) !== false){
          if(intval($cardPayment['balance']) >= intval($data["ticketTotal"])){
            $_SESSION['paymentUser'] = $nameCard;
            $_SESSION['paymentNumber'] = substr($cardNumber, -4);
            echo "<script>window.location.href='successful.php';</script>";
            exit;
          }else {
            $errmsg = "Insufficient Balance";
          }
      }else {
        $errmsg = "The Card number does not exist";
        }
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
       .list-group-item {
        background-color: #bebebe;
        border: none;
      }
      .active-item {
        background: #ff9a00;
        background: linear-gradient(
          359deg,
          rgba(255, 154, 0, 1) 0%,
          rgba(255, 115, 0, 1) 50%,
          rgba(255, 77, 0, 1) 100%
        );
        border: none;
      }
    </style>
  </head>
  <body class="bg-dark">
     <section class="d-flex justify-content-center mt-3">
      <ul class="list-group list-group-horizontal-sm">
        <a href="tickets.php" class="text-decoration-none">
          <li class="list-group-item">
            <h1 class="display-6 archerpro">1. Select Tickets</h1>
          </li>
        </a>
        <a href="seating.php" class="text-decoration-none">
          <li class="list-group-item">
            <h1 class="display-6 archerpro">2. Select Seats</h1>
          </li>
        </a>
        <a href="beverage.php" class="text-decoration-none">
          <li class="list-group-item ">
            <h1 class="display-6 archerpro">3. Beverages</h1>
          </li>
        </a>
        <li class="list-group-item active-item">
          <h1 class="display-6 archerpro ">4. Payment</h1>
        </li>
        <li class="list-group-item">
          <h1 class="display-6 archerpro">5. Successful</h1>
        </li>
      </ul>
    </section>
  <div class="container-fluid row">
  <div class="left col-md-8 col-12 ">
     <div>
      <div class="col  p-2 rounded text-white" style="background-color: #ff4d00;">
        <h1 class="roboto-bold"><?php echo $data['movieTitle'] ?></h1>  
      </div>
      <p class="roboto-bold" style="color: white">Schedule: <?php echo $data['selectedDate'] ." - ". $data['selectedTime']  ?> </p>
      <p class="roboto-bold" style="color: white"><?php echo $data['location'] ?> - <?php echo $data['selectedQuality'] . " - " . $data['cinema'] ?>  </p>
    </div>

    <div class="payment d-flex flex-md-row flex-column">
      <div class="about-to-pay me-3">
      <div class=" bg-white text-dark p-2 rounded text-center">
        <p class="roboto-medium">YOU ARE ABOUT TO PAY</p>
        <h1 class="roboto-bold">PHP <?php echo $data['ticketTotal']?> </h1>
        <p class="roboto-medium">to POP CINEMA INC.</p>
        <p class="roboto-medium">Reference No.</p>
        <h5 class="roboto-bold" id="refNo"><?php echo $data['refNo'] ?></h5>
      </div>
    </div>

    
    <div class="">
      <div class=" bg-white text-dark p-2 rounded payment-form mt-4">
        <?php
        if($method === "cardpay"){
          ?>
          <h3 class="roboto-medium">Pay using Credit/Debit</h3>
        <div class="error"><?= $errmsg?></div>
        <form id="paymentCard" action="payment.php" method="post">
          <div class="mb-3 roboto-medium">
            <label for="namecard" class="form-label roboto-medium">Name</label>
            <input type="text" class="form-control roboto-medium" id="namecard" name="cardName" pattern="[A-Za-z\s]+"  placeholder="Please enter a valid name card." required>
          </div>

          <div class="mb-3">
            <label for="cardNumber" class="form-label roboto-medium">Account number</label>
            <input type="tel" class="form-control roboto-medium" id="cardNumber" name="cardNumber" placeholder="Please enter a valid card number (10–15 digits)." 
                   required pattern="[0-9]{10,15}">
          </div>

          <div class="d-flex">
            <div class="mb-3 w-50">
            <label for="cardpin" class="form-label roboto-medium">Pin</label>
            <input type="tel" class="form-control roboto-medium" id="cardpin" name="cardpin" placeholder="000" 
                   required pattern="[0-9]{3}">
            </div>
            <div class="mb-3 w-50">
              <label for="cardexpiry" class="form-label roboto-medium">Expiry Date</label>
              <input type="tel" class="form-control roboto-medium" id="cardexpiry" name="cardexpiry" placeholder="MM/DD" 
                    required pattern="[0-9/]+">
            </div>
          </div>

          <div class="form-check">
            <input type="checkbox" class="form-check-input" id="authorize" required>
            <label class="form-check-label roboto-medium" for="authorize">
              By providing your personal data and clicking Submit, you Consent and that you have read our <a href="#" data-bs-toggle="modal" data-bs-target="#datapolicy">Data Privacy Policy</a>.
            </label>
            
          </div>
          <div class="form-check mb-3">
            <input type="checkbox" class="form-check-input" id="authorize" required>
            <label class="form-check-label roboto-medium" for="authorize">
              I have read and understood the 
              <a href="#" data-bs-toggle="modal" data-bs-target="#termsCond">Terms and Conditions</a>
            </label>
          </div>
          

          <p class="text-secondary small roboto-bold">
            ⚠️ Once payment has been processed, the ticket and the payment cannot be refunded
          </p>

          
        </form>
        <?php
        }else{
          ?>
          <h3 class="roboto-medium">Pay using E-Wallet</h3>
        <div class="error"><?= $errmsg?></div>
        <form id="paymentCard" action="payment.php" method="post">
          <div class="mb-3 roboto-medium">
            <label for="namecard" class="form-label roboto-medium">Name</label>
            <input type="text" class="form-control roboto-medium" id="namecard" name="epayName" pattern="[A-Za-z\s]+"  placeholder="Please enter a valid name." required>
          </div>

          <div class="mb-3">
            <label for="epayNumberber" class="form-label roboto-medium">Account number</label>
            <input type="tel" class="form-control roboto-medium" id="epayNumberber" name="epayNumber" placeholder="Please enter a valid E-Wallet number." 
                   required pattern="[0-9]{10,15}">
          </div>

          <div class="form-check">
            <input type="checkbox" class="form-check-input" id="authorize" required>
            <label class="form-check-label roboto-medium" for="authorize">
              By providing your personal data and clicking Submit, you Consent and that you have read our <a href="#" data-bs-toggle="modal" data-bs-target="#datapolicy">Data Privacy Policy</a>.
            </label>
            
          </div>
          <div class="form-check mb-3">
            <input type="checkbox" class="form-check-input" id="authorize" required>
            <label class="form-check-label roboto-medium" for="authorize">
              I have read and understood the 
              <a href="#" data-bs-toggle="modal" data-bs-target="#termsCond">Terms and Conditions</a>
            </label>
          </div>

          <p class="text-secondary small roboto-bold">
            ⚠️ Once payment has been processed, the ticket and the payment cannot be refunded
          </p>

          
        </form>
      <?php  
      }
        ?>
      </div>
    </div>
    </div>
    <div class="next-btn d-flex justify-content-end mt-4">
      <button type="submit" name="submitBtn" class="btn text-white w-25"
      style=
      "background: linear-gradient(
      359deg,
      rgba(255, 154, 0, 1) 0%,
      rgba(255, 115, 0, 1) 50%,
      rgba(255, 77, 0, 1) 100%
      );"
       form="paymentCard"><span class="roboto-bold">Submit</span></button>
    </div>
    <div class="next-btn d-flex justify-content-end mt-4">
      <a href="selectPayment.php">
        <button type="button" class="btn text-white w-25"
          style=
          "background: linear-gradient(
          359deg,
          rgba(255, 154, 0, 1) 0%,
          rgba(255, 115, 0, 1) 50%,
          rgba(255, 77, 0, 1) 100%
          );"
          ><span class="roboto-bold">Back</span></button>
      </a>
    </div>
  </div>
  <div class="right col-md-4 col-12 mt-4">
     <div class="your-basket">
     <div class="container-sm  h-100 basket-color g-flex flex-wrap px-0">
      <div class=" text-center roboto-bold"><h1>Your Basket</h1></div>
      <div class="seat-section seat-color m-0 p-0">
        <h5 class="p-4 text-break roboto-bold" id="movieTicketInfo"><?php echo $data["movieTitle"] . " - ". $data["selectedQuality"]; ?>  *<span id="qty"><?php echo intval($data["ticketQuantity"]) ?>  </span> - <span> <?php echo intval($Cprice['price']);  ?></span></h5>
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
  <div class="modal" id="datapolicy" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Data Privacy Policy – Pop Cinema</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        In Pop Cinema, we values your privacy and is committed to protecting the personal information you share with us. This Data Privacy Policy outlines how we collect, use, store, share, and protect your personal data in compliance with the <b>Data Privacy Act of 2012 (RA 10173)</b> and its Implementing Rules and Regulations (IRR).<br>
        <br>

        <b>1. Scope</b><br>
        This policy applies to all personal data collected from:<br>
        - Website visitors<br>
        - Clients and customers<br>
        - Job applicants and employees<br>
        - Partners, suppliers, and third-party service providers<br>
        <br>

        <b>2. Information We Collect</b><br>
        We may collect the following personal information:<br>
        - <b>Basic Information:</b> Full name, date of birth, gender, nationality<br>
        - <b>Contact Information:</b> Address, email, phone number<br>
        - <b>Account Information:</b> Username, login details, preferences<br>
        - <b>Financial Information:</b> Billing details, payment information (if applicable)<br>
        - <b>Other Information:</b> Any information you voluntarily provide<br>
        <br>

        <b>3. How We Use Your Information</b><br>
        We process your data only for legitimate purposes, including:<br>
        - Providing and improving our services<br>
        - Processing transactions and payments<br>
        - Communicating with you (e.g., updates, inquiries, support)<br>
        - Complying with legal obligations<br>
        - Marketing, promotions, and surveys (with your consent)<br>
        <br>

        <b>4. Sharing of Personal Data</b><br>
        We may share your information with:<br>
        - Authorized personnel within our organization<br>
        - Third-party service providers (e.g., IT, payment processors, logistics)<br>
        - Government authorities, if required by law or legal processes<br>
        We will never sell or rent your personal data.<br>
        <br>

        <b>5. Data Storage and Retention</b><br>
        - We store your data securely in [cloud storage/servers/physical files] with appropriate safeguards.<br>
        - We retain your information only for as long as necessary to fulfill the purpose it was collected for, or as required by law.<br>
        <br>

        <b>6. Data Protection Measures</b><br>
        We implement organizational, physical, and technical measures to protect your data, such as:<br>
        - Secure servers and encrypted storage<br>
        - Access control and authentication procedures<br>
        - Regular system monitoring and updates<br>
        <br>

        <b>7. Your Rights Under RA 10173</b><br>
        You have the right to:<br>
        - Be informed of how your data is collected and processed<br>
        - Access, correct, and update your personal information<br>
        - Withdraw consent at any time<br>
        - Request deletion of your data, subject to legal and contractual obligations<br>
        - File a complaint with the <b>National Privacy Commission (NPC)</b><br>
        <br>

        <b>8. Use of Cookies</b><br>
        Our website may use cookies to improve user experience, analyze traffic, and personalize content. You can disable cookies in your browser settings.<br>
        <br>

        <b>9. Policy Updates</b><br>
        We may update this Data Privacy Policy from time to time. Any changes will be posted on this page with an updated “Last Updated” date.<br>
        <br>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>
 <div class="modal" id="termsCond" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Terms and Condition – Pop Cinema</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        By purchasing a ticket from Pop Cinema, you agree to the following Terms and Conditions. Please read carefully before completing your purchase.<br>
        <br>

        <b>1. Ticket Purchase and Payment</b><br>
        - All ticket purchases are considered <b>final</b> once payment is completed.<br>
        - Tickets may be purchased through our [website, mobile app, ticket booth, partner platforms].<br>
        - Please ensure that all details (movie title, schedule, seat number, and payment amount) are correct before confirming your transaction.<br>
        <br>

        <b>2. No Refunds Policy</b><br>
        - Once a ticket has been successfully purchased and paid for, <b>no refunds, cancellations, or exchanges</b> will be allowed, except in cases where the screening is <b>canceled or rescheduled</b> by [Your Cinema Name].<br>
        - Incorrect booking due to customer error (wrong date, time, or movie) will not be eligible for a refund.<br>
        <br>

        <b>3. Rescheduling and Cancellations by Cinema</b><br>
        - In the event that a movie screening is <b>canceled, rescheduled, or interrupted</b> due to technical issues, emergencies, or other circumstances beyond our control, you may be entitled to a ticket replacement or a refund, subject to our management’s decision.<br>
        - Refunds, if granted, will only cover the <b>ticket price</b> and not additional expenses (transportation, food, etc.).<br>
        <br>

        <b>4. Admission Rules</b><br>
        - A valid ticket must be presented at the entrance for admission.<br>
        - Lost, stolen, or damaged tickets will not be replaced.<br>
        - We reserve the right to refuse entry to guests who violate house rules, exhibit inappropriate behavior, or fail to comply with cinema policies.<br>
        <br>

        <b>5. Seat Reservation</b><br>
        - Seats are only guaranteed for the <b>movie schedule printed on the ticket</b>.<br>
        - Late arrivals may result in loss of reserved seating, and no refunds will be given.<br>
        <br>

        <b>6. Code of Conduct</b><br>
        - Guests must maintain proper decorum inside the cinema.<br>
        - Recording or photographing movies is strictly prohibited under the <b>Philippine Anti-Camcording Act (RA 10088)</b>. Violators will be reported to authorities.<br>
        <br>

        <b>7. Limitation of Liability</b><br>
        - Pop Cinema shall not be liable for damages, losses, or expenses incurred due to customer error, force majeure events, or unforeseen circumstances.<br>
        - Our maximum liability is limited to the <b>face value of the ticket</b>.<br>
        <br>

        <b>8. Updates to Terms</b><br>
        We may update these Terms and Conditions at any time. The latest version will always be available at our website.<br>
        <br>


      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>

  <script src="js/payment.js"></script>
  <script src="../js/bootstrap.bundle.min.js"></script>
</body>

</html>