<?php
session_start();
require 'conf.php';
var_dump($_SESSION);

if(empty($_SESSION)){
$_SESSION['LOGGED'] = false;
$_SESSION['ROLE'] = 0;

$LOGGED = $_SESSION['LOGGED'];
$ROLE = $_SESSION['ROLE'];

}else{
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
	LEFT JOIN `roles` ON users.users_id_role = roles.id_role";
	
	$result = mysqli_query($conn, $usersAll);
	
	if(mysqli_num_rows($result)>0){
		while($row = mysqli_fetch_assoc($result)){
			if($row['password']==$password&&$row['email']==$email)
			{
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
			}
		}
	}else{
		echo "il n'y a pas d'utilisateurs";
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <link href="stylesheet.css"rel="stylesheet"type="text/css">
</head>
<body>

<?php
require 'menu.php';

	// USER LOGGED TRUE
if(LOGGED){  
	//USER ROLE ADMIN
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

<h1>Connectez-vouz pour voir les commentaires !</h1>
	<!-- FORMULAIRE CONNECTION -->
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

<h2></h2>




	</div><!-- CONTAINER FORMULAIRE -->
 <?php
 }
 ?> 


</html>