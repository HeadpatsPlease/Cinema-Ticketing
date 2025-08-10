<?php 
  include '../../Cinema-Ticketing/php/connection.php';
  @include '../../Cinema-Ticketing/php/select.php';
  $header = include '../../Cinema-Ticketing/php/Header.php';
  $movieTitle = $_COOKIE['movietitle'];
  $selectedTime = $_COOKIE['selectedtime'];
  $selectedDate = $_COOKIE['selecteddate'];
  $selectedQuality = $_COOKIE['selectedquality'];
  $location = $_COOKIE['loc'];

  $ticketSelect = $conn->query("SELECT * FROM `overview` WHERE status = 'Now Showing' AND movie_name = '$movieTitle' ");
  $cinema = $conn->query("SELECT DISTINCT cinema FROM `moviecinema` WHERE movie_name = '$movieTitle' AND time = '$selectedTime';")
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../css/bootstrap.min.css" />
    <link rel="stylesheet" href="css/tickets.css">
    <script src="../cinema_pages/js/cookieReader.js"></script>
    <title>Select Tickets</title>
  </head>
  <body>
    <header class="nav-color">
      <?php $header ?>
    </header>

    <section class="d-flex justify-content-center mt-3">
      <ul class="list-group list-group-horizontal-sm">
        <li class="list-group-item active-item">
          <h1 class="display-6">1. Select Tickets</h1>
        </li>
        <li class="list-group-item">
          <h1 class="display-6">2 Select Seats</h1>
        </li>
        <li class="list-group-item">
          <h1 class="display-6">3. Beverages</h1>
        </li>
        <li class="list-group-item">
          <h1 class="display-6">4. Payment</h1>
        </li>
        <li class="list-group-item">
          <h1 class="display-6">5. Successful</h1>
        </li>
      </ul>
    </section>

    <section class="row g-2 mt-1 ms-1">
      <div class="col-12 col-md-8">
        <div class="d-flex">
         <?php while ($ticket = $ticketSelect->fetch_assoc()) { ?>
          <img
            class="img-fluid w-50 h-50 me-2"
            src="../images/<?php echo $ticket['movie_poster'] ?>"
            alt="movie photo"
          />  
          <p class="me-0 text-light">
            <span class="h3"> <?php echo $ticket['movie_name'] ?> </span> <br />
            Schedule: <?php echo $selectedDate ?> - <?php echo $selectedTime ?> - <span id="cinema"><?php while ($cine = $cinema->fetch_assoc()) { echo $cine["cinema"]; } ?></span> <br />
            <?php echo $location ?><br>
            *Please verify that you are booking seats at your chosen location*
          </p>
        </div>

        <div>
          <h3 class="text-light">Select Tickets</h3>
          <p class="text-light">NOTE: You can only buy maximum of 8 tickets</p>
          <table class="table">
            <thead>
              <tr>
                <th class="bg-dark text-light">Tickets</th>
                <th class="bg-dark text-light">Cost</th>
                <th class="bg-dark text-light">Qty</th>
                <th class="bg-dark text-light">Subtotal</th>
              </tr>
            </thead>
            <tbody class="border-none">
              <tr>
                <td class="bg-dark text-light">2D</td>
                <td class="bg-dark text-light">250</td>
                <td class="bg-dark text-light">
                  <div class="d-flex align-items-center">
                    <button class="btn text-light" id="buttonQtyAdd">+</button>
                    <p class="m-0" id="qty">1</p>
                    <button class="btn text-light" id="buttonQtyReduce">
                      -
                    </button>
                  </div>
                </td>
                <td class="bg-dark text-light" id="subtotal">250</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
      <div class="col-12 col-md-4">
        
        <div
          class="container-sm w-75 h-auto basket-color g-flex flex-wrap px-0"
        >

          <div class="text-center"><h1>Your Basket</h1></div>
          <div class="seat-section seat-color m-0 p-0">
            <h5 class="p-4 text-break" id="movieTicketInfo"><?php echo $ticket['movie_name'] . " - ". $selectedQuality ?>  *<span id="qty">1</span> - <span id="totalBasketCost"> 250</span></h5>
            <div class="beverage-section beverage-color"></div>
            <div
              class="cost-section d-flex justify-content-around flex-wrap bg-warning"
            >

              <h1>Total Cost:</h1>
              <h1 id="totalBasketCost">250</h1>
            </div>
            <?php } ?>
          </div>
        </div>
      </div>
    </section>
    <div class="d-flex justify-content-center">
      <button class="btn btn-warning" id="nextBtn">Next</button>
    </div>
  </body>

  <script src="js/tickets.js"></script>
</html>
