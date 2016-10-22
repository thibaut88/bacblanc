<?php
session_start();
require 'conf.php';

if(empty($_SESSION)){
$_SESSION['LOGGED'] = false;
$_SESSION['ROLE'] = 0;

$LOGGED = $_SESSION['LOGGED'];
$ROLE = $_SESSION['ROLE'];

}else{
$LOGGED = $_SESSION['LOGGED'];
$ROLE = $_SESSION['ROLE'];
}
	
	define('LOGGED',$LOGGED);
	define('ROLE',$ROLE);
	
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <title>Vidéos</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <link href="stylesheet.css"rel="stylesheet"type="text/css">
</head>
<body>

<?php
require 'menu.php';
?>


		<div class="container-fluid">
				<center><h1>Vidéos</h1></center>
				
<?php
	$videosAll = "SELECT * FROM `videos`
	LEFT JOIN posts ON videos.videos_id_post = posts.id_post
	ORDER BY videos_id_categorie";
	
	if($RES = mysqli_query($conn, $videosAll)){
		
	if(mysqli_num_rows($RES)>0){
		while($row = mysqli_fetch_assoc($RES)){ ?>
	
	<div class="categorie-<?=$row['videos_id_categorie']?> row">
	<div class="col-md-6 col-md-offset-4">
		<h2><?=$row['titre_video']?></h2>
		 <?=$row['url']?>
		 
		 <div class="descsription-<?=$row['id_video']?>">
		 <?=$row['description']?>
		 </div>
	</div>	
	</div>	

			
<?php
	}
	}
	}

?>
		</div>
</body>
</html>