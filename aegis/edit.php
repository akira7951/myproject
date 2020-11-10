<?php
    try{
        require_once("pdo.php");
        $id = $_GET["id"];
        $sql = "SELECT * FROM clients WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$id]);
        $row = $stmt->fetch();
    }catch(PDOException $e){
        echo $e->getMessage();
    }
?>
<?php include("layout/header.php");?>
<?php include("layout/nav.php");?>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-10">
            <form action="update.php" method="post">
                <div class="form-group">
                    <label for="name">姓名</label>
                    <input type="text" id="name" name="name" class="form-control" value="<?php echo $row["name"];?>">
                </div>
                <div class="form-group">
                    <label for="mail">mail</label>
                    <input type="text" id="name" name="mail" class="form-control" value="<?php echo $row["mail"];?>">
                </div>
                <div class="form-group">
                    <label for="phone">電話</label>
                    <input type="text" id="phone" name="phone" class="form-control" value="<?php echo $row["phone"];?>">
                </div>
                <div class="form-group">
                <label>性別</label>
                <div class="form-check">
                    <input type="radio" name="gender" value="男"  id="male" class="form-check-input" <?php echo $row["gender"]==="男" ? "checked":"";?>>
                    <label for="male" class="form-check-label">男</label>
                </div>
                <div class="form-check">
                    <input type="radio" name="gender" value="女" id="female" class="form-check-input" <?php echo $row["gender"]==="女" ? "checked":"";?>>
                    <label for="female" class="form-check-label">女</label>
                </div>
                </div>
                <input type="hidden" value="<?php echo $row["id"];?>" name="id">
                <input type="submit" value="確認修改" class="btn btn-primary">
            </form>
        </div>
    </div>
</div>
<?php include("layout/footer.php");?>