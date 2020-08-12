<?php
    require "header.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
    <!-- <script src="js/jquery.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.js"></script> -->
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <title>accounts</title>
</head>
<body>
    <div class="flex-container login-wrap">
        <?php
            if(isset($_SESSION['userID'])) {
                header("Location: ".$_SESSION['pageredirector']);
            }
            else {
                echo '
                <div class="login-box mr-5">
                    <form class="login-form" action="action/admin-login.php" method="post">
                    <h5>Admin</h5><br>
                    Email/Username<br>
                    <input class="box" type="text" name="Email" placeholder="Email/Username"><br><br>
                    Password<br>
                    <input class="box" type="password" name="pwd" placeholder="Password"><br><br>
                    <button type="submit" name="login-submit">Login</button><br><br><br>
                    <p>You are logged out</p>
                    </form>     
                </div>
                <div class="login-box ml-5">
                    <form class="login-form" action="action/employee-login.php" method="post">
                    <h5>Employee</h5><br>
                    Email/Username<br>
                    <input class="box" type="text" name="Email" placeholder="Email/Username"><br><br>
                    Password<br>
                    <input class="box" type="password" name="pwd" placeholder="Password"><br><br>
                    <button type="submit" name="login-submit">Login</button><br><br><br>
                    <p>You are logged out</p>
                    </form>
                </div>
                ';
            }
        ?>
    </div>
</body>
</html>
