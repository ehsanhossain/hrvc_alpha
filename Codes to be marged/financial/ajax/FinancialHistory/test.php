<?php include("getGroup.php"); 

$sql = "SELECT * FROM table WHERE column";
$res = mysqli_query($connection, $sql) or die($connection->error);
$row = mysqli_fetch_assoc($res);
?>