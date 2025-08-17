<?php
    include '../../../Cinema-Ticketing/php/connection.php';
    @include '../../../Cinema-Ticketing/php/select.php'; 
    $searched = $conn->query("SELECT * FROM `overview`");
    $msg = '';
    session_start();

    if(isset($_POST['search'])){
        if(isset($_POST['searchInput'])){
            try{
                $searchInput = str_replace("00","",$_POST['searchInput']);
                $searched = $conn->query("SELECT * FROM `overview` WHERE id = $searchInput");
            }catch(mysqli_sql_exception){
                $searched = $conn->query("SELECT * FROM `overview`");
            }
        }
    }
    if(isset($_POST['delete'])){
        if(isset($_POST['delete_ref'])){
            try{
                $searchInput = str_replace("00","",$_POST['delete_ref']);
                $Deleted = $conn->query("DELETE FROM movies WHERE `movies`.`id` = $searchInput");
                $searched = $conn->query("SELECT * FROM `overview`");
            }catch(mysqli_sql_exception){
                $searched = $conn->query("SELECT * FROM `overview`");
            }
        }
    }
    if(isset($_POST['update'])){
        if(isset($_POST['update_ref'])){
            $searchInput = str_replace("00","",$_POST['update_ref']);
            $_SESSION['movie_id'] = $searchInput;
            header("Location: update.php");
        }
    }
    if(isset($_POST['refresh'])){
        $searched = $conn->query("SELECT * FROM `overview`");
    }
    if(isset($_POST['addmovie'])){
        header("Location: inserting_movie.php");
    }


    


?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../../css/bootstrap.min.css" />
    <link rel="stylesheet" href="view.css">
    <title>View</title>
</head>
<body>
<!-- For Search Form -->
 <div class="d-flex flex-column justify-content-center align-items-center" style="min-height: 100vh;">
    <div class="container">
        <div class="search-form">
        <form method="post" action="view.php">
            <div class="input-group w-75">
                <input type="text" name="searchInput" class="form-control" id="search" placeholder="Enter Movie No.">
                <button type="submit"  name="search" class="search-btn btn">Search</button>
                <button class="search-btn btn" name="refresh">Refresh</button>
                <button class="search-btn btn" name="addmovie">Add Movie</button>
            </div>
        </form>
        </div>

        <!-- Display Box -->
        <div class="box">
            <table class="table table-hover">
                <tr>
                    <th>Movie No.</th>
                    <th>Movie Name</th>
                    <th>Movie Rating</th>
                    <th>Director</th>
                    <th>Status</th>
                    <th>Year</th>
                    <th>Genre</th>
                    <th>Quality</th>
                </tr>
                    <?php while ($row = $searched->fetch_assoc()){ ?>
                <tr onclick="getNumber('00' + <?=$row['id'];?>)">
                    <td>00<?=$row['id'];?></td>
                    <td><?=$row['movie_name'];?></td>
                    <td><?=$row['rating_text'];?></td>
                    <td><?=$row['director'];?></td>
                    <td><?=$row['status'];?></td>
                    <td><?=$row['year'];?></td>
                    <td><?=$row['genres'];?></td>
                    <td><?=$row['qualities'];?></td>
                    
                </tr>
                <?php }?>
            </table>
        </div>

        <!-- Delete Form -->
        <div class="d-flex justify-content-center">
            <form method="post" action="view.php" class="me-3">
                <div class="input-group">
                    <input type="text" name="delete_ref" id="delete" class="form-control" placeholder="Enter Movie No." required>
                    <button type="submit"  name="delete" class="delete-btn">Delete</button>
                </div>
            </form>
            <form method="post" action="view.php">
                <div class="input-group">
                    <input type="text" name="update_ref" id="update" class="form-control" placeholder="Enter Movie No." required>
                    <button type="submit"  name="update" class="delete-btn">Update</button>
                </div>
            </form>
        </div>
    </div>

 </div>

<script src="view.js"></script>
</body>
</html>
