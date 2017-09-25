<?php
session_start();
require("inc/connection.php");


$fid=mysqli_real_escape_string($connection, $_SESSION["fid"]);
$uid=mysqli_real_escape_string($connection, $_SESSION["id"]);
$reply=mysqli_real_escape_string($connection, $_POST["reply"]);
$date=date("Y-m-d H:i:s");

$query="INSERT INTO replies (FID, UID, Reply, Reply_Date) VALUES ($fid, $uid, '$reply', '$date')";
mysqli_query($connection,$query);

header("Location: http://localhost:8012/projekti-php/details.php?id=".$_SESSION["item_id"]);

?>
