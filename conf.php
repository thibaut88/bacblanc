<?php

$DBhost = 'localhost';
$DBuser = 'admin';
$DBpass = 'admin';
$DBTable = 'bacblanc';


$conn = mysqli_connect($DBhost,$DBuser,$DBpass,$DBTable);

if(!$conn){
	echo "problème de connection BDD";
}

