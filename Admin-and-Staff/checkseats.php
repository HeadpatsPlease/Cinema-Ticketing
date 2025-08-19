<?php 
    include '../php/connection.php';
    $movname = $conn->query("SELECT DISTINCT `movie_name` FROM `moviecinema`;");
    $movtime = $conn->query("SELECT DISTINCT `time` FROM `moviecinema`;");
    $cine = $conn->query("SELECT DISTINCT `cinema` FROM `moviecinema` ");
    $submitted = false;
    if (isset($_POST['return'])) {
    header("Location: walk-in.php");
    # code...
    }
           

    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        if(isset($_POST['submit'])){
                @$name = $_POST['name'];
            @$time = $_POST['time'];
            @$cine = $_POST['cine'];
            @$reserved = $admin->query("SELECT `seat_num` FROM `reservedseats` WHERE movie_name = '$name' AND schedule = '$time' AND cinema = '$cine'");
            $submitted = true;
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../cinema_pages/css/seating.css">
    <title>Check Tickets</title>
</head>
<body>
    <form  method="post">
     <button name="return" class="btn btn-success">
        Back
    </button>
   </form>
    
        <div >
            <form action="seat.php"  method="post">
                <div class="mb-3 d-flex">
                    <select class="form-select" id="role" name="name" required>
                        <option value="">--option--</option>
                        <?php while($row = $movname->fetch_assoc()){ ?>
                        <option value="<?= $row['movie_name']?>"><?= $row['movie_name']?></option>
                        <?php }?>
                    </select>
                    <select class="form-select" id="role" name="time" required>
                        <option value="">--option--</option>
                        <?php while($row = $movtime->fetch_assoc()){ ?>
                        <option value="<?= $row['time']?>"><?= $row['time']?></option>
                        <?php }?>
                    </select>
                    <select class="form-select" id="role" name="cine" required>
                        <option value="">--option--</option>
                        <?php while($row = $cine->fetch_assoc()){ ?>
                        <option value="<?= $row['cinema']?>"><?= $row['cinema']?></option>
                        <?php }?>
                    </select>
                    <button type="submit" class="btn btn-primary w-100" name="submit">Submit</button>
                </div>

            </form>
        </div>

        
    

</body>
</html>