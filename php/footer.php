<?php 
  $image_filename = rawurlencode('footericon.png');

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div class="footer-links mb-3 d-flex justify-content-around roboto-slab-regular">
      <a href="/Cinema-Ticketing/index.php">Movies</a>
      <a href="/Cinema-Ticketing/cinema_pages/cinemas.php">Cinema</a>
      <a href="/Cinema-Ticketing/contact-us.php">Contact Us</a>
    </div>
    <div class=" d-flex flex-column align-items-center">
      <div >
          <img src="/Cinema-Ticketing/images/<?php echo $image_filename; ?>" height="60px" alt="footericon" srcset="">
      </div>
      <div class="footer-bottom roboto-slab-regular">
        Copyright &copy; 2025 Pop Cinema | All Rights Reserved.
      </div>
    </div>
</body>
</html>