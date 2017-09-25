<?php
session_start();
require("inc/connection.php");

if(isset($_POST['save']))
{
    $id=$_SESSION["id"];
    $full_name=mysqli_real_escape_string($connection, $_POST['full']);
    $pass=mysqli_real_escape_string($connection,$_POST['pass']);
    $address=mysqli_real_escape_string($connection,$_POST['address']);
    $email=mysqli_real_escape_string($connection,$_POST['email']);
    $account=$_POST['account'];

    $_SESSION["name"]=$full_name;
    $_SESSION["address"]=$address;
    $_SESSION["email"]=$email;
    $_SESSION["account"]=$account;
    $_SESSION["pass"]=$pass;

    $query = "UPDATE users SET Name = '$full_name', Password = '$pass', Address = '$address', Email = '$email', Account = $account WHERE UID=$id";
    mysqli_query($connection, $query);
}

header('Location: profile.php');

?>
