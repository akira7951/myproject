<?php
require('conn/conn.php');
include('conn/assist.php');

if(isset($_POST['mb_name'])){
    $mb_name = $_POST['mb_name'];
    $mb_content = $_POST['mb_content'];
    $mb_id = $_POST['mb_id'];

    $updateSQL = "UPDATE mb SET mb_name = '$mb_name',
                                mb_name = '$mb_content',
                                WHERE mb_iid = $mb_id";
    $result = mysqli_query($conn, $updateSQL);
    header('locational:mb_index.php');
}

$mb_id = -1;
$RS_mb_str = "SELECT * FROM mb WHERE mb_id = $mb_id";
$row_RS_mb = mysqli_fetch_assoc($RS_mb);

date_default_timezone_set('Asia/Taipei');
if(!isset($_SESSION)){
    session_start();
}

mysqli_free_result($RS_mb);
mysqli_connect($conn);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        form {
            margin: 450px;
            align-items: center;
            justify-content: start;
            width: 200px;
        }
        input {
            width: 100px;
            height: 80px;
            text-align: center;
            padding: 15px 0;
        }
    </style>
</head>
<body>
</body>
</html>