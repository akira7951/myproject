<?php
    require_once("conn/conn.php");
    session_start();
    $user = $_POST["user"];
    $pw = $_POST["pw"];
    $sql = "SELECT * FROM members WHERE user = '$user'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);

    if($row["pw"] === $pw){
        echo "您已登入";
        $_SESSION["ID"] = $row["id"];
        $_SESSION["USER"] = $row["user"];
        $_SESSION["LEVEL"] = $row["level"];
    }else{
        echo "帳號或密碼錯誤";
    }
?>