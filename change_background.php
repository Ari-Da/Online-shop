<?php
if($_SERVER["REQUEST_METHOD"] == "POST")
{
    $new_foto=$_POST['foto'];
    setcookie("foto",$new_foto,time()+1800);//30 minuta
}

header("Location: index.php");

?>