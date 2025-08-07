<?php 
  include '../../Cinema-Ticketing/php/connection.php';
  @include '../../Cinema-Ticketing/php/select.php';
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../css/bootstrap.min.css" />
    <link rel="stylesheet" href="../cinema_pages/css/cinemas.css" />
    <title>Show Times</title>
  </head>
  <body>
    <header>
      <div class="container-fluid nav-color">
        <ul class="nav d-flex align-items-center">
          <div class="flex-grow-1">
            <img
              src="../images/New Project 11 [9018C77].png"
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

    <div class="container">
      <?php while ($dasmarow = $dasmaresult->fetch_assoc()) {
            ?>
            <div
            class="border-top border-secondary border-5 d-flex align-items-start"
            id="<?= $dasmarow['movie_name'] ?>">
            <img
              src="../images/<?= $dasmarow['movie_poster'] ?>"
              style="width: 15%"
              class="me-2 mt-2"
              alt=""
            />
            <div class="text-light" id="popCenterName">
              <h1 class="m-0"><?= $dasmarow['movie_name'] ?></h1>
              <p>2D, Director's Club, IMAX</p>
              <?php
               echo '<p class="twodDate">Date Here</p>'
              ?>
              <p>
                2D 
                <?php 
                 $dasmamovie = $dasmarow['movie_name'];
                 $dasmatime = $conn->query("SELECT DISTINCT time FROM `showtimes` WHERE available_quality = '2D' AND movie_name = '$dasmamovie' ORDER BY FIELD(time, '9:00 AM', '10:00 AM', '11:00 AM','12:00 PM','1:00 PM', '2:00 PM', '3:00 PM', '4:00 PM', '5:00 PM');");
                 while ($dasmarow2 = $dasmatime->fetch_assoc()) { 
                ?>
                <button class="availTime p-1"><?php echo $dasmarow2['time'] ?></button>
                <?php } ?>
              </p>
              <?php
               echo '<p class="dcDate">Date Here</p>'
              ?>
              <p>
                Director's Club
                <?php 
                 $dasmatime2 = $conn->query("SELECT DISTINCT time FROM `showtimes` WHERE available_quality = 'Directors Club' AND movie_name = '$dasmamovie' ORDER BY FIELD(time, '9:00 AM', '10:00 AM', '11:00 AM','12:00 PM','1:00 PM', '2:00 PM', '3:00 PM', '4:00 PM', '5:00 PM');");
                 while ($dasmarow3 = $dasmatime2->fetch_assoc()) { 
                ?>
                <button class="availTime p-1"><?php echo $dasmarow3['time'] ?></button>
                <?php } ?>
              </p>
              <?php
               echo '<p class="imaxDate">Date Here</p>'
              ?>
              <p>
                IMAX
                <?php 
                 $dasmatime3 = $conn->query("SELECT DISTINCT time FROM `showtimes` WHERE available_quality = 'IMAX' AND movie_name = '$dasmamovie' ORDER BY FIELD(time, '9:00 AM', '10:00 AM', '11:00 AM','12:00 PM','1:00 PM', '2:00 PM', '3:00 PM', '4:00 PM', '5:00 PM');");
                 while ($dasmarow3 = $dasmatime3->fetch_assoc()) { 
                ?>
                <button class="availTime p-1"><?php echo $dasmarow3['time'] ?></button>
                <?php } ?>
              </p>
            </div>
          </div>
          <?php  
          } ?>
    </div>

    <script src="../js/bootstrap.bundle.min.js"></script>
    <script src="js/cinemas.js"></script>
  </body>
</html>
