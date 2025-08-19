<?php
    include '../../Cinema-Ticketing/php/connection.php';
    @include '../../Cinema-Ticketing/php/select.php'; 

    @$data = convertCookie(cookieName: "selectedInfo");
    @$movieQu = $data['quality'];
    @$movieNa = $data['movies'];
    @$movieRef = $data['reference'];
    @$cinem = $data['cine'];
    @$moviePri = $data['price'];

    

    if (isset($_POST['submit'])) {
        for ($i=0; $i < count($movieNa) ; $i++) { 
            $submit = $admin->query("INSERT INTO `tickets`(`movie_id`, `quality_id`, `cinema_id`, `reference_number`, `totalCost`, `schedule`, `status`) VALUES (getMovie('$movieNa[$i]'),getQuality('$movieQu[$i]'),getCinema('$cinem[$i]'),'$movieRef','$moviePri',NOW(),1)");
        }
    }
    if (isset($_POST['back'])) {
        header("Location: Staff.php");
    }
    if (isset($_POST['checkseats'])) {
    header("Location: checkseats.php");
    # code...
    }


    
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../css/bootstrap.min.css" />
    <script src="../cinema_pages/js/cookieReader.js"></script>
    <title>Walk in</title>
    <style>
        body{
            background: url(../images/bg-view.png);
        }
        .movies img {
            width: 70%;
            border: 3px solid transparent;
            border-radius: 5px;
            cursor: pointer;
            transition: border-color 0.2s;
        }
        .movies.active img {
            border-color: #fe7308;
        }
        .movies-btn,.beverage-btn,.quality-btn,.cinema-btn,.director-btn,.status-btn,.location-btn,.btn-b {
            min-width: 100px;
            padding: 6px 12px;
            border-radius: 15px;
            color: #fe7308;
            background-color: black;
            border: 2px solid #fe7308;
            transition: all 0.2s;
        }
        .genre-btn.active,.time-btn.active,.quality-btn.active,.cinema-btn.active,.director-btn.active,.status-btn.active,.location-btn.active {
            background-color: #fe7308;
            color: white;
        }
        .form-label {
            color: #7e7e7e;
        }
    </style>
</head>

<body class="bg-dark">
    
    <div class="container py-4">
        <div class="d-flex flex-row justify-content-between">
            <button class="btn btn-success" form="main" name="back">Back</button>
            <button class="btn btn-primary" id="next" form="main" name="submit">Submit</button>
        </div>

        <h1 id="ref" class="text-light"></h1>

        <form action="walk-in.php" id="main" name="main" method="post" class="mx-auto" enctype="multipart/form-data">
            <div class="mb-3">
                <label class="form-label">Now Showing Movies:</label>
                <div class="row text-center">
                    <?php while ($row = $result->fetch_assoc()) { ?>
                    <div class="col-4 movies" data-info="<?= $row['movie_name'] ?>">
                        <img src="../images/<?= $row['movie_poster']?>" alt="<?= $row['movie_name'] ?>">
                    </div>
                    <?php }?>
                </div>
            </div>
            <div class="mb-3" id="quality">
                <label class="form-label">Quality:</label>
                <div class="d-flex flex-wrap gap-2">
                    <?php while ($row = $quality->fetch_assoc()) { ?>
                    <button type="button" class="quality-btn"><?= $row['available_quality']?></button>
                    <?php }?>
                </div>
            </div>
            <div class="mb-3" id="time">
                <label class="form-label">Ticket Quantity:</label>
                <div class="w-25 d-flex align-items-center ">
                    <button type="button" id="minus" class="btn-b">-</button>
                    <p class="m-0 text-light p-4" id="qty">1</p>
                    <button type="button" id="add" class="btn-b">+</button>
                </div>
            </div>
            <div class="mb-3" id="quality">
                <label class="form-label">Cinema Room:</label>
                <div class="d-flex flex-wrap gap-2">
                    <?php while ($row = $cinema->fetch_assoc()) { ?>
                    <button type="button" class="cinema-btn"><?= $row['cinema']?></button>
                    <?php }?>
                </div>
            </div>
        </form>
        <form  method="post">
     <button name="checkseats" class="btn btn-success">
        Check Available Seats
    </button>
   </form>
    </div>

    <script src="walkin.js">   
    </script>
</body>

</html>
