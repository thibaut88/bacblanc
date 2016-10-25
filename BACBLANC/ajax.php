<?php


$url=(isset($_GET['url']))?$_GET['url']:'';

$conn=mysqli_connect('localhost','admin','admin','bacblanc');
$sql="SELECT * FROM videos WHERE titre_video LIKE '%".$url."%'";
$rep=mysqli_query($conn,$sql);
$d=array();
while($row=mysqli_fetch_assoc($rep)){
	
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
	
	
		<div data-timestamp="<?=$timestamp?>"class="categorie categorie-<?=$row['videos_id_categorie']?> row">
	<div class="col-sm-6">

		<h2><?=$row['titre_video']?></h2>
		
		 <?=$row['url']?>
		
      <button type="submit" onclick="show('description-<?=$row['id_video']?>',this)" class="btn btn-default">voir plus d'infos</button>
		
		 <div id="description-<?=$row['id_video']?>"class="description description-<?=$row['id_video']?>">
		 <?=$row['description']?>
		 </div>
	</div>	
	</div>	
	
	<?php

}

?>