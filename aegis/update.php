<?php
    try{
        require_once("pdo.php");
        $name = $_POST["name"];
        $mail = $_POST["mail"];
        $phone = $_POST["phone"];
        $gender = $_POST["gender"];
        $id = $_POST["id"];
        $sql = "UPDATE clients
            SET 
                name    = ?,
                mail    = ?,
                phone   = ?,
                gender  = ?
            WHERE 
                id      = ?";
        $stmt = $pdo->prepare($sql);;
        $stmt->execute([$name,$mail,$phone,$gender,$id]);
        header("location:index.php");
    }catch(PDOException $e){
        echo $e->getMessage();
    }