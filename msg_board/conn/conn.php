<?php
$hostname_conn = "localhost";
$username_conn = "admin";
$password_conn = "admin";
$database_conn = "msg_board";

$conn = mysqli_connect($hostname_conn, $username_conn, $password_conn, $database_conn);

if(!$conn){
    printf("連線資料庫失敗: %s\n", mysqli_connect_error());
    exit();
}

mysqli_set_charset($conn,"utf8");
// mysqli_close($conn);
?>