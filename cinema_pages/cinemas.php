<?php 
  include '../../Cinema-Ticketing/php/connection.php';
  @include '../../Cinema-Ticketing/php/select.php';
  $header = include '../../Cinema-Ticketing/php/Header.php';
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../css/bootstrap.min.css" />
    <link rel="stylesheet" href="../cinema_pages/css/cinemas.css" />
    <link rel="stylesheet" href="../Cinema-Ticketing/fonts/font-style.css">
    <script src="../cinema_pages/js/cookieReader.js"></script>
    <title>Cinemas</title>
  </head>
  <body>
    <header>
      <?php $header?>
    </header>

    <div class="container-fluid mt-4">
      <div class="border-top border-secondary border-5" id="popCenterDasma">
        <div class="container d-flex align-items-center justify-content-between">
          <div class="text-light" id="popCenterName">
            <h1 class="roboto-bold">Pop Center Dasmarinas</h1>
            <p class="roboto-slab-regular">2D, Director's Club, IMAX</p>
            <p class="roboto-slab-regular">Brgy.Sampalok 1 - Dasmarinas Cavite</p>
          </div>
          <div class="roboto-slab-regular" id="whatplayButton">
            <h5 class="roboto-slab-regular"
              style="color: #ffc100"
              data-bs-toggle="collapse"
              data-bs-target="#dasmaMovies"
              role="button"
            >
              See What's Playing
            </h5>
          </div>
        </div>

        <div class="collapse container" id="dasmaMovies">
          <h1 class="text-light roboto-bold">
            <span style="color: #ff7400"
              >Pop Center Dasmarinas</span
            >
            SHOW TIMES
          </h1>
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
              <h1 class="m-0 roboto-slab-regular"><?= $dasmarow['movie_name'] ?></h1>
              <p class="roboto-slab-regular">2D, Director's Club, IMAX</p>
              <?php
               echo '<p class="twodDate roboto-slab-regular" style="color: #888888"  id="twodDate">Date Here</p>'
              ?>
              <p>
                <span class="archerpro" id="2d"> 2D </span> 
                <?php 
                 $dasmamovie = $dasmarow['movie_name'];
                 $dasmatime = $conn->query("SELECT time FROM `showtimes` WHERE available_quality = '2D' AND location_name = 'dasmarinas' AND movie_name = '$dasmamovie' ORDER BY FIELD(time, '9:00 AM', '10:00 AM', '11:00 AM','12:00 PM','1:00 PM', '2:00 PM', '3:00 PM', '4:00 PM', '5:00 PM');");
                 while ($dasmarow2 = $dasmatime->fetch_assoc()) { 
                ?>
                <button class="availTime p-1 roboto-bold" onclick="getSelectedTime(this.id,'twodDate','2d','<?= $dasmarow['movie_name'] ?>','Pop Center Dasmarinas')" id="<?php echo str_replace(' ','_',$dasmarow2['time']) ?>"><?php echo $dasmarow2['time'] ?></button>
                <?php } ?>
              </p>
              <?php
               echo '<p class="dcDate roboto-slab-regular" style="color: #888888" id="dcDate">Date Here</p>'
              ?>
              <p>
                <span class="roboto-regular" id="directorClub">Director's Club</span>
                <?php 
                 $dasmatime2 = $conn->query("SELECT time FROM `showtimes` WHERE available_quality = 'Directors Club' AND location_name = 'dasmarinas' AND movie_name = '$dasmamovie' ORDER BY FIELD(time, '9:00 AM', '10:00 AM', '11:00 AM','12:00 PM','1:00 PM', '2:00 PM', '3:00 PM', '4:00 PM', '5:00 PM');");
                 while ($dasmarow3 = $dasmatime2->fetch_assoc()) { 
                ?>
                <button class="availTime p-1 roboto-bold" onclick="getSelectedTime(this.id,'dcDate','directorClub','<?= $dasmarow['movie_name'] ?>','Pop Center Dasmarinas')" id="<?php echo str_replace(' ','_',$dasmarow3['time']) ?>"><?php echo $dasmarow3['time'] ?></button>
                <?php } ?>
              </p>
              <?php
               echo '<p class="imaxDate roboto-slab-regular" style="color: #888888" id="imaxDate">Date Here</p>'
              ?>
              <p>
                <span class="roboto-regular" id="imax">IMAX</span>
                <?php 
                 $dasmatime3 = $conn->query("SELECT time FROM `showtimes` WHERE available_quality = 'IMAX' AND location_name = 'dasmarinas' AND movie_name = '$dasmamovie' ORDER BY FIELD(time, '9:00 AM', '10:00 AM', '11:00 AM','12:00 PM','1:00 PM', '2:00 PM', '3:00 PM', '4:00 PM', '5:00 PM');");
                 while ($dasmarow3 = $dasmatime3->fetch_assoc()) { 
                ?>
                <button class="availTime p-1 roboto-bold" onclick="getSelectedTime(this.id,'imaxDate','imax','<?= $dasmarow['movie_name'] ?>','Pop Center Dasmarinas')" id="<?php echo str_replace(' ','_',$dasmarow3['time']) ?>"><?php echo $dasmarow3['time'] ?></button>
                <?php } ?>
              </p>
            </div>
          </div>
          <?php  
          } ?>
          
        </div>
      </div>

      <div class="border-top border-secondary border-5" id="popCenterBatangas">
        <div
          class="container d-flex align-items-center justify-content-between"
        >
          <div class="text-light" id="popCenterName">
            <h1 class="roboto-bold">Pop Center Batangas</h1>
            <p class="roboto-slab-regular">2D, Director's Club, IMAX</p>
            <p class="roboto-slab-regular">Brgy.Pallocan Kanluran - Batangas City</p>
          </div>
          <div class="roboto-slab-regular" id="whatplayButton">
            <h5 
            style="color: #ffc100"
            data-bs-toggle="collapse"
            data-bs-target="#batangasMovies"
            role="button">See What's Playing</h5>
          </div>
        </div>

        <div class="collapse container" id="batangasMovies">
          <h1 class="text-light roboto-bold">
            <span style="color: #ff7400"
              >Pop Center Batangas</span
            >
            SHOW TIMES
          </h1>
          <?php 
          while ($batangasrow = $batangasresult->fetch_assoc()) {
            ?>
            <div
            class="border-top border-secondary border-5 d-flex align-items-start"
            id="<?= $batangasrow['movie_name'] ?>">
            <img
              src="../images/<?= $batangasrow['movie_poster'] ?>"
              style="width: 15%"
              class="me-2 mt-2"
              alt=""
            />
            <div class="text-light" id="popCenterName">
              <h1 class="m-0 roboto-slab-regular"><?= $batangasrow['movie_name'] ?></h1>
              <p class="roboto-slab-regular">2D, Director's Club, IMAX</p>
              <?php
               echo '<p class="twodDate roboto-slab-regular" style="color: #888888" id="twodDate">Date Here</p>'
              ?>
              <p>
                <span class="archerpro" id="2d"> 2D </span> 
                <?php 
                 $batangasmovie = $batangasrow['movie_name'];
                 $batangastime = $conn->query("SELECT time FROM `showtimes` WHERE available_quality = '2D' AND location_name = 'batangas' AND movie_name = '$batangasmovie' ORDER BY FIELD(time, '9:00 AM', '10:00 AM', '11:00 AM','12:00 PM','1:00 PM', '2:00 PM', '3:00 PM', '4:00 PM', '5:00 PM');");
                 while ($batangasrow2 = $batangastime->fetch_assoc()) { 
                ?>
                <button class="availTime p-1 roboto-bold" onclick="getSelectedTime(this.id,'twodDate','2d','<?= $batangasrow['movie_name'] ?>','Pop Center Batangas')" id="<?php echo str_replace(' ','_',$batangasrow2['time']) ?>"><?php echo $batangasrow2['time'] ?></button>
                <?php } ?>
              </p>
              <?php
               echo '<p class="dcDate roboto-slab-regular" style="color: #888888" id="dcDate">Date Here</p>'
              ?>
              <p>
                <span class="roboto-regular" id="directorClub">Director's Club</span>
                <?php 
                 $batangastime2 = $conn->query("SELECT time FROM `showtimes` WHERE available_quality = 'Directors Club' AND location_name = 'batangas' AND movie_name = '$batangasmovie' ORDER BY FIELD(time, '9:00 AM', '10:00 AM', '11:00 AM','12:00 PM','1:00 PM', '2:00 PM', '3:00 PM', '4:00 PM', '5:00 PM');");
                 while ($batangasrow3 = $batangastime2->fetch_assoc()) { 
                ?>
                <button class="availTime p-1 roboto-bold" onclick="getSelectedTime(this.id,'dcDate','directorClub','<?= $batangasrow['movie_name'] ?>','Pop Center Batangas')" id="<?php echo str_replace(' ','_',$batangasrow3['time']) ?>"><?php echo $batangasrow3['time'] ?></button>
                <?php } ?>
              </p>
              <?php
               echo '<p class="imaxDate roboto-slab-regular" style="color: #888888" id="imaxDate">Date Here</p>'
              ?>
              <p>
                <span class="roboto-regular" id="imax">IMAX</span>
                <?php 
                 $batangastime3 = $conn->query("SELECT time FROM `showtimes` WHERE available_quality = 'IMAX' AND location_name = 'batangas' AND movie_name = '$batangasmovie' ORDER BY FIELD(time, '9:00 AM', '10:00 AM', '11:00 AM','12:00 PM','1:00 PM', '2:00 PM', '3:00 PM', '4:00 PM', '5:00 PM');");
                 while ($batangasrow3 = $batangastime3->fetch_assoc()) { 
                ?>
                <button class="availTime p-1 roboto-bold" onclick="getSelectedTime(this.id,'imaxDate','imax','<?= $batangasrow['movie_name'] ?>','Pop Center Batangas')" id="<?php echo str_replace(' ','_',$batangasrow3['time']) ?>"><?php echo $batangasrow3['time'] ?></button>
                <?php } ?>
              </p>
            </div>
          </div>
          <?php  
          } ?>
          
        </div>
      </div>

      <div class="border-top border-secondary border-5" id="popCenterMoa">
        <div
          class="container d-flex align-items-center justify-content-between"
        >
          <div class="text-light" id="popCenterName">
            <h1 class="roboto-bold">Pop Center Mall Of Asia</h1>
            <p class="roboto-slab-regular">2D, Director's Club, IMAX</p>
            <p class="roboto-slab-regular">JW Diokno Blvd CBP-IA - Pasay City</p>
          </div>
          <div class="roboto-slab-regular" id="whatplayButton">
            <h5 style="color: #ffc100"
            data-bs-toggle="collapse"
            data-bs-target="#moaMovies"
            role="button"
            >
            See What's Playing</h5>
          </div>
        </div>
      </div>
      <div class="collapse container" id="moaMovies">
          <h1 class="text-light roboto-bold">
            <span style="color: #ff7400"
              >Pop Center Mall Of Asia</span
            >
            SHOW TIMES
          </h1>
          <?php 
          while ($moarow = $moaresult->fetch_assoc()) {
            ?>
            <div
            class="border-top border-secondary border-5 d-flex align-items-start"
            id="<?= $moarow['movie_name'] ?>">
            <img
              src="../images/<?= $moarow['movie_poster'] ?>"
              style="width: 15%"
              class="me-2 mt-2"
              alt=""
            />
            <div class="text-light" id="popCenterName">
              <h1 class="m-0 roboto-slab-regular"><?= $moarow['movie_name'] ?></h1>
              <p class="roboto-slab-regular">2D, Director's Club, IMAX</p>
              <?php
               echo '<p class="twodDate roboto-slab-regular" id="twodDate">Date Here</p>'
              ?>
              <p>
                <span class="archerpro" id="2d"> 2D </span> 
                <?php 
                 $moamovie = $moarow['movie_name'];
                 $moatime = $conn->query("SELECT time FROM `showtimes` WHERE available_quality = '2D' AND location_name = 'mall of asia' AND movie_name = '$moamovie' ORDER BY FIELD(time, '9:00 AM', '10:00 AM', '11:00 AM','12:00 PM','1:00 PM', '2:00 PM', '3:00 PM', '4:00 PM', '5:00 PM');");
                 while ($moarow2 = $moatime->fetch_assoc()) { 
                ?>
                <button class="availTime p-1 roboto-bold" onclick="getSelectedTime(this.id,'twodDate','2d','<?= $moarow['movie_name'] ?>','Pop Center Mall Of Asia')" id="<?php echo str_replace(' ','_',$moarow2['time']) ?>"><?php echo $moarow2['time'] ?></button>
                <?php } ?>
              </p>
              <?php
               echo '<p class="dcDate roboto-slab-regular" style="color: #888888" id="dcDate">Date Here</p>'
              ?>
              <p>
                <span class="roboto-regular" id="directorClub">Director's Club</span>
                <?php 
                 $moatime2 = $conn->query("SELECT time FROM `showtimes` WHERE available_quality = 'Directors Club' AND location_name = 'mall of asia' AND movie_name = '$moamovie' ORDER BY FIELD(time, '9:00 AM', '10:00 AM', '11:00 AM','12:00 PM','1:00 PM', '2:00 PM', '3:00 PM', '4:00 PM', '5:00 PM');");
                 while ($moarow3 = $moatime2->fetch_assoc()) { 
                ?>
                <button class="availTime p-1 roboto-bold" onclick="getSelectedTime(this.id,'dcDate','directorClub','<?= $moarow['movie_name'] ?>','Pop Center Mall Of Asia')" id="<?php echo str_replace(' ','_',$moarow3['time']) ?>"><?php echo $moarow3['time'] ?></button>
                <?php } ?>
              </p>
              <?php
               echo '<p class="imaxDate roboto-slab-regular" style="color: #888888" id="imaxDate">Date Here</p>'
              ?>
              <p>
                <span class="roboto-regular"  id="imax">IMAX</span>
                <?php 
                 $moatime3 = $conn->query("SELECT time FROM `showtimes` WHERE available_quality = 'IMAX' AND location_name = 'mall of asia' AND movie_name = '$batangasmovie' ORDER BY FIELD(time, '9:00 AM', '10:00 AM', '11:00 AM','12:00 PM','1:00 PM', '2:00 PM', '3:00 PM', '4:00 PM', '5:00 PM');");
                 while ($moarow3 = $batangastime3->fetch_assoc()) { 
                ?>
                <button class="availTime p-1 roboto-bold" onclick="getSelectedTime(this.id,'imaxDate','imax','<?= $moarow['movie_name'] ?>','Pop Center Mall Of Asia')" id="<?php echo str_replace(' ','_',$moarow3['time']) ?>"><?php echo $moarow3['time'] ?></button>
                <?php } ?>
              </p>
            </div>
          </div>
          <?php  
          } ?>
          
        </div>
    </div>

    <script src="../js/bootstrap.bundle.min.js"></script>
    <script src="js/cinemas.js"></script>
  </body>
</html>
