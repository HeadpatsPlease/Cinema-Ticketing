<?php
    include '../../../Cinema-Ticketing/php/connection.php';
    @include '../../../Cinema-Ticketing/php/select.php'; 
    $searched = $admin->query("SELECT * FROM `ticketview`");
    $msg = '';
    session_start();

    if(isset($_POST['search'])){
        if(isset($_POST['searchInput'])){
            try{
                $searchInput = str_replace("00","",$_POST['searchInput']);
                $searched = $admin->query("SELECT * FROM `ticketview` WHERE id = $searchInput");
            }catch(mysqli_sql_exception){
                $searched = $admin->query("SELECT * FROM `ticketview`");
            }
        }
    }
    if(isset($_POST['delete'])){
        if(isset($_POST['delete_ref'])){
            try{
                $searchInput = str_replace("00","",$_POST['delete_ref']);
                $Deleted = $admin->query("DELETE FROM tickets WHERE `tickets`.`id` = $searchInput");
                $searched = $admin->query("SELECT * FROM `ticketview`");
            }catch(mysqli_sql_exception){
                $searched = $admin->query("SELECT * FROM `ticketview`");
            }
        }
    }
    if(isset($_POST['refresh'])){
        $searched = $admin->query("SELECT * FROM `ticketview`");
    }
    if(isset($_POST['back'])){
        header("Location: admin.php");
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
        <form method="post" action="viewtickets.php">
            <div class="input-group w-75">
                <button class="btn btn-primary" name="back">Back</button>
                <input type="text" name="searchInput" class="form-control" id="search" placeholder="Enter Movie No.">
                <button type="submit"  name="search" class="search-btn btn">Search</button>
                <button class="search-btn btn" name="refresh">Refresh</button>
            </div>
        </form>
        </div>

        <!-- Display Box -->
        <div class="box">
            <table class="table table-hover">
                <tr>
                    <th>Ticket No.</th>
                    <th>Movie Name</th>
                    <th>Quality</th>
                    <th>Cinema Room</th>
                    <th>Reference No.</th>
                    <th>Total Cost</th>
                    <th>Schedule</th>
                    <th>Status</th>
                </tr>
                    <?php while ($row = $searched->fetch_assoc()){ 
                        @$date = strtotime($row['schedule']);
                        ?>
                        
                <tr onclick="getNumber('00' + <?=$row['id'];?>)">
                    <td>00<?=$row['id'];?></td>
                    <td><?=$row['movie_name'];?></td>
                    <td><?=$row['available_quality'];?></td>
                    <td><?=$row['cinema'];?></td>
                    <td><?=$row['reference_number'];?></td>
                    <td><?=$row['totalCost'];?></td>
                    <td><?=date("F j, Y g:i A", $date);?></td>
                    <td><?=$row['status'];?></td>
                    
                </tr>
                <?php }?>
            </table>
        </div>

        <!-- Delete Form -->
        <div class="d-flex justify-content-center">
            <form method="post" action="viewtickets.php" class="me-3">
                <div class="input-group">
                    <input type="text" name="delete_ref" id="delete" class="form-control" placeholder="Enter Movie No." required>
                    <button type="submit"  name="delete" class="delete-btn">Delete</button>
                </div>
            </form>
        </div>
    </div>

 </div>

<script src="view.js"></script>
</body>
</html>
