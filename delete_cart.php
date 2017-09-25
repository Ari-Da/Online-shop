<?php
session_start();

include('inc/db_cart.php');
require("inc/connection.php");

$id=$_SESSION["id"];
$_SESSION["item_name"]=$_POST["for_feedback"];
$_SESSION["amount"];

if($_POST['buy_all'])
{
    foreach($items as $item) {
        $pid=$item['pid'];
        $size=$item['size'];
        $quantity=$item['quantity'];
        $total=$item['total'];
        $date=date("Y-m-d H:i:s");
        $_SESSION["amount"]+=$total;

        $query1 = "INSERT INTO orders (UID, PID, Size, Quantity, Total, Order_Date) VALUES ($id, $pid, '$size',$quantity, $total, '$date')";
        mysqli_query($connection, $query1);
    }

    $query2 = "DELETE FROM cart WHERE UID=$id";
    mysqli_query($connection, $query2);

    header('location: display_cart.php');
}
else if($_POST['buy'])
{
    $cid=$_POST["buy"];
    $query1="SELECT * FROM cart WHERE CID=$cid";
    $query = mysqli_query($connection, $query1);
    while($item=mysqli_fetch_array($query))
    {
        $items = array(
            "cid"=>$item['CID'],
            "pid" => $item['PID'],
            "name" => $item['Name'],
            "size"=> $item['Size'],
            "quantity"=> $item['Quantity'],
            "price"=> $item['Price'],
            "total"=> $item['Total']);
    }

    $pid=$items["pid"];
    $size=$items["size"];
    $quantity=$items["quantity"];
    $total=$items["total"];
    $date=date("Y-m-d H:i:s");
    $_SESSION["amount"]+=$total;

    $query2 = "INSERT INTO orders (UID, PID, Size, Quantity, Total, Order_Date) VALUES ($id, $pid, '$size',$quantity, $total, '$date')";
    mysqli_query($connection, $query2);

    $query3 = "DELETE FROM cart WHERE CID=$cid AND UID=$id";
    mysqli_query($connection, $query3);

    $query4="SELECT * FROM feedbacks WHERE PID=$pid AND UID=$id";
    $match = mysqli_query($connection, $query4);
    if($match) {
        header('location: feedback.php');
    }
    else
    {
        header('location: display_cart.php');
    }

}

else if($_POST["delete"])
{
    $cid=$_POST["delete"];

    $query = "DELETE FROM cart WHERE CID=$cid AND UID=$id";
    mysqli_query($connection, $query);

    header('location: display_cart.php');
}

?>