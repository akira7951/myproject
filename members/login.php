<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/login.css">
</head>
<body>
    <div class="container">
        <form action="auth.php" method="post">
            <label for="">
                Username<input type="text" name="user">
            </label>
            <label for="">
                Password<input type="password" name="pw">
            </label>
            <input class="login" type="submit" name="Login" value="Login">
        </form>
    </div>
</body>
</html>