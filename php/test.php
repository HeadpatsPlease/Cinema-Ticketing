<?php
include 'connection.php';
$result = $conn->query("SELECT * FROM `overview` WHERE status = 'Now Showing' ");

?> 

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <title>Document</title>
</head>
<body>
    <h1>This is a Top</h1>
    <?php 
    while ($row = $result->fetch_assoc()) {
    ?>
    <div class="card w-50">
        <img src="../images/<?= $row['movie_poster'] ?>" class="card-img-top img-fluid" alt="Poster">
        <div class="card-body">
            <h5 class="card-title"><?= $row['movie_name'] ?></h5>
            <p class="card-text"><?= $row['movie_description'] ?></p>
        </div>
    </div>
    <?php
}
    
    ?>

    <h1>This is a bottom</h1>
    
</body>
</html>