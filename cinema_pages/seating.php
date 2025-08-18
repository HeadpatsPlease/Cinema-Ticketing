<?php
  $header = include '../../Cinema-Ticketing/php/Header.php';
  include '../../Cinema-Ticketing/php/connection.php';
  @include '../../Cinema-Ticketing/php/select.php';
  $data = convertCookie("movieDetails");
  $date = $data['selectedDate'] . " " . $data['selectedTime'];
  $dateTime = dateTime($date);
  $movieName = $data['movieTitle'];
  $cinema = $data['cinema'];

  $reservedSeats = $admin->query("SELECT `seat_num` FROM `reservedseats` WHERE movie_name = '$movieName' AND schedule = '$dateTime' AND cinema = '$cinema'");
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../css/bootstrap.min.css" />
    <link rel="stylesheet" href="css/seating.css">
    <link rel="stylesheet" href="../fonts/font-style.css">
    <script src="js/cookieReader.js"></script>
    
    <title>Seating Arrangement </title>
  </head>
  <body>
    <div class="container-fluid nav-color">
      <?php $header ?>
    </div>
    <div class=" d-flex justify-content-center mt-3">
      <ul class="list-group list-group-horizontal-sm">
        <a href="tickets.php" class="text-decoration-none">
          <li class="list-group-item">
            <h1 class="display-6 archerpro">1. Select Tickets</h1>
          </li>
        </a>
        <li class="list-group-item active-item">
          <h1 class="display-6 archerpro">2 Select Seats</h1>
        </li>
        <li class="list-group-item">
          <h1 class="display-6 archerpro">3. Beverages</h1></li>
        <li class="list-group-item">
          <h1 class="display-6 archerpro">4. Payment</h1></li>
        <li class="list-group-item">
          <h1 class="display-6 archerpro">5. Successful</h1>
        </li>
      </ul>
      <?php while($seat = $reservedSeats->fetch_assoc()){?>
        <input type="hidden" class="reserve" value="<?= $seat['seat_num']?>">
        <?php } ?>
    </div>

    <div class="container-fluid">
      <div class="container-fluid d-flex flex-wrap ">
        <div class="container mt-2">
          <div class="row d-flex justify-content-center">
            <div class="col-sm-auto col-7">
              <div
            class="container d-flex justify-content-around mt-2 flex-wrap pb-3"
          >
            <h3 class="text-light roboto-bold">
              <span class="bg-danger text-danger pe-1 ps-2 small">0</span
              >Reserved
            </h3>
            <h3 class="text-light roboto-bold">
              <span class="bg-secondary text-secondary pe-1 ps-2 small">0</span
              >Available
            </h3>
            <h3 class="text-light roboto-bold">
              <span class="bg-warning text-warning pe-1 ps-2 small">0</span
              >Selected
            </h3>
          </div>
              <h1
                class="text-center bg-danger text-light pb-1 w-100 d-none d-md-inline-block roboto-bold"
              >
                Screen 
              </h1>
              <div class="row g-0 d-flex flex-md-row flex-sm-column">
                <!-- col1 -->
                <div class="col-auto text-center">
                  <div
                    class="row justify-content-center d-flex flex-md-row flex-sm-column g-0"
                  >
                    <div
                      class="col-auto d-flex flex-md-column flex-sm-row px-1"
                    >
                      <button
                        type="button"
                        class="btn btn-secondary mb-1 seat rounded-0 roboto-bold"
                      >
                        A9
                      </button>
                      <button type="button" class="btn btn-secondary mb-1 seat roboto-bold">
                        B9
                      </button>
                      <button type="button" class="btn btn-secondary mb-1 seat roboto-bold">
                        C9
                      </button>
                      <button type="button" class="btn btn-secondary mb-1 seat roboto-bold">
                        D9
                      </button>
                      <button
                        type="button"
                        class="btn btn-secondary mb-1 seat rounded-0 roboto-bold"
                      >
                        E9
                      </button>
                    </div>
                    <div
                      class="col-auto d-flex flex-md-column flex-sm-row px-1"
                    >
                      <button
                        type="button"
                        class="btn btn-secondary mb-1 seat rounded-0 roboto-bold"
                      >
                        A8
                      </button>
                      <button type="button" class="btn btn-secondary mb-1 seat roboto-bold">
                        B8
                      </button>
                      <button type="button" class="btn btn-secondary mb-1 seat roboto-bold">
                        C8
                      </button>
                      <button type="button" class="btn btn-secondary mb-1 seat roboto-bold">
                        D8
                      </button>
                      <button
                        type="button"
                        class="btn btn-secondary mb-1 seat rounded-0 roboto-bold"
                      >
                        E8
                      </button>
                    </div>
                  </div>
                </div>

                <!-- col2 -->
                <div class="col-auto text-center mx-md-3">
                  <div
                    class="row justify-content-center d-flex flex-md-row flex-sm-column g-0 my-2"
                  >
                    <div
                      class="col-auto d-flex flex-md-column flex-sm-row px-1"
                    >
                      <button
                        type="button"
                        class="btn btn-secondary mb-1 seat rounded-0 roboto-bold"
                      >
                        A7
                      </button>
                      <button type="button" class="btn btn-secondary mb-1 seat roboto-bold">
                        B7
                      </button>
                      <button type="button" class="btn btn-secondary mb-1 seat roboto-bold">
                        C7
                      </button>
                      <button type="button" class="btn btn-secondary mb-1 seat roboto-bold">
                        D7
                      </button>
                      <button
                        type="button"
                        class="btn btn-secondary mb-1 seat rounded-0 roboto-bold"
                      >
                        E7
                      </button>
                    </div>
                    <div
                      class="col-auto d-flex flex-md-column flex-sm-row px-1"
                    >
                      <button
                        type="button"
                        class="btn btn-secondary mb-1 seat rounded-0 roboto-bold"
                      >
                        A6
                      </button>
                      <button type="button" class="btn btn-secondary mb-1 seat roboto-bold">
                        B6
                      </button>
                      <button type="button" class="btn btn-secondary mb-1 seat roboto-bold">
                        C6
                      </button>
                      <button type="button" class="btn btn-secondary mb-1 seat roboto-bold">
                        D6
                      </button>
                      <button
                        type="button"
                        class="btn btn-secondary mb-1 seat rounded-0 roboto-bold"
                      >
                        E6
                      </button>
                    </div>
                    <div
                      class="col-auto d-flex flex-md-column flex-sm-row px-1"
                    >
                      <button
                        type="button"
                        class="btn btn-secondary mb-1 seat rounded-0 roboto-bold"
                      >
                        A5
                      </button>
                      <button type="button" class="btn btn-secondary mb-1 seat roboto-bold">
                        B5
                      </button>
                      <button type="button" class="btn btn-secondary mb-1 seat roboto-bold">
                        C5
                      </button>
                      <button type="button" class="btn btn-secondary mb-1 seat roboto-bold">
                        D5
                      </button>
                      <button
                        type="button"
                        class="btn btn-secondary mb-1 seat rounded-0 roboto-bold"
                      >
                        E5
                      </button>
                    </div>
                    <div
                      class="col-auto d-flex flex-md-column flex-sm-row px-1"
                    >
                      <button
                        type="button"
                        class="btn btn-secondary mb-1 seat rounded-0 roboto-bold"
                      >
                        A4
                      </button>
                      <button type="button" class="btn btn-secondary mb-1 seat roboto-bold">
                        B4
                      </button>
                      <button type="button" class="btn btn-secondary mb-1 seat roboto-bold">
                        C4
                      </button>
                      <button type="button" class="btn btn-secondary mb-1 seat roboto-bold">
                        D4
                      </button>
                      <button
                        type="button"
                        class="btn btn-secondary mb-1 seat rounded-0 roboto-bold"
                      >
                        E4
                      </button>
                    </div>
                    <div
                      class="col-auto d-flex flex-md-column flex-sm-row px-1"
                    >
                      <button
                        type="button"
                        class="btn btn-secondary mb-1 seat rounded-0 roboto-bold"
                      >
                        A3
                      </button>
                      <button type="button" class="btn btn-secondary mb-1 seat roboto-bold">
                        B3
                      </button>
                      <button type="button" class="btn btn-secondary mb-1 seat roboto-bold">
                        C3
                      </button>
                      <button type="button" class="btn btn-secondary mb-1 seat roboto-bold">
                        D3
                      </button>
                      <button
                        type="button"
                        class="btn btn-secondary mb-1 seat rounded-0 roboto-bold"
                      >
                        E3
                      </button>
                    </div>
                  </div>
                </div>
                <!-- col3 -->
                <div class="col-auto text-center">
                  <div
                    class="row justify-content-center d-flex flex-md-row flex-sm-column g-0"
                  >
                    <div
                      class="col-auto d-flex flex-md-column flex-sm-row px-1"
                    >
                      <button
                        type="button"
                        class="btn btn-secondary mb-1 seat rounded-0 roboto-bold"
                      >
                        A2
                      </button>
                      <button type="button" class="btn btn-secondary mb-1 seat roboto-bold">
                        B2
                      </button>
                      <button type="button" class="btn btn-secondary mb-1 seat roboto-bold">
                        C2
                      </button>
                      <button type="button" class="btn btn-secondary mb-1 seat roboto-bold">
                        D2
                      </button>
                      <button
                        type="button"
                        class="btn btn-secondary mb-1 seat rounded-0 roboto-bold"
                      >
                        E2
                      </button>
                    </div>
                    <div
                      class="col-auto d-flex flex-md-column flex-sm-row px-1"
                    >
                      <button
                        type="button"
                        class="btn btn-secondary mb-1 seat rounded-0 roboto-bold"
                      >
                        A1
                      </button>
                      <button type="button" class="btn btn-secondary mb-1 seat roboto-bold">
                        B1
                      </button>
                      <button type="button" class="btn btn-secondary mb-1 seat roboto-bold">
                        C1
                      </button>
                      <button type="button" class="btn btn-secondary mb-1 seat roboto-bold">
                        D1
                      </button>
                      <button
                        type="button"
                        class="btn btn-secondary mb-1 seat rounded-0 roboto-bold"
                      >
                        E1
                      </button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-auto d-md-none">
              <h1
                class="text-center bg-danger text-light pb-1 d-md-none"
                style="writing-mode: vertical-rl; text-orientation: upright"
              >
                Screen
              </h1>
            </div>
            <div class="col-md-4 col-12">
              <div class="d-flex flex-column basket-color px-0">
                <div class="text-center roboto-bold"><h1>Your Basket</h1></div>
                <div class="seat-section seat-color m-0 p-0 roboto-bold">
                  <h5 class="p-4 text-break" id="movieTicketInfo"><?php echo $data["movieTitle"] . " - ". $data["selectedQuality"]; ?>  *<span id="qty"><?php echo intval($data["ticketQuantity"]) ?>  </span> - <span> <?php echo intval($data["ticketTotal"])  ?></span></h5>
                  <h5 id="selectedSeats" class="p-4 m-0 text-break roboto-bold">Seats:</h5>
                </div>
                <div class="beverage-section beverage-color"></div>
                <div
                  class="cost-section d-flex justify-content-around flex-wrap bg-warning"
                >
                  <h1 class="roboto-bold">Total Cost:</h1>
                  <h1 id="totalBasketCost"><?php echo intval($data["ticketTotal"])  ?></h1>
                </div>
              </div>
            </div>
          </div>
          <div class="d-flex justify-content-end">
            <button class="btn btn-warning roboto-bold" style=
        "background: linear-gradient(
        359deg,
        rgba(255, 154, 0, 1) 0%,
        rgba(255, 115, 0, 1) 50%,
        rgba(255, 77, 0, 1) 100%
        );"
            id="nextBtn">Next</button>
          </div>
        </div>
      </div>
    </div>

    <script src="js/seating.js">
    </script>
    <script>
        
    </script>
  </body>
</html>
