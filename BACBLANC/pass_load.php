<?php
if(!empty($_GET['id'])&&!empty($_GET['pass'])){
	$pass = (string) $_GET['pass'];
	$id = (int)$_GET['id'];
	

$conn = mysqli_connect('localhost','admin','admin','bacblanc');
$sql = "SELECT * FROM videos 
WHERE id_video = $id AND
password_load = '$pass'";
$rep = mysqli_query($conn,$sql);
if(mysqli_num_rows($rep)>0){
	$data['result'] =mysqli_fetch_assoc($rep);
	$data['is_ok']=true;
	// echo "ok";
}else{
	$data['is_ok']=false;
	// echo "pasok";
}
// echo $data;
// echo json_encode($data);

}else{
		// echo "<p>erreur</p>";
}
?>