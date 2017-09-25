<?php
session_start();
require("inc/connection.php");

include "delete_cart.php";

$pid=$_SESSION["pid"];
$uid=$_SESSION["id"];
$feedback=mysqli_real_escape_string($connection, $_POST["feedback"]);
$rating=$_POST["rating"];
$date=date("Y-m-d H:i:s");

$query="INSERT INTO feedbacks (PID, UID, Feedback, Rating, Feed_Date) VALUES ($pid,$uid,'$feedback',$rating, '$date')";
mysqli_query($connection,$query);

header("Location: products.php");

?>
