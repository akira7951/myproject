<?php
    date_default_timezone_set("Asia/Taipei");
    try{
        require_once("pdo.php");
        $name = $_POST["name"];
        $phone = $_POST["phone"];
        $mail = $_POST["mail"];
        $gender = $_POST["gender"];
        $create_at = date("Y-m-d H:i:s");
        $sql = "INSERT INTO clients(name,phone,mail,gender,create_at)VALUES(?,?,?,?,?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$name,$phone,$mail,$gender,$create_at]);
        header("Location:index.php");
    }catch(PDOException $e){
        echo $e->getMessage();
    }