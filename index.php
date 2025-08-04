<?php 
  include '../Cinema-Ticketing/php/connection.php';
  include '../Cinema-Ticketing/php/select.php';
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../Cinema-Ticketing/css/bootstrap.min.css" />
    <link rel="stylesheet" href="../Cinema-Ticketing/style.css" />
    <title>Pop Cinema</title>
  </head>

  <body>
    <header>
      <div class="container-fluid nav-color">
        <ul class="nav d-flex align-items-center">
          <div class="flex-grow-1">
            <img
              src="../Cinema-Ticketing/images/New Project 11 [9018C77].png"
              class="img-fluid"
              style="width: 200px"
              alt="Logo"
            />
          </div>
          <li class="nav-item">
            <a class="nav-link text-light" href="#"
              ><h1 class="display-6">Movies</h1></a
            >
          </li>
          <li class="nav-item">
            <a class="nav-link text-light" href="#"
              ><h1 class="display-6">Cinemas</h1></a
            >
          </li>
          <li class="nav-item">
            <a class="nav-link text-light" href="#"
              ><h1 class="display-6">Contact</h1></a
            >
          </li>
        </ul>
      </div>
    </header>

    <div class="tabs px-3">
      <span class="active" id="nowShowingButton">NOW SHOWING</span>
      <span class="" id="comingSoonButton">COMING SOON</span>
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
            <h5 class="card-title" id="<?= $row['movie_name'] ?>">
              <?= $row['movie_name'] ?>
            </h5>
            <button class="btn btn-danger btn-ticket mt-2" id="chooseMovie" onclick="getTitle('<?= trim($row['movie_name']) ?>')">
              <img
                src="images/buy ticket icon.png"
                class="img-fluid pb-1"
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
            <h5 class="card-title" id="<?= $row['movie_name'] ?>">
              <?= $row['movie_name'] ?>
            </h5>
            <button class="btn btn-ticket mt-2" onclick="getTitle('<?= trim($row['movie_name']) ?>')">
              <img
                src="../Cinema-Ticketing/images/buy ticket icon.png"
                class="img-fluid pb-1"
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

    <div class=" row d-flex flex-wrap align justify-content-center g-1" id="comingSoon">
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
            <h5 class="card-title" id="<?= $row['movie_name'] ?>">
              <?= $row['movie_name'] ?>
            </h5>
            <button class="btn btn-danger btn-ticket mt-2" id="chooseMovie" onclick="getTitle('<?= trim($row['movie_name']) ?>')">
              <img
                src="images/buy ticket icon.png"
                class="img-fluid pb-1"
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
            <h5 class="card-title" id="<?= $row['movie_name'] ?>">
              <?= $row['movie_name'] ?>
            </h5>
            <button class="btn btn-ticket mt-2" onclick="getTitle('<?= trim($row['movie_name']) ?>')">
              <img
                src="../Cinema-Ticketing/images/buy ticket icon.png"
                class="img-fluid pb-1"
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

    <!-- Footer -->
  
    <script src="../Cinema-Ticketing/index.js"></script>
  </body>
</html>
