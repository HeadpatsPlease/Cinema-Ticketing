<?php 
  @include '../../php/connection.php';
  $value = $_COOKIE['movietitle'];
  $header = include '../../php/Header.php';
  $overview = $conn->query("SELECT * FROM `overview` WHERE movie_name = '$value' ");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/bootstrap.min.css">
    <link rel="stylesheet" href="overview.css">
    <link rel="stylesheet" href="../../fonts/font-style.css">
    <title>Pop Cinema</title>
</head>

<body>
    <header>
        <?php
        $header;
        ?>
    </header>

      <!-- Movie Details Section -->
  <div class="container">
    <div class="row d-flex movie-details align-items-start g-0 align-items-center">

      <!-- Movie Poster -->
      <?php 
      while ($row = $overview->fetch_assoc()) {
      ?>

      <div class="col-md-4 col-12 movie-card card">
        <img src="../../images/<?= $row['movie_poster'] ?>" class="card-img-top" style="object-fit: cover;" alt="Rewrite our Stars Poster">
        <div class="movie-title pt-3 card-body roboto-slab-regular"><?= $row['movie_name'] ?> (<?= $row['year'] ?>)</div>
      </div>

      <!-- Movie Info -->
      <div class="col-md-6 col-12 text-light mt-5 mx-5 mt-2 card-body">
        <p class="info-label roboto-slab-regular">SYNOPSIS:</p>
        <p class="text-break roboto-slab-regular">
          <?= $row['movie_description'] ?>
        </p>

        <p><span class="info-label roboto-slab-regular">MTRCB Rating:</span> <img
          src="../../images/<?= $row['rating_img'] ?>"
          class="img-fluid pb-1"
          width="30"
          height="4">
        </p>
        <p class="roboto-slab-regular"><span class="info-label ">Genre:</span> <?= $row['genres'] ?></p>
        <p class="roboto-slab-regular"><span class="info-label ">Director:</span> <?= $row['director'] ?></p>
        <p class="roboto-slab-regular"><span class="info-label ">Available in:</span> <?= $row['qualities'] ?></p>

        <?php 
          if($row['status'] == "Now Showing"){
            echo '<button class="btn btn-buy mt-3 barlowcondensed-semibold" style="background-color: #d8001a" id="nowShowing" onclick="nextPage()">
          <img
                src="../../images/buy ticket icon.png"
                class="img-fluid pb-1"
                width="20"
                height="4">
           BUY TICKETS
          </button>';
          } else{
            echo '
            <button class="btn btn-buy mt-3 barlowcondensed-semibold" id="comingSoon" style="background-color:#444444;">
             COMING SOON
            </button>';
          }
        ?>
          
            
      </div>
      <?php } ?>

    </div>
  </div>


  <script>
    function nextPage() {
      window.location.href =
        "../showtimes.php";
    }
  </script>
</body>
</html>