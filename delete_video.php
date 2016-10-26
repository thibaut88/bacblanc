<?php

$id= $_GET['id_video'];
$conn = mysqli_connect('localhost','admin','admin','bacblanc');
$sql = "DELETE FROM videos WHERE id_video = $id";

if(mysqli_query($conn,$sql)){
	

$alert= "<div class='alert alert-success fade in'>
<a href='#' class='close' data-dismiss='alert' aria-label=close'>&times;</a>Vidéo supprimée</div>";

echo $alert;


}


?>