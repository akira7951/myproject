<?php
require_once('conn/conn.php');

$mb_id = -1;
if(isset($_GET['mb_id'])){
    $mb_id = $_GET['mb_id'];
}

$deleteSQL = "DELETE FROM mb WHERE mb_id = $mb_id";
$result = mysqli_query($conn, $deleteSQL);
header('location:mb_index.php');
mysqli_close($conn);
?>