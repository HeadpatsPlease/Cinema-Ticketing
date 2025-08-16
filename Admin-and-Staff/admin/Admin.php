<?php 
  session_start();
  if(!isset($_SESSION['email']) || !isset($_SESSION['pswd'])){
    header("Location: ../AccountsPage/login.php");
  }
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../../css/bootstrap.min.css" />
    <title>Document</title>
    <style>
      .qr-scan {
        background-color: orange;
        border: 10px solid yellow;
        color: white;
        padding: 15px 40px;
        font-size: 2.5rem;
        border-radius: 5px;
      }
      .walk-in {
        background-color: orange;
        border: 10px solid yellow;
        color: white;
        padding: 15px 40px;
        font-size: 2.5rem;
        border-radius: 5px;
      }
    </style>
  </head>
  <body class="bg-dark">
    <div
      class="container d-flex flex-column justify-content-center text-light"
      style="height: 100vh"
    >
      <h1 class="mb-4 roboto-bold text-center">Welcome to POP CINEMA Admin</h1>

      <div class="d-flex gap-3 justify-content-center">
        <div class="mx-4">
          <button
            class="qr-scan"
            type="submit"
            name="qr-scan"
            class="btn btn-lg roboto-bold text-light"
          >
            Tickets
          </button>
        </div>
        <div class="mx-4">
          <a href="inserting_movie.php">
            <button
            class="walk-in"
            type="submit"
            name="walk-in"
            class="btn btn-lg roboto-bold text-light"
          >
            Movies
          </button>
          </a>
        </div>
      </div>
    </div>
  </body>
</html>
