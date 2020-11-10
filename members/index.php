<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Member system</title>
    <link rel="stylesheet" href="css/index.css">
</head>
<body>
    <div class="cap">
        <?php if($_SESSION){
            echo $_SESSION["USER"]."Hello,";
        }else{
            echo "Hello Visitor";
        } 
        ?>
    </div>
    <nav>
        <?php if($_SESSION){ ?>
            <a href="logout.php?q=true">Logout</a>
        <?php }else{ ?>
            <a href="login.php">Login</a>
            <a href="signup.php">Register</a>
        <?php } ?>
    </nav>
</body>
</html>