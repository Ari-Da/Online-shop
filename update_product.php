<?php
require("inc/connection.php");

if(isset($_POST['insert']))
{
    $pid=mysqli_real_escape_string($connection, $_POST['item_id']);
    $name=mysqli_real_escape_string($connection, $_POST['product_name']);
    $price=mysqli_real_escape_string($connection,$_POST['product_price']);
    $category=mysqli_real_escape_string($connection, $_POST['product_category']);

    if(isset($_POST['product_image']))
         $img="img/shirts/".mysqli_real_escape_string($connection, $_POST['product_image']);
     else 
         $img=mysqli_real_escape_string($connection, $_POST['item_img']);

    $query = "UPDATE products SET Name = '$name', Img = '$img', Price = $price, Category = $category WHERE PID=$pid";
    mysqli_query($connection, $query);
}

header('Location: products.php');

?>
