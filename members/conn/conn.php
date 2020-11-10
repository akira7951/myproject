<?php
$hostname_conn = "localhost";
$database_conn = "aegis";
$username_conn = "admin";
$password_conn = "admin";

$conn = mysqli_connect($hostname_conn, $username_conn, $password_conn, $database_conn);

if (!$conn) {
    printf("連線資料庫失敗: %s\n", mysqli_connect_error());
    exit();
}

mysqli_set_charset($conn,"utf8");
?>