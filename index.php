<?php 
  include '../Cinema-Ticketing/php/connection.php';
  include '../Cinema-Ticketing/php/select.php';
  $header = include '../Cinema-Ticketing/php/Header.php';
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../Cinema-Ticketing/css/bootstrap.min.css" />
    <link rel="stylesheet" href="../Cinema-Ticketing/style.css" />
    <link rel="stylesheet" href="../Cinema-Ticketing/fonts/font-style.css">
    <script src="../Cinema-Ticketing/cinema_pages/js/cookieReader.js"></script>
    <title>Pop Cinema</title>
  </head>

  <body>
    <header>
      <?php 
      $header;
      ?>
    </header>

    <div class="tabs px-3">
      <span class="active roboto-regular " id="nowShowingButton">NOW SHOWING</span>
      <span class="roboto-bold" id="comingSoonButton">COMING SOON</span>
    </div>

    <!-- Movie Cards -->
    <div class=" row d-flex flex-wrap align justify-content-center g-1" id="nowShowing">
    <?php 
      while ($row = $result->fetch_assoc()) {
        ?>
        <!-- Big Screen-->
        <div class="col-md-3 col-12 card text-center ms-5 mb-5 d-none d-lg-block">
          <img
            src="../Cinema-Ticketing/images/<?= $row['movie_poster'] ?>"
            class="card-img-top"
            alt="<?= $row['movie_name'] ?>"
          />
          <div class="card-body">
            <h5 class="card-title roboto-slab-regular" id="<?= $row['movie_name'] ?>">
              <?= $row['movie_name'] ?>
            </h5>
            <button class="btn btn-danger btn-ticket mt-2" id="chooseMovie" onclick="getTitle('<?= trim($row['movie_name']) ?>')">
              <img
                src="images/buy ticket icon.png"
                class="img-fluid pb-1 barlowcondensed-semibold"
                width="20"
                height="4"
              />BUY TICKETS
            </button>
          </div>
        </div>

        <!-- Small Screen -->
        <div class=" col-12 card text-center w-75 me-5 ms-5 d-md-none">
          <!--1-->
          <img
            src="../Cinema-Ticketing/images/<?= $row['movie_poster'] ?>"
            class="card-img-top"
            alt="Premonition"
          />
          <div class="card-body">
            <h5 class="card-title roboto-slab-regular" id="<?= $row['movie_name'] ?>">
              <?= $row['movie_name'] ?>
            </h5>
            <button class="btn btn-ticket mt-2" onclick="getTitle('<?= trim($row['movie_name']) ?>')">
              <img
                src="../Cinema-Ticketing/images/buy ticket icon.png"
                class="img-fluid pb-1 barlowcondensed-semibold"
                width="20"
                height="4"
              />BUY TICKETS
            </button>
          </div>
        </div>
        <?php
      }
    ?>
    </div>

    <div class=" row d-flex flex-wrap align justify-content-center g-1 d-none" id="comingSoon">
    <?php 
      while ($row = $result2->fetch_assoc()) {
        ?>
        <!-- Big Screen-->
        <div class="col-md-3 col-12 card text-center ms-5 mb-5 d-none d-lg-block">
          <img
            src="../Cinema-Ticketing/images/<?= $row['movie_poster'] ?>"
            class="card-img-top"
            alt="<?= $row['movie_name'] ?>"
          />
          <div class="card-body">
            <h5 class="card-title roboto-slab-regular" id="<?= $row['movie_name'] ?>">
              <?= $row['movie_name'] ?>
            </h5>
            <button class="btn btn-ticket-soon mt-2 barlowcondensed-semibold" id="chooseMovie" onclick="getTitle('<?= trim($row['movie_name']) ?>')">
              Overview
            </button>
          </div>
        </div>

        <!-- Small Screen -->
        <div class=" col-12 card text-center w-75 me-5 ms-5 d-md-none">
          <!--1-->
          <img
            src="../Cinema-Ticketing/images/<?= $row['movie_poster'] ?>"
            class="card-img-top"
            alt="Premonition"
          />
          <div class="card-body">
            <h5 class="card-title roboto-slab-regular" id="<?= $row['movie_name'] ?>">
              <?= $row['movie_name'] ?>
            </h5>
            <button class="btn btn-ticket-soon mt-2 barlowcondensed-semibold" id="chooseMovie" onclick="getTitle('<?= trim($row['movie_name']) ?>')">
              Overview
            </button>
          </div>
        </div>
        <?php
      }
    ?>
    </div>

    <!-- Footer -->
    <footer>
    <div class="footer-links mb-3 d-flex justify-content-around roboto-slab-regular">
      <a href="#">Movies</a>
      <a href="#">Cinema</a>
      <a href="#">Terms & Conditions</a>
      <a href="#">Contact Us</a>
    </div>
    <div class=" d-flex flex-column align-items-center">
      <div >
          <img src="../Cinema-Ticketing/images/footericon.png" height="60px" alt="footericon" srcset="">
      </div>
      <div class="footer-bottom roboto-slab-regular">
        Copyright &copy; 2025 Pop Cinema | All Rights Reserved.
      </div>
    </div>
  </footer>
  
    <script src="../Cinema-Ticketing/index.js"></script>
  </body>
</html>
