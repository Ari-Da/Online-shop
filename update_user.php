<?php
session_start();
require("inc/connection.php");

if(isset($_POST['save']))
{
    $id=$_SESSION["id"];
    $full_name=mysqli_real_escape_string($connection, $_POST['full']);
    $password=mysqli_real_escape_string($connection,$_POST['pass']);
    $pass=hash("sha1", $password);
    $address=mysqli_real_escape_string($connection,$_POST['address']);
    $email=mysqli_real_escape_string($connection,$_POST['email']);

    $_SESSION["name"]=$full_name;
    $_SESSION["address"]=$address;
    $_SESSION["email"]=$email;
    $_SESSION["pass"]=$password;

    $query = "UPDATE users SET Name = '$full_name', Password = '$pass', Address = '$address', Email = '$email' WHERE UID=$id";
    mysqli_query($connection, $query);

    $header="From: ariana.daka@gmail.com";
    $message = "Dear ".$full_name.",\nyour profile has been updated  successfully.\n\nYour username: ".$full_name."\nYour password: ".$password."\n\nIMPORTANT! Do not delete this message as you might need your account details in the future.\n\nHappy shopping,\nfrom Ariana Daka";
    $message = wordwrap($message, 100);

    mail($email, "a-store.com admin message", $message, $header);

    header("Location: profile.php?uid=".$_SESSION['id']);
}



?>
