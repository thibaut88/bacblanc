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
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.5/js/bootstrap.min.js" integrity="sha384-BLiI7JTZm+JWlgKa0M0kGRpJbF2J8q+qreVrKBC47e3K6BW78kGLrCkeRX6I9RoK" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js" integrity="sha384-3ceskX3iaEnIogmQchP8opvBy3Mi7Ce34nWjpBIwVTHfGYWQS9jwHDVRnpKKHJg7" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.3.7/js/tether.min.js" integrity="sha384-XTs3FgkjiBgo8qjEjBk0tGmf3wPrWtA6coPfQDfFEY8AnYJwjalXCiosYRBIBZX8" crossorigin="anonymous"></script>	
<link href="stylesheet.css"rel="stylesheet"type="text/css">
<script src="scripts.js" type='text/javascript'></script>

  <style type='text/css'>
  
  
  
  </style>
</head>
<body>

<?php
require 'menu.php';
?>


		<div class="container-fluid">
		<center><h1>Vidéos</h1></center>
		<div class="row">

		<?php
		include 'filter.php';
		?>
		
		
		
		
		<div id="contentVideos"class="col-sm-10">
<?php
	$videosAll = "SELECT * FROM `videos`
	LEFT JOIN posts ON videos.videos_id_post = posts.id_post
	ORDER BY videos_id_categorie";
	
	if($RES = mysqli_query($conn, $videosAll)){
		
	if(mysqli_num_rows($RES)>0){
		while($row = mysqli_fetch_assoc($RES)){ ?>
	<?php
	$options = ['-',' ',':'];
	$date=$row['date_ajout'];
	$reverseTimestamp=str_replace($options,'',$date);
	$limit=8;
	$premier='';
	$deuxieme='';
	for($i=0;$i<strlen($reverseTimestamp);$i++){
		if($i<$limit){
		$premier.=$reverseTimestamp[$i];
		}else{
		$deuxieme.=$reverseTimestamp[$i];
		}
	}
	$deuxieme.=$premier;
	$timestamp=$deuxieme;
	
	$heure=$timestamp[0];
	$heure.=$timestamp[1];
	
	$minute=$timestamp[2];
	$minute.=$timestamp[3];
	
	$seconde=$timestamp[4];
	$seconde.=$timestamp[5];
	
	$annee=$timestamp[6];
	$annee.=$timestamp[7];
	$annee.=$timestamp[8];
	$annee.=$timestamp[9];

	$mois=$timestamp[10];
	$mois.=$timestamp[11];
	
	$jour=$timestamp[12];
	$jour.=$timestamp[13];
	
	$timestamp= mktime( $heure, $minute, $seconde, $mois, $jour, $annee);


	?>
	
	<div data-timestamp="<?=$timestamp?>" data-categorie="categorie-<?=$row['videos_id_categorie']?>"class="categorie categorie-<?=$row['videos_id_categorie']?> row">
	<div class="col-md-7">

		<h2><?=$row['titre_video']?></h2>
		<div>
		 <?=$row['url']?>
		 <div class="setPassword">
		 <form class="formSendPassword"action=""method="post">
		 <input data-idv="<?=$row['id_video']?>"type="password" name="setPassword" class="">
		 <input type="submit" name="setPasswordSend"value="valider">
		 </form>
		 
		 </div>
		</div>
      <button type="submit" onclick="show('description-<?=$row['id_video']?>',this)" class="btn btn-default">voir plus d'infos</button>
		
		 <div id="description-<?=$row['id_video']?>"class="description description-<?=$row['id_video']?>">
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
		
		</div><!-- ROW -->
		</div><!-- CONTAINER -- FLUID -->
		
	
</body>
</html>