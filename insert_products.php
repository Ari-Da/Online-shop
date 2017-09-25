<?php
//session_start();
require("inc/connection.php");

$name=mysqli_real_escape_string($connection,$_POST["product_name"]);
$image=mysqli_real_escape_string($connection,"img/shirts/".$_POST["product_image"]);
$price=mysqli_real_escape_string($connection,$_POST["product_price"]);
$category=mysqli_real_escape_string($connection,$_POST["product_category"]);

    $query = "INSERT INTO products (Name, Img, Price, Category) VALUES ('$name', '$image', $price, $category)";
    mysqli_query($connection, $query);

    header('location: products.php');


?>
