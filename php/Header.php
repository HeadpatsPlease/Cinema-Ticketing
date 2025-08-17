<?php 
  $image_filename = rawurlencode('New Project 11 [9018C77].png');

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../css/bootstrap.min.css" />
    <link rel="stylesheet" href="../style.css" />
    <link rel="stylesheet" href="../fonts/font-style.css">
    <title>Document</title>
</head>
<body>
    <div class="container-fluid nav-color">
        <ul class="nav d-flex align-items-center">
          <div class="flex-grow-1">
            <img
              src="/Cinema-Ticketing/images/<?php echo $image_filename; ?>"
              class="img-fluid"
              style="width: 130px"
              alt="Logo"
            />
          </div>
          <li class="nav-item">
            <a class="nav-link text-light" href="/Cinema-Ticketing/index.php"
              ><h1 class="display-6 roboto-slab-regular">Movies</h1></a
            >
          </li>
          <li class="nav-item">
            <a class="nav-link text-light" href="/Cinema-Ticketing/cinema_pages/cinemas.php"
              ><h1 class="display-6 roboto-slab-regular">Cinemas</h1></a
            >
          </li>
          <li class="nav-item">
            <a class="nav-link text-light" href="#footer"
              ><h1 class="display-6 roboto-slab-regular">About Us</h1></a
            >
          </li>
        </ul>
      </div>
</body>
</html>