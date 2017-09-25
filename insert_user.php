<?php
session_start();
require("inc/connection.php");

if(isset($_POST['insert'])) {

    $Name = mysqli_real_escape_string($connection, $_POST["first"])." ".mysqli_real_escape_string($connection,$_POST["last"]);
    $Name = trim($Name);
    $Email = mysqli_real_escape_string($connection, $_POST["email"]);
    $Email = trim($Email);

    $query1="SELECT Name FROM users WHERE Name='$Name' OR Email='$Email'";
    $user=mysqli_fetch_array(mysqli_query($connection, $query1));
    if($user!=0)
    {
        session_destroy();
        header("Location: register.php?status=0");
        die();
    }
    
    $Address = mysqli_real_escape_string($connection, $_POST["address"]);
    $Pass = mysqli_real_escape_string($connection, $_POST["pass"]);
    $password = hash('sha1', $Pass);
    $time=date("Y-m-d H:i:s");


    $query2 = "INSERT INTO users (Name, Password, Address, Email, Reg_Date) VALUES ('$Name','$password', '$Address','$Email','$time')";
    mysqli_query($connection, $query2);

    $header="From: ariana.daka@gmail.com";
    $message = "Dear ".$Name.",\nwelcome to a-store.site50.net, an online shopping website.\n\nYour username: ".$Name."\nYour password: ".$Pass."\n\nIMPORTANT! Do not delete this message as you might need your account details in the future.\n\nHappy shopping,\nfrom Ariana Daka";
    $message = wordwrap($message, 100);

    mail($Email, "a-store.com welcoming message", $message, $header);

    $_SESSION["inserted"]=true;

    header("Location: products.php");

}


if(isset($_SESSION["inserted"]))
{

    $user = mysqli_fetch_array(mysqli_query($connection, "SELECT UID FROM users WHERE Name = '$Name' AND Password='$password'"));

    $_SESSION["id"]=$user["UID"];
    $_SESSION["name"]=$Name;
    $_SESSION["pass"]=$Pass;
    $_SESSION["address"]=$Address;
    $_SESSION["email"]=$Email;
    $_SESSION["priv"]="User";
    $_SESSION["time"]="Log in time ".date("H:i",time());

    $myfile = fopen("times/time".$_SESSION['id'].".txt", "w") or die("Unable to open file!");
    $time = "Log in time ".date("H:i",time());
    fwrite($myfile, $time);
    fclose($myfile);

    header("Location: products.php");
}

?>