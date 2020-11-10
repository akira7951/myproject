<?php
    try {
        require_once("pdo.php");
        $id = $_POST["id"];
        $sql = "DELETE FROM clients WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$id]);
        header("Location:index.php");
    }catch(PDOException $e){
        echo $e->getMessage();
    }