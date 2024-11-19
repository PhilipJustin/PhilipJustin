<?php
include 'conn.php';

if(isset($_GET['id'])){
    $id = $_GET['id'];
    mysqli_query($conn, "DELETE FROM ordercoc WHERE id='$id'");
    header("Location: index.php");
}
?>
