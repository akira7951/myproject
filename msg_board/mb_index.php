<?php
require_once('conn/conn.php');
include('conn/assist.php');

if(isset($_POST['mb_name'])){
    $mb_name = $_POST['mb_name'];
    $mb_content = $_POST['mb_content'];

    $insertSQL = "INSERT INTO mb (mb_name, mb_content) 
                    VALUES('$mb_name', '$mb_content')";
    $result = mysqli_query($conn, $insertSQL);
    header('location:mb_index.php');
}

$RS_mb_str = "SELECT * FROM mb ORDER BY mb_time DESC";
$RS_mb = mysqli_query($conn, $RS_mb_str);
$num_RS_mb = mysqli_num_rows($RS_mb);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Message Board</title>
    <style>
        h1 {
            text-align: center;
        }
        form {
            width: 800px;
            margin: 0 auto;
        }
        input, textarea {
            vertical-align: middle;
        }
        .mbForm input, .mbForm textarea {
            width: 800px;
            margin-bottom: 5px;
        }
    </style>
</head>
<body>
    <h1>Message Board</h1>
    <form action="mb_index.php" method="post" class="mbForm">
        <input type="text" name="mb_name" required placeholder="請輸入留言者姓名"><br>
        <textarea name="mb_content" rows="5" required placeholder="請輸入留言內容....."></textarea><br>
        <input type="submit" value="確定新增留言">
        <input type="reset" value="清除重寫">
    </form>

    <?php echo '<h2>目前留言數:'.$num_RS_mb.'</h2>' ?>

    <?php
    while($row_RS_mb = mysqli_fetch_assoc($RS_mb)){
    ?>
    <p>留言者：[<?php echo $row_RS_mb['mb_id']; ?>]
        <?php echo $row_RS_mb['mb_name']; ?>
        [<?php echo $row_RS_mb['mb_time']; ?>]
        <a href="mb_modify.php?mb_id=<?php echo $row_RS_mb['mb_id'] ?>">編輯</a>
        <a href="javascript:
            if(confirm('確定刪除嗎？')){
            window.location.href='mb_delete.php?mb_id=<?php echo $row_RS_mb['mb_id']; ?>';
        }">刪除</a>
        <br>
        內  容：<?php echo $row_RS_mb['mb_content']; ?>
    </p>
    <hr>
    <?php
    }
    ?>
</body>
</html>
<?php
mysqli_free_result($RS_mb);
mysqli_close($conn);
?>