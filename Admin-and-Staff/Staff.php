<?php
session_start();
if (!isset($_SESSION['email']) || !isset($_SESSION['pswd'])) {
  header("Location: ../AccountsPage/login.php");
}
if (isset($_POST['logout'])) {
  session_destroy();
  header("Location: /Cinema-Ticketing/AccountsPage/login.php");
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="../css/bootstrap.min.css" />
  <title>Staff</title>
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
  <div class="container d-flex flex-column justify-content-center  text-light" style="height: 100vh">
    <div class="w-25 mb-5">
      <form method="post">
        <button class="btn btn-danger w-25" name=logout>Logout</button>
      </form>
    </div>
    <h1 class="roboto-bold mb-4 text-center">Welcome to POP CINEMA</h1>

    <div class="d-flex justify-content-center ">
      <div class="d-flex gap-3 justify-content-center">
        <div class="mx-4">

          <a href="ticket-scan.php">
            <button class="qr-scan" type="submit" name="qr-scan" class="btn btn-lg roboto-bold text-light">
              QR SCAN
            </button>
          </a>
        </div>
      </div>

      <div class="mx-4">

        <a href="walk-in.php">
          <button class="walk-in" type="submit" name="walk-in" class="btn  btn-lg roboto-bold text-light">
          WALK-IN
        </button>
        </a>

      </div>
    </div>
  </div>
</body>

</html>