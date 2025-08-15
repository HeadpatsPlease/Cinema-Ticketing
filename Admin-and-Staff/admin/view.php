<?php

session_start();

$record = [
    "ref_no" => "133",
    "custom_no" => "C003",
    "beverage" => "kiwkiw",
    "movie" => "elims ni kerry",
    "seats" => "A5, C1" // sample data lang to boi!

    // Need dito ay connection dapat sa database!!
];

// Initialize session data
if (!isset($_SESSION['records'])) {
    $_SESSION['records'] = []; // Stores all searched results
}
if (!isset($_SESSION['deleted'])) {
    $_SESSION['deleted'] = false;
}

$search_result = null;
$search_message = "";
$delete_message = "";

// For Search Form
if (isset($_POST['search'])) {
    $ref = $_POST['search_ref'];
    if ($ref == $record['ref_no']) {
        $search_result = $record;
        $search_message = "<script>alert('✅ Record found!');</script>";
    } else {
        $search_message = "<script>alert('❌ Record not found.');</script>";
    }
}

// For Delete Form
if (isset($_POST['delete'])) {
    $ref = $_POST['delete_ref'];
    if ($ref == $record['ref_no']) {
        $delete_message = "<script>alert('✅ Record deleted!');</script>";
        $record = null;
        $search_result = null;
    } else {
        $delete_message = "<script>alert('❌ No record found to delete.');</script>";
    }
}

$bgImage = "bg-view.png";

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../css/bootstrap.min.css" />
    <title>View</title>
    <style>
        body {
            background-image: url('<?php echo $bgImage; ?>');
            background-size: cover;
            background-repeat: repeat;
            background-position: center;
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
            width: 60%;
            margin: 20px auto;
            border-radius: 10px;
        }

        .messages {
            margin-top: 15px;
        }

        table {
            width: 100%;
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
    <input type="text" name="search_ref" placeholder="Enter Ref No." required>
    <button type="submit" name="search" class="search-btn">Search</button>
 </form>
</div>

<!-- For Message Output -->
<div class="messages">
    <?php if ($search_message): ?><p style="color: lightgreen;"><?= $search_message ?></p><?php endif; ?>
    <?php if ($delete_message): ?><p style="color: red;"><?= $delete_message ?></p><?php endif; ?>
</div>

<!-- Display Box -->
<div class="box">
    <?php if ($search_result): ?>
        <table>
            <tr>
                <th>Ref No.</th>
                <th>Custom No.</th>
                <th>Beverages</th>
                <th>Movie name</th>
                <th>Seats</th>
            </tr>
            <tr>
                <td><?= $search_result['ref_no'] ?></td>
                <td><?= $search_result['custom_no'] ?></td>
                <td><?= $search_result['beverage'] ?></td>
                <td><?= $search_result['movie'] ?></td>
                <td><?= $search_result['seats'] ?></td>
            </tr>
        </table>
    <?php else: ?>
        <i>No record to display.</i>
    <?php endif; ?>
</div>

<!-- Delete Form -->
<form method="post">
    <input type="text" name="delete_ref" placeholder="Enter Ref No." required>
    <button type="submit" name="delete" class="delete-btn">Delete</button>
</form>
</div>

</body>
</html>
