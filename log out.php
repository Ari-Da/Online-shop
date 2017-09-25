<?php
session_start();
session_destroy();
setcookie("name", "", time() - 3600);
setcookie("pass", "", time() - 3600);

header("Location: sign in.php");
?>