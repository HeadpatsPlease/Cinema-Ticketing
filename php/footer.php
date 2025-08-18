<?php 
  $image_filename = rawurlencode('footericon.png');

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
      footer {
        background: linear-gradient(
          359deg,
          rgba(255, 154, 0, 1) 0%,
          rgba(255, 115, 0, 1) 50%,
          rgba(255, 77, 0, 1) 100%
        );
        padding: 30px 20px 10px;
        color: white;
      }
      .footer-links a {
        color: white;
        margin: 0 15px;
        text-decoration: none;
        font-weight: 500;
      }
      .footer-bottom {
        margin-top: 10px;
        font-size: 14px;
        color: black;
      }
    </style>
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