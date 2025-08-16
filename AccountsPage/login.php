<?php 
  include '../../Cinema-Ticketing/php/connection.php';
  @include '../../Cinema-Ticketing/php/select.php'; 
    session_start();

    @$username = $_POST['email'];
    @$password = $_POST['pswd'];
    $accounts = $admin->query("SELECT * FROM `accounts` WHERE username = '$username' AND password = '$password' LIMIT 1;" );
    $account = $accounts->fetch_assoc();
    $msg = '';
    if($_SERVER["REQUEST_METHOD"] === "POST") {
        if(isset($_POST['login'])){
            if(isset($_POST['email']) && isset($_POST['pswd'])){
                if($accounts && $accounts->num_rows > 0){
                    if($account['position'] === "staff"){
                        header("Location: ../Admin-and-Staff/Staff.php");
                        $_SESSION['email'] = $username;
                        $_SESSION['pswd'] = $password;
                    }else{
                        header("Location: ../Admin-and-Staff/admin/Admin.php");
                        $_SESSION['email'] = $username;
                        $_SESSION['pswd'] = $password;
                    }
                }else{
                    $msg = 'Account not found';
                }
            }else{
                $msg = 'Input please';
            }
        }
    }


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../fonts/font-style.css">
    <style>
        body{
            background: url(../images/bg-view.png);
        }
    </style>
    <title>Document</title>
</head>
<body class="bg-dark">
    <div class="d-flex justify-content-center align-items-center" style="min-height: 100vh;">
        <div class="container w-50 text-light d-flex flex-column justify-content-center border border-3 border-warning p-4 " style="background: linear-gradient(
          0deg,
          rgba(255, 154, 0, 1) 0%,
          rgba(255, 115, 0, 1) 50%,
          rgba(255, 77, 0, 1) 100%
          );">
        <h1 class="text-center roboto-slab-regular"> LOG IN</h1>
        <form action="login.php" method="post">
            <div class="msg text-center text-dark roboto-bold" ">
                <p  style="background-color: lightblue ;">
                    <?= $msg?>
                </p>
            </div>
            <div class="form-floating mb-3 mt-3">
                <input type="text" class="form-control roboto-medium" id="email" placeholder="Enter email" name="email" required>
                <label for="email" class="roboto-medium">Email</label>
            </div>

            <div class="form-floating mt-3 mb-3">
                <input type="password" class="form-control roboto-medium" id="pwd" placeholder="Enter password" name="pswd" required>
                <label for="pwd" class="roboto-medium">Password</label>
            </div>
            <div class="d-flex justify-content-center">
                <button class="btn btn-warning roboto-bold w-50" style="background: rgba(255, 77, 0, 1) 100%;" type="submit" name="login">Log in</button>
            </div>
        </form>
        
    </div>
    </div>
    
</body>
</html>     