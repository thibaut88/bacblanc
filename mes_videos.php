<?php
session_start();
require 'BACBLANC/conf.php';

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
<link href="stylesheet.css"rel="stylesheet"type="text/css">
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
	
	// var_dump($_SESSION);
	$sql = "SELECT * FROM videos WHERE videos_id_pseudo = ".$_SESSION['id_user']."";
	$rep=mysqli_query($conn,$sql) or die(mysqli_error($conn));
	?>
	
		
		<div class="container">
		<div class="row">
				<h1>Mon espace : <small>mes vidéos</small></h1>
				
<?php while($row = mysqli_fetch_assoc($rep)){ 

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
	<div data-timestamp="<?=$timestamp?>"  data-categorie="categorie-<?=$row['videos_id_categorie']?>" class="col-sm-6 categorie categorie-<?=$row['videos_id_categorie']?> ">
		<h4><?=$row['titre_video']?></h4>
		<span>
		 <?=$row['url']?>
		  <div class="hover">
		  
 <button type="button" onclick="delete(<?=$row['id_video']?>)">supprimer</button>
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

$(document).ready(function(){
	var $option="";

	$('iframe').on({
		'mouseenter':function(){
		var $elem= $(this).parent();
		var $hover= $elem.find('div.hover');
		console.log($elem);
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
		$hover.animate({ height:'20%', 'background-color': $color
		}, 
			{
			duration: 10
			}
		);
	
	}
	,
	'mouseleave':function(){
		var $elem= $(this).parent();
		var $hover= $elem.find('div.hover');

		$hover.css('height','0%');	
	
	}
	});
	
		// $option.on('mouseover',function(){
			// alert("ok");
		// });
		
	
	
	
	
	
	
	
	
	
	
	
	
});

</script>
</body>
</html>