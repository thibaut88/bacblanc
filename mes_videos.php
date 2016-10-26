<?php
session_start();
require 'BACBLANC/conf.php';

if(!empty($_POST)){
	var_dump($_POST);
	
	$password_load = (!empty($_POST['mdp']))?$_POST['mdp']:'';
	$titre_video = (!empty($_POST['titre_video']))?$_POST['titre_video']:'';
	$url = (!empty($_POST['url']))?$_POST['url']:'';
	$description = (!empty($_POST['desc']))?$_POST['desc']:'';
	$auteur = (!empty($_POST['auteur']))?$_POST['auteur']:'';
	$videos_id_pseudo = (int)$_SESSION['id_user'];
	$videos_id_post = 1;
	$videos_id_categorie = 1;
	
	$sql = "INSERT INTO videos (
	titre_video, url,
	description, auteur,
	videos_id_pseudo,
	videos_id_post,
	videos_id_categorie,
	date_ajout,
	password_load
	) VALUES (
	'$titre_video',
	'$url',
	'$description',
	'$auteur',
	$videos_id_pseudo,
	$videos_id_post,
	$videos_id_categorie,
	NOW(),
	'$password_load'
	
	)";
	
	if(mysqli_query($conn,$sql)){
		$addVideook= "<div class='alert alert-success fade in'>
		<a href='#' class='close' data-dismiss='alert' aria-label=close'>&times;</a>Vidéo ajoutée</div>";
		header("Location:mes_videos.php");
	}else{
		$addVideook=false;
		echo mysqli_error($conn);
	}
}
	
	
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
  <title>Mes vidéos</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.5/js/bootstrap.min.js" integrity="sha384-BLiI7JTZm+JWlgKa0M0kGRpJbF2J8q+qreVrKBC47e3K6BW78kGLrCkeRX6I9RoK" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js" integrity="sha384-3ceskX3iaEnIogmQchP8opvBy3Mi7Ce34nWjpBIwVTHfGYWQS9jwHDVRnpKKHJg7" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.3.7/js/tether.min.js" integrity="sha384-XTs3FgkjiBgo8qjEjBk0tGmf3wPrWtA6coPfQDfFEY8AnYJwjalXCiosYRBIBZX8" crossorigin="anonymous"></script>	
<style>

.hover{
	transition: width 0.1s, height 0.1s;
}
.categorie{
		margin-bottom:50px;

}
.hover button{
	display:inline-block;
	height:40px;
	width:40%;
	margin-left:7%;

	background:black;
	color:white;
}
.hide{
	display:none;
}
</style>
</head>

<body>

<?php
require 'BACBLANC/menu.php';

	// SI USER IS LOGGED
if(LOGGED){  
	//SI USER ROLE == ADMIN
	if(ROLE == 2){ 
	
	if(!empty($addVideook)){
		echo $addVideook;
	}

	
	

	?>
	
		
		<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<center>
				<button id="buttonAjouter"type="button"class="btn btn-default btn-block btn-lg">Ajouter une vidéo  <span class='caret'></span></button>
				</center>
				<div id="ajouterContent" class="">
			
			<form action="mes_videos.php" method="post">
			
			<div class="form-group">
				<label for="titre_video">Titre vidéo</label>
				<input required class="form-control" type="text" name="titre_video" id="titre_video" value="">
			</div>
			<div class="form-group">
				<label for="categorie">Catégorie</label>
				  <select class="form-control" id="exampleSelect1"name="categorie" id="categorie">
					  <option selected disabled value="0">Choisissez une catégorie</option>
					  <?php
					  $cats = "SELECT * FROM categories";
					  if(($rep=mysqli_query($conn,$cats))>0){
						  while($row=mysqli_fetch_assoc($rep)){ ?>
								  <option value="<?=$row['id_categorie']?>"><?=$row['nom_categorie']?></option>
						<?php }
					  } ?>
	
				</select>
			</div>			
			<div class="form-group">
				<label for="url">code d'intégration ( format : embeded )</label>
				<input required class="form-control" type="text" name="url" id="url" value="">
			</div>

			
			<div class="form-group">
				<label for="desc">Description</label>
				<textarea class="form-control" type="text" name="desc" id="desc" rows="6"></textarea>
			</div>

			
			<div class="form-group">
				<label for="auteur">Auteur</label>
				<input required class="form-control" type="text" name="auteur" id="auteur" value="">
			</div>
					
			<div class="form-group">
				<label for="mdp">mot de passe (pour la lecture)</label>
				<input required class="form-control" type="text" name="mdp" id="mdp" value="">
			</div>

			<button type="submit" name="addVideo"class="btn btn-default">Valider</button>
			</form>
			<hr>
				</div>
				
				
				<center>
				<button id="modifierVideo"type="button"class="btn btn-default btn-block btn-lg">Modifier la vidéo  <span class='caret'></span></button>
				</center>
				<div id="modifierContent" class="">
					<form action="" method="">
						<div class="form-group">
							<label for="id_video">identifiant</label>
							<input type="text" name="id_video" class="form-control" id="id_video" required>
						</div>
						
						<div class="form-group">
							<label for="titre_video">Titre vidéo</label>
							<input type="text" name="titre_video" class="form-control" required>
						</div>
				
				</div>
			
			
			
			</div>
		</div>
		<div class="row">
			<h1 class="jumbotron"><center>Mon espace : <small>mes vidéos</small></center></h1>
				
<?php 	
	// var_dump($_SESSION);
	$sql = "SELECT * FROM videos WHERE videos_id_pseudo = ".$_SESSION['id_user']."";
	$rep=mysqli_query($conn,$sql) or die(mysqli_error($conn));

while($row = mysqli_fetch_assoc($rep)){ 

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
	<div data-timestamp="<?=$timestamp?>"  
	data-categorie="categorie-<?=$row['videos_id_categorie']?>" 
	class="col-sm-6 categorie categorie-<?=$row['videos_id_categorie']?> ">
	
		<h4><?=$row['titre_video']?></h4>
		<span>
		 <?=$row['url']?>
		  <div class="hover">
		  
 <button type="button" onclick="supprimer(<?=$row['id_video']?>)">supprimer</button>
 <button type="button" onclick="modifier(<?=$row['id_video']?>)">modifier</button>
		  
		  
		  </div>
		 </span>
	</div>	
	<?php
	}
	?>

	</div><!-- row -->
	</div><!-- CONTAINER -->
<?php
} 
} 
else{
	header("Location:BACBLANC/index.php");
 }
 ?> 
<script type='text/javascript'>
	
		$('#ajouterContent').hide();
		$('#modifierContent').hide();
		
	function supprimer(id){
	var id_video = id;
	$.ajax({
		url: 'delete_video.php',
		method:'GET',
		type :'html',
		data : 'id_video='+id_video,
		success: function(html){
		$('.row').prepend(html);	
		var time = setInterval(function(){window.location.reload()},5000);
		}
		});
	}//supprimer

		$("#modifierVideo").click(function(){
			$('#ajouterContent').hide(500);
				$('#modifierContent').toggle('slow');
			});
	
	function modifier(id){
	var id_video = id;
	$('#ajouterContent').hide(500);	
	$('#modifierContent').show(500);

	$('#id_video').attr('value',id_video);
	
	/*****
	
	ICI RECUPERER LES VALEURS DE LA VIDEO LA RENVOYER AU FORMULAIRE Modifier
	Definir un password
	PUIS  submit
	
	****/
	
	
	
	
	
	}//modifier

	
	
	
	
	$(document).ready(function(){
		
	// $('a .close').click(function(){

		// alert($(this));
		// $(this)hide();
	// });
	
	
	var $option="";

	$('iframe').on({
		
		'mouseenter':function(){
		var $elem= $(this).parent();
		var $hover= $elem.find('div.hover');

		$elem.css('display','block');
		$elem.css('position','relative');
		$elem.css('top','0px');
		$elem.css('left','0px');
		$elem.css('right','0px');
		$elem.css('bottom','0px');
		var $color = 'rgba(0,0,0,0)';
		$hover.css('background-color',$color);	
		
		$option=$hover;
		$hover.css('display','initial');
		$hover.css('position','absolute');
		$hover.css('bottom','0px');
		$hover.css('left','0px');		
		$hover.css('right','0px');
		$hover.css('height','0%');
		var $color= 'rgba(0,0,0,1)';
		
		$hover.animate(
		{			height:'20%', 'background-color': $color
		}, 
			{
			duration: 10
			}
		)
	
	}
	,
	'mouseleave':function(){
		var $elem= $(this).parent();
		var $hover= $elem.find('div.hover');

		$hover.css('height','0%');	
	
	}
	
	});


			var $buttonAjouter = $('#buttonAjouter');
			var $ajouterContent = $('#ajouterContent');

			$buttonAjouter.click(function(){
				$('#modifierContent').hide(500);
				$ajouterContent.toggle('slow');
			});
	

});





</script>
</body>
</html>