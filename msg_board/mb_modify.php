<?php
require_once('conn/conn.php');
include('conn/assist.php');

if(isset($_POST['mb_name'])){
    $mb_name = $_POST['mb_name'];
    $mb_content = $_POST['mb_content'];
    $mb_id = $_POST['mb_id'];

    $updateSQL = "UPDATE mb SET mb_name = '$mb_name',
                                mb_content = '$mb_content'
                                WHERE mb_id = $mb_id";
    $result = mysqli_query($conn, $updateSQL);
    header('location:mb_index.php');
}

$mb_id = -1;
if(isset($_GET['mb_id'])){
    $mb_id = $_GET['mb_id'];
}

$RS_mb_str = "SELECT * FROM mb WHERE mb_id = $mb_id";
$RS_mb = mysqli_query($conn, $RS_mb_str);
$row_RS_mb = mysqli_fetch_assoc($RS_mb);
// print_r($row_RS_mb);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
    <h1>修改內容</h1>
    <form action="mb_modify.php" method="post" class="mbForm">
        <input type="text" name="mb_name" required placeholder="請輸入留言者姓名" 
            value="<?php echo $row_RS_mb['mb_name']; ?>"><br>
        <textarea name="mb_content" rows="5" required placeholder="請輸入留言內容....."><?php echo $row_RS_mb['mb_content']; ?></textarea><br>
        <input type="submit" value="確定更新留言">
        <input type="reset" value="清除重寫">
        <input type="hidden" name="mb_id" value="<?php echo $row_RS_mb['mb_id']; ?>">
    </form>
</body>
</html>
<?php
mysqli_free_result($RS_mb);
mysqli_close($conn);
?>