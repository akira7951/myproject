<?php
    require_once("conn/conn.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/signup.css">
</head>
<body>
    <form action="" method="post">
        <div class="container">
            <h1>Register</h1>
            <p>Please fill in this form to create an account</p>
            <hr>
            <label for="user">User
                <input type="text" name="user" required>
            </label>
            <label for="">Password
                <input type="password" name="pw" required>
            </label>
            <label for="">E-mail
                <input type="text" name="mail" required>
            </label>
            <input class="registerbtn" type="submit" value="Register" name="submit">
        </div>
    </form>
    <?php
        if(isset($_POST["submit"])){
            $user = $_POST["user"];
            $pw = $_POST["pw"];
            $mail = $_POST["mail"];

            $sql = "INSERT INTO members(user,pw,mail) VALUE('$user','$pw','$mail')";
            mysqli_query($conn,$sql);
            echo "<script>alert('申請完成，請重新登入');location.href='login.php'</script>";
        }
    ?>
</body>
</html>