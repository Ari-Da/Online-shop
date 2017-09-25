<?php
session_start();
require("inc/connection.php");

$uid=$_SESSION["id"];
$pid=mysqli_real_escape_string($connection,$_POST["item_id"]);
$name=mysqli_real_escape_string($connection,$_POST["item_name"]);
$size=mysqli_real_escape_string($connection,$_POST["item_size"]);
$price=$_POST["item_price"];
$quantity=$_POST["item_quantity"];
$total=$quantity*$price;

$query1="SELECT * FROM cart WHERE UID='$uid' AND PID='$pid' AND Size='$size'";
$match=mysqli_fetch_array(mysqli_query($connection,$query1));
$cid=$match["CID"];
$new_quantity=$quantity+$match["Quantity"];
$total=$new_quantity*$price;
if($match)
{

    $query2="UPDATE cart SET Quantity=$new_quantity, Total=$total WHERE CID=$cid";
    mysqli_query($connection,$query2);
    header('location: display_cart.php');
}
else {
    $query3 = "INSERT INTO cart (UID, PID, Name, Size, Price, Quantity, Total) VALUES ($uid, $pid, '$name','$size',$price,$quantity,$total)";
    mysqli_query($connection, $query3);
    header('location: display_cart.php');
}

?>
