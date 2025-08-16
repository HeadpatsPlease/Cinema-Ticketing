<?php
    include '../../../Cinema-Ticketing/php/connection.php';
    @include '../../../Cinema-Ticketing/php/select.php'; 

session_start();
if (!isset($_SESSION['records'])) {
    $_SESSION['records'] = []; 
}
if (!isset($_SESSION['deleted'])) {
    $_SESSION['deleted'] = false;
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../../css/bootstrap.min.css" />
    <title>View</title>
    <style>
        body {
            background: url(../../images/bg-view.png);
            color: #fff;
            font-family: Arial, sans-serif;
            text-align: center;
        }
        
        .search-form{
            margin-right: 647px;
        }


        input[type="text"] {
            padding: 10px;
            width: 200px;
            border: none;
            background-color: #ccc;
            font-size: 16px;
            margin-bottom: 10px;
        }

        button {
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
        }

        .search-btn {
            background-color: transparent;
            border: 2px solid #fff;
            color: #fff;
        }

        .delete-btn {
            background-color: #007BFF;
            border: none;
            color: white;
        }

        .box {
            background-color: #fff;
            color: #000;
            padding: 30px;
            margin: 20px auto;
            border-radius: 10px;
            height: 50vh;
            overflow-y: auto;
            overflow-x: hidden;
        }


        table {
            margin-top: 20px;
            border-collapse: collapse;
        }

        th, td {
            text-align: center;
            padding: 10px;
        }

        th {
            font-weight: bold;
        }
    </style>
</head>
<body>
<!-- For Search Form -->
<div class="container">
<div class="search-form">
  <form method="post" >
    <input type="text" name="search_ref" placeholder="Enter Movie No." required>
    <button type="submit" name="search" class="search-btn">Search</button>
 </form>
</div>

<!-- For Message Output -->
<div class="messages mt-3">
    <?php if ($search_message): ?><p style="color: lightgreen;"><?= $search_message ?></p><?php endif; ?>
    <?php if ($delete_message): ?><p style="color: red;"><?= $delete_message ?></p><?php endif; ?>
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
            <?php while ($row = $result3->fetch_assoc()){ ?>
        <tr>
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
<form method="post">
    <input type="text" name="delete_ref" placeholder="Enter Movie No." required>
    <button type="submit" name="delete" class="delete-btn">Delete</button>
</form>
</div>

</body>
</html>
