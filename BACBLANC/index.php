<?php
session_start();
require 'conf.php';
var_dump($_SESSION);

if(empty($_SESSION)){
	//SI PAS DE SESSION 
	//SI USER PAS CONNECTED
$_SESSION['LOGGED'] = false;
$_SESSION['ROLE'] = 0;

$LOGGED = $_SESSION['LOGGED'];
$ROLE = $_SESSION['ROLE'];
}else{
	//SI DEJA CONNECTED
$LOGGED = $_SESSION['LOGGED'];
$ROLE = $_SESSION['ROLE'];
}

	if(isset($_POST)&&!empty($_POST['logIn'])){

	$password = (isset($_POST['password'])&&!empty($_POST['password']))? $_POST['password'] : "";
	$email = (isset($_POST['email'])&&!empty($_POST['email']))? $_POST['email'] : "";
	
	$usersAll = "SELECT 
	`id_user`,`name`,
	`pseudo`,`password`,
	`email`,`users_id_role`,
	`id_role`,`nom_role` 
	FROM `users`
	LEFT JOIN `roles` ON users.users_id_role = roles.id_role
	WHERE password = '$password' AND email = '$email'
	";
	
	$result = mysqli_query($conn, $usersAll);
	
	if(mysqli_num_rows($result)>0){
		$row=mysqli_fetch_assoc($result);
			//SI PASS && EMAIL CORRESPONDENT
		
				session_destroy();
				session_start();
				$_SESSION['LOGGED'] = true;
				$_SESSION['id_user'] = (int) $row['id_user'];
				$_SESSION['name'] = (string)$row['name'];
				$_SESSION['pseudo'] = (string)$row['pseudo'];
				$_SESSION['password'] = (string)$row['password'];
				$_SESSION['email'] = (string)$row['email'];
				$_SESSION['ROLE'] = (int) $row['users_id_role'];
				$_SESSION['nom_role'] = (string) $row['nom_role'];
				
				$LOGGED = $_SESSION['LOGGED'];
				$ROLE = $_SESSION['ROLE'];
	
	
	}else{
		if($_SESSION['ROLE'] == 0){
			$erreur = "le mot de passe ou l'email ne correspondent pas";

		}

		
	}
	
	}


	define('LOGGED',$LOGGED);
	define('ROLE',$ROLE);

?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <title>BAC Blanc</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.5/js/bootstrap.min.js" integrity="sha384-BLiI7JTZm+JWlgKa0M0kGRpJbF2J8q+qreVrKBC47e3K6BW78kGLrCkeRX6I9RoK" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js" integrity="sha384-3ceskX3iaEnIogmQchP8opvBy3Mi7Ce34nWjpBIwVTHfGYWQS9jwHDVRnpKKHJg7" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.3.7/js/tether.min.js" integrity="sha384-XTs3FgkjiBgo8qjEjBk0tGmf3wPrWtA6coPfQDfFEY8AnYJwjalXCiosYRBIBZX8" crossorigin="anonymous"></script>	
<link href="stylesheet.css"rel="stylesheet"type="text/css">
</head>
<body>

<?php
require 'menu.php';

	// SI USER IS LOGGED
if(LOGGED){  
	//SI USER ROLE == ADMIN
	if(ROLE == 2){ ?>
		
		<div class="container">
				<h1>Bac blanc</h1>
		</div>
<?php
} 
} 
else{
?>
	<div class="container">

<h2>Connectez-vous <small>pour voir les commentaires !</small></h2>

	<!-- FORMULAIRE CONNECTION -->
	<div class="col-md-6 offset-md-6">
<form  method="post" action="index.php">
  <div class="form-group">
    <label for="email">Email:</label>
    <input name="email"type="email" class="form-control" id="email">
  </div>
  <div class="form-group">
    <label for="password">mot de passe:</label>
    <input name="password" type="password" class="form-control" id="password">
  </div>
  <div class="checkbox">
    <label><input type="checkbox">Se rappeler de moi</label>
  </div>
  <input type="submit" name="logIn"class="btn btn-default"value="valider">
</form>

<h2><?phpif(isset($erreur)){echo $erreur;}?></h2>
</div>
</div><!-- CONTAINER FORMULAIRE -->
 <?php
 }
 ?> 


</html>