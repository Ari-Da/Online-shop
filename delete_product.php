<?php
include('inc/db_products.php');
require("inc/connection.php");

if(isset($_POST['delete_product']))
{
    $pid=mysqli_real_escape_string($connection, $_POST['item_id']);

    $query="DELETE FROM products WHERE PID=$pid";
    mysqli_query($connection, $query);
}

header('location: products.php');

?>