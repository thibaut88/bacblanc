<?php
session_start();
session_destroy();
$location=str_replace('deconnection.php','',$_SERVER['SCRIPT_NAME']).'index.php';
header("Location:$location");