<?php
include '../../Cinema-Ticketing/php/connection.php';
@include '../../Cinema-Ticketing/php/select.php';
session_start();
$data = convertCookie("movieDetails");
@$beverages = $data['beverages'];
@$beverageID = $data['beverageID'];
$seatTaken = $data['seatsTaken'];
$movieName = $data['movieTitle'];
$cinema = $data['cinema'];
$refNo = $data['refNo'];
$date = $data['selectedDate'] . " " . $data['selectedTime'];
$dateTime = dateTime($date);
$quality = str_replace("'", "", $data['selectedQuality']);
$total = $data['ticketTotal'];
  $qualitySelected = $data["selectedQuality"];
  $cinemaPrice = $conn->query("SELECT * FROM `availability` WHERE available_quality = '$qualitySelected' ");
$Cprice= $cinemaPrice->fetch_assoc();





if (isset($_SESSION['paymentUser']) && isset($_SESSION['paymentNumber'])) {
    $cardName = $_SESSION['paymentUser'];
    $cardNum = $_SESSION['paymentNumber'];
    $query1 = $admin->query("INSERT INTO `tickets`(`movie_id`, `quality_id`, `cinema_id`, `reference_number`, `totalCost`, `schedule`,`status`) 
        VALUES (getMovie('$movieName'),getQuality('$quality'),getCinema('$cinema'),'$refNo',$total,'$dateTime',1)");

    if ($query1) {
        if (!empty($beverageID) && is_array($beverageID)) {
            foreach ($beverageID as $key => $value) {
                $query2 = $admin->query("CALL setBeverage('$refNo', $key, $value)");
            }
        }

    }
    foreach ($seatTaken as $seats) {
        $query3 = $admin->query("CALL setSeats('$refNo', '$seats')");
    }

} else {
    echo "<script>window.location.href='../index.php';</script>";
}





?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../css/bootstrap.min.css" />
    <title>Successful section </title>
    <script src="js/libs/html2canvas.min.js"></script>
    <script src="js/libs/jspdf.umd.min.js"></script>
    <script src="js/cookieReader.js"></script>
    <script src="js/libs/html5-qrcode.min.js"></script>
    <style>
        .sched {
            background-color: rgb(77, 71, 71);
        }

        .seats {
            background-color: gray;
        }

        .active-item {
            background: #ff9a00;
            background: linear-gradient(359deg,
                    rgba(255, 154, 0, 1) 0%,
                    rgba(255, 115, 0, 1) 50%,
                    rgba(255, 77, 0, 1) 100%);
            border: none;
        }

        .list-group-item {
            background-color: #bebebe;
            border: none;
        }
    </style>
</head>

<body class="bg-dark">
    <header>
        <?php include '../../Cinema-Ticketing/php/Header.php'; ?>
    </header>
     <section class="d-flex justify-content-center mt-3">
      <ul class="list-group list-group-horizontal-sm">
        <li class="list-group-item">
          <h1 class="display-6 archerpro">1. Select Tickets</h1>
        </li>
        <li class="list-group-item">
          <h1 class="display-6 archerpro">2. Select Seats</h1>
        </li>
        <li class="list-group-item ">
          <h1 class="display-6 archerpro">3. Beverages</h1>
        </li>
        <li class="list-group-item">
          <h1 class="display-6 archerpro">4. Payment</h1>
        </li>
        <li class="list-group-item active-item">
          <h1 class="display-6 archerpro">5. Successful</h1>
        </li>
      </ul>
    </section>


    <div class="container-fluid row mt-5">
        <div class="left col-md-4 col-12 text-warning bg-dark p-2 ">
            <h2 style="font-size: 80px;">BOOKING </h2>
            <h2 style="font-size: 80px;">SUCCESSFUL</h2>
        </div>
        <div class="middle col-md-4 col-12  d-flex flex-md-column flex-column" id="ticket">
            <div class="text-center bg-white text-dark p-3">
                <img src="../images/New Project 11 [EF32D02].png" style="width: 180px; height: auto; " alt="POP logo">
                <h2><strong>POP CINEMA ONLINE TICKET</strong></h2>
            </div>
            <div class="sched text-light text-center">
                <p style="margin-bottom: 1px ">Schedule:
                    <?php echo $data['selectedDate'] . " - " . $data['selectedTime'] ?></p>
                <p style="margin-bottom: 1px"><?php echo $data['location'] ?> -
                    <?php echo $data['selectedQuality'] . " - " . $data['cinema'] ?></p>
            </div>
            <div class="text-dark">
                <div class="seats d-flex justify-content-between align-items-center">
                    <h5><strong><?php echo $data["movieTitle"] ?></strong></h5>
                    <h5><strong>-</strong></h5>
                    <h5><strong><?= $data["selectedQuality"] . " *" . intval($data["ticketQuantity"]); ?></strong></h5>
                    <h5><strong>-</strong></h5>
                    <h5><strong> <?php echo intval($Cprice['price']) ?></strong></h5>
                </div>
                <div class=" seats d-flex justify-content-between">
                    <h5><strong>Seats: <?php foreach ($seatTaken as $seats) {
                        echo $seats . " ";
                    } ?></strong></h5>
                </div>
                <div class="bg-white ">
                    <div class="bg-white" style="border-bottom: 2px solid black;">
                        <div>
                            <?php if (!empty($beverages) && is_array($beverages)) {
                                foreach ($beverages as $bev) {
                                    if (!empty($bev)) {
                                        $parts = explode(" - ", $bev);
                                        $productName = $parts[0];
                                        $quantity = $parts[1];
                                        $price = $parts[2];

                                        echo
                                        "<div class='d-flex justify-content-between align-items-center '>
                                            <div>
                                                <h4>$productName</h4>
                                            </div>
                                            <div>
                                                <span> $quantity </span>
                                            </div>
                                            <div>
                                                <h4>$price</h4>
                                            </div>
                                        </div>";
                                    }
                                }
                            } ?>
                        </div>
                    </div>
                </div>
                <div class="bg-white p-2">
                    <div class="d-flex justify-content-between">
                        <h1><strong>TOTAL COST</strong></h1>
                        <h1><strong> ₱<?php echo intval($data["ticketTotal"]) ?></strong></h1>
                    </div>
                    <div class="text-center">
                        <div id="qrCode" class="d-flex justify-content-center"></div>
                        <h3><strong>Reference No. <span id="refNo"><?php echo $data['refNo'] ?></span></strong></h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="print col-md-4 col-12 d-flex align-items-end">
            <button type="submit" class="btn   p-3 w-25 mt-2 text-light" style="background-color: #ff4d00;"
                onclick="downloadPDF();">Print e-Ticket</button>
        </div>
    </div>
    <script src="js/libs/qrcode.min.js"></script>
    <script src="js/successful.js"></script>
</body>

</html>