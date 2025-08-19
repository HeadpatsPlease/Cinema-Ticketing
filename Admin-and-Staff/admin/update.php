<?php
    include '../../../Cinema-Ticketing/php/connection.php';
    @include '../../../Cinema-Ticketing/php/select.php'; 
    session_start();
    $movieId = $_SESSION['movie_id'];


    $searched = $conn->query("SELECT * FROM `overview` WHERE id = $movieId");
    $search = $searched->fetch_assoc();
    $searchedGenre = [];
    $searchedQual = [];
    
    $genres = explode(",",$search['genres']);
    for ($i=0; $i < count($genres) ; $i++) { 
            array_push($searchedGenre,$genres[$i]);
    }
    $qualit= explode(",",$search['qualities']);
    for ($i=0; $i < count($qualit) ; $i++) { 
            array_push($searchedQual,$qualit[$i]);
    }


    $searchedLocation = $conn->query("SELECT DISTINCT `location_name` FROM `showtimes` WHERE id = $movieId");
    $searchLocation = [];
    while($row = $searchedLocation->fetch_assoc()){
        array_push($searchLocation,$row['location_name']);
    }




    $searchedTime = $conn->query("SELECT DISTINCT `time` FROM `showtimes` WHERE id = $movieId");
    $searchTime = [];
    while($row = $searchedTime->fetch_assoc()){
        array_push($searchTime,$row['time']);
    }





    $searchedCinema = $conn->query("SELECT DISTINCT `cinema` FROM `moviecinema` WHERE movie_name ='".  $search['movie_name'] ."';");
    $searchCinema = [];
    while($row = $searchedCinema->fetch_assoc()){
        array_push($searchCinema,$row['cinema']);
    }

    $searchedInfo=[
        "name" => $search['movie_name'],
        "desc" => $search['movie_description'],
        "rating" => $search['rating_text'],
        "director" => $search['director'],
        "status" => $search['status'],
        "year" => $search['year'],
        "genre" => $searchedGenre,
        "quality" => $searchedQual,
        "cinema" => $searchCinema,
        "time" => $searchTime,
        "location" => $searchLocation
    ];

    setcookie('info',json_encode($searchedInfo));






    @$target_dir = "../../images/"; // folder in your server
    @$target_file = $target_dir . basename($_FILES["imginput"]["name"]);
    @$movieTitle = $_POST['movie-title'];
    @$movieYear = $_POST['year'];
    @$synopsis = $_POST['synopsis'];
    @$customDir = $_POST['customDirector'];
    @$data = convertCookie("updatingInfo");
    @$ratings = $data['rating'];
    @$stat = $data['status'];
    @$direc = $data['director'];
    @$cin = $data['cinema'];
    @$quali = $data['quality'];
    @$tim = $data['time'];
    @$genr = $data['genre'];
    @$loc = $data['location'];
    @$yearExists = $conn->query("SELECT getYearId('$movieYear')AS yearz");
    @$directorExists = $conn->query("SELECT getDirectorId('$customDir') AS dir");
    $yearCheck = $yearExists->fetch_assoc();
    $directorCheck = $directorExists->fetch_assoc();
    @$customPoster = basename($_FILES['imginput']['name']);
    $currentPoster = $search['movie_poster'];


    

    if($_SERVER["REQUEST_METHOD"] === "POST") {
        if(isset($_POST['back'])){
            header("Location: view.php");
        }



        if(isset($_POST['submit'])){
            if(isset($movieTitle) && isset($movieYear) && isset($synopsis) && isset($_FILES["imginput"]["name"])){
                if(isset($data)){
                    if(!move_uploaded_file($_FILES["imginput"]["tmp_name"], $target_file)){
                        if($yearCheck['yearz'] === null){
                            if($directorCheck['dir'] === null){
                                for ($i = 0; $i < count($ratings); $i++){
                                    $addDirector = $conn->query("INSERT INTO `director`(`director`) VALUES ('$customDir')");
                                    $addYear = $conn->query("INSERT INTO `years`(`year`) VALUES ('$movieYear')");
                                    $start = $conn->query("UPDATE `movies` SET`movie_name`='$movieTitle',`movie_description`='$synopsis',`rating_id`=getRatingId('$ratings[$i]'),`director_id`=getDirectorId('$customDir'),`status_id`= getStatusId('$stat[$i]'),`year_id`=getYearId('$movieYear'),`movie_poster`='$currentPoster' WHERE id = $movieId");
                                    echo "block1";
                                }
                            }else{
                                for ($i = 0; $i < count($ratings); $i++){
                                    $addYear = $conn->query("INSERT INTO `years`(`year`) VALUES ('$movieYear')");
                                    $start = $conn->query("UPDATE `movies` SET`movie_name`='$movieTitle',`movie_description`='$synopsis',`rating_id`=getRatingId('$ratings[$i]'),`director_id`=getDirectorId('$direc[$i]'),`status_id`= getStatusId('$stat[$i]'),`year_id`=getYearId('$movieYear'),`movie_poster`='$currentPoster' WHERE id = $movieId");
                                    echo "block2";
                                }
                            }
                        }else{
                            if($directorCheck['dir'] === null){
                                for ($i = 0; $i < count($ratings); $i++){
                                    $addDirector = $conn->query("INSERT INTO `director`(`director`) VALUES ('$customDir')");
                                    $addYear = $conn->query("INSERT INTO `years`(`year`) VALUES ('$movieYear')");
                                    $start = $conn->query("UPDATE `movies` SET`movie_name`='$movieTitle',`movie_description`='$synopsis',`rating_id`=getRatingId('$ratings[$i]'),`director_id`=getDirectorId('$customDir'),`status_id`= getStatusId('$stat[$i]'),`year_id`=getYearId('$movieYear'),`movie_poster`='$currentPoster' WHERE id = $movieId");
                                    echo "block3";
                                }
                            }
                            else{
                                for ($i = 0; $i < count($ratings); $i++){
                                    $start = $conn->query("UPDATE `movies` SET`movie_name`='$movieTitle',`movie_description`='$synopsis',`rating_id`=getRatingId('$ratings[$i]'),`director_id`=getDirectorId('$direc[$i]'),`status_id`= getStatusId('$stat[$i]'),`year_id`=getYearId('$movieYear'),`movie_poster`='$currentPoster' WHERE id = $movieId");
                                    echo "block4";
                                }
                            }

                        }
                    }else{
                        if($yearCheck['yearz'] === null){
                            if($directorCheck['dir'] === null){
                                for ($i = 0; $i < count($ratings); $i++){
                                    $addDirector = $conn->query("INSERT INTO `director`(`director`) VALUES ('$customDir')");
                                    $addYear = $conn->query("INSERT INTO `years`(`year`) VALUES ('$movieYear')");
                                    $start = $conn->query("UPDATE `movies` SET`movie_name`='$movieTitle',`movie_description`='$synopsis',`rating_id`=getRatingId('$ratings[$i]'),`director_id`=getDirectorId('$customDir'),`status_id`= getStatusId('$stat[$i]'),`year_id`=getYearId('$movieYear'),`movie_poster`='$customPoster' WHERE id = $movieId");
                                    echo "block5";
                                }
                            }else{
                                for ($i = 0; $i < count($ratings); $i++){
                                    $addYear = $conn->query("INSERT INTO `years`(`year`) VALUES ('$movieYear')");
                                    $start = $conn->query("UPDATE `movies` SET`movie_name`='$movieTitle',`movie_description`='$synopsis',`rating_id`=getRatingId('$ratings[$i]'),`director_id`=getDirectorId('$direc[$i]'),`status_id`= getStatusId('$stat[$i]'),`year_id`=getYearId('$movieYear'),`movie_poster`='$customPoster' WHERE id = $movieId");
                                    echo "block6";
                                }
                            }
                        }else{
                            if($directorCheck['dir'] === null){
                                for ($i = 0; $i < count($ratings); $i++){
                                    $addDirector = $conn->query("INSERT INTO `director`(`director`) VALUES ('$customDir')");
                                    $addYear = $conn->query("INSERT INTO `years`(`year`) VALUES ('$movieYear')");
                                    $start = $conn->query("UPDATE `movies` SET`movie_name`='$movieTitle',`movie_description`='$synopsis',`rating_id`=getRatingId('$ratings[$i]'),`director_id`=getDirectorId('$customDir'),`status_id`= getStatusId('$stat[$i]'),`year_id`=getYearId('$movieYear'),`movie_poster`='$customPoster' WHERE id = $movieId");
                                    echo "block7";
                                }
                            }
                            else{
                                for ($i = 0; $i < count($ratings); $i++){
                                    $start = $conn->query("UPDATE `movies` SET`movie_name`='$movieTitle',`movie_description`='$synopsis',`rating_id`=getRatingId('$ratings[$i]'),`director_id`=getDirectorId('$direc[$i]'),`status_id`= getStatusId('$stat[$i]'),`year_id`=getYearId('$movieYear'),`movie_poster`='$customPoster' WHERE id = $movieId");
                                    echo "block8";
                                }
                            }

                        }

                    }
  
                }
            }else{
                $msg = 'Missing input';
            }
        }
    }
    if(@$start){
        echo "block9";
        $deleteTime = $conn->query("DELETE FROM `movietime` WHERE movie_id = getMovieId('$movieTitle') ");
        $deleteQuality = $conn->query("DELETE FROM `quality` WHERE movie_id = getMovieId('$movieTitle') ");
        $deleteGenre = $conn->query("DELETE FROM `moviegenre` WHERE movie_id = getMovieId('$movieTitle') ");
        $deleteLocation = $conn->query("DELETE FROM `movielocation` WHERE movie_id = getMovieId('$movieTitle') ");


        for ($i=0; $i < count($tim) ; $i++) { 
            for ($h=0; $h <count($quali) ; $h++) { 
            $movieTime = $conn->query("CALL insertMovieTime('$movieTitle','$tim[$i]','$quali[$h]','$cin[$i]')");
            }
        }

        foreach($quali as $qu){
            $movieQuality = $conn->query("CALL insertMovieQuality('$movieTitle','$qu')");
        }
        foreach($genr as $gen){
            $movieGenre = $conn->query("CALL insertMovieGenre('$movieTitle','$gen')");
        }
        foreach($loc as $lo){
            $movieLocation = $conn->query("CALL insertMovieLocation('$movieTitle','$lo')");
        }
        if (move_uploaded_file($_FILES["imginput"]["tmp_name"], $target_file)) {
            header("Location: view.php");
        } else {
            header("Location: view.php");
        }


    }



    
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../../css/bootstrap.min.css" />
    <script src="../../cinema_pages/js/cookieReader.js"></script>
    <title>Responsive Movie Form</title>
    <style>
        body{
            background: url(../../images/bg-view.png);
        }
        .rating img {
            width: 100px;
            max-width: 100%;
            height: auto;
            border: 3px solid transparent;
            border-radius: 5px;
            cursor: pointer;
            transition: border-color 0.2s;
        }
        .rating.active img {
            border-color: #fe7308;
        }
        .genre-btn,.time-btn,.quality-btn,.cinema-btn,.director-btn,.status-btn,.location-btn {
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
        <div class="text-center mb-4">
            <img src="../../images/<?= $currentPoster?>"
                alt="Movie Poster" id="poster" class="img-fluid" style="max-width: 300px; border-radius: 10px;">
        </div>

        <form action="update.php" id="main" name="main" method="post" class="mx-auto" enctype="multipart/form-data" style="max-width: 600px;">
            <div class="input-group mb-3">
                <input type="file" class="form-control" id="imginput" name="imginput" accept="image/*">
                <label class="input-group-text" for="imginput">Poster</label>
            </div>

            <div class="mb-3">
                <label for="movie-title" class="form-label">Movie Title:</label>
                <input type="text" name="movie-title" id="movie-title" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="year" class="form-label">Year:</label>
                <input type="number" name="year" id="year" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="synopsis" class="form-label">Synopsis:</label>
                <textarea name="synopsis" name="synopsis" id="synopsis" id="synopsis" class="form-control"></textarea>
            </div>


            <div class="mb-3">
                <label class="form-label">MTRCB Rating:</label>
                <div class="row g-3 text-center">
                    <?php while ($row = $rating->fetch_assoc()) { ?>
                    <div class="col-6 col-sm-4 col-md-2 rating" data-info="<?= $row['rating_text'] ?>">
                        <img src="../../images/<?= $row['rating_img']?>" alt="<?= $row['rating_text'] ?>">
                    </div>
                    <?php }?>
                </div>
            </div>

            <div class="mb-3" id="genre">
                <label class="form-label">Genres:</label>
                <div class="d-flex flex-wrap gap-2">
                    <?php while ($row = $genre->fetch_assoc()) { ?>
                    <button type="button" class="genre-btn"><?= $row['genre_name']?></button>
                    <?php }?>
                </div>
            </div>
            <div class="mb-3" id="time">
                <label class="form-label">Time:</label>
                <div class="d-flex flex-wrap gap-2">
                    <?php while ($row = $time->fetch_assoc()) { ?>
                    <button type="button" class="time-btn"><?= $row['time']?></button>
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
            <div class="mb-3" id="cinema">
                <label class="form-label">Cinema Room:</label>
                <div class="d-flex flex-wrap gap-2">
                    <?php while ($row = $cinema->fetch_assoc()) { ?>
                    <button type="button" class="cinema-btn"><?= $row['cinema']?></button>
                    <?php }?>
                </div>
            </div>
            <div class="mb-3" id="location">
                <label class="form-label">Location:</label>
                <div class="d-flex flex-wrap gap-2">
                    <?php while ($row = $location->fetch_assoc()) { ?>
                    <button type="button" class="location-btn"><?= $row['location_name']?></button>
                    <?php }?>
                </div>
            </div>
            <div class="mb-3" id="director">
                <label class="form-label">Director:</label>
                <div class="d-flex flex-wrap gap-2">
                    <div class="input-group input-group-sm mb-3">
                        <span class="input-group-text" id="inputGroup-sizing-sm">Custom Director</span>
                        <input type="text" name="customDirector" id="customDirector" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
                    </div>
                    <?php while ($row = $director->fetch_assoc()) { ?>
                    <button type="button" class="director-btn"><?= $row['director']?></button>
                    <?php }?>
                </div>
            </div>
            <div class="mb-3" id="status">
                <label class="form-label">Status:</label>
                <div class="d-flex flex-wrap gap-2">
                    <?php while ($row = $status->fetch_assoc()) { ?>
                    <button type="button" class="status-btn"><?= $row['status']?></button>
                    <?php }?>
                </div>
            </div>
        </form>
    </div>

    <script src="update.js">   
    </script>
</body>

</html>
