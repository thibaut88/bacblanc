<?php
if(!empty($_POST['id'])&&!empty($_POST['pass'])){
	$pass = (string) $_GET['pass'];
	$id = (int)$_GET['id'];
	

$conn = mysqli_connect('localhost','admin','admin','bacblanc');
$sql = "SELECT * FROM videos 
WHERE id_video = $id AND
password_load = '$pass'";

if(($rep=mysqli_query($conn,$sql))>0){
	$data['result'] =mysqli_fetch_assoc($rep);
	$data['is_ok']=true;
	echo "ok";
}else{
	$data['is_ok']=false;
	echo "pasok";
}
// echo $data;

}else{
		echo "erreur";
}
?>