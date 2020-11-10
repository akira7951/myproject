<?php
    try{
        require_once("pdo.php");
        $id = $_GET["id"];
        $sql = "SELECT * FROM clients WHERE id =?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$id]);
        $row = $stmt->fetch();
    }catch(PDOException $e){
        echo $e->getMessage();
    }
?>
<?php include("layout/header.php"); ?>
<?php include("layout/nav.php"); ?>
<div class="container">
    <?php
        echo $row["name"];
        echo $row["mail"];
        echo $row["phone"];
        echo $row["gender"];
        echo $row["create_at"];
    ?>
</div>
<?php include("layout/footer.php"); ?>