<?php
session_start();
unset($_SESSION["user"]);
if(!isset($_SESSION["user"]))
header("Location: adminlogin.php");
?>