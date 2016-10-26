<nav class="navbar navbar-inverse">
  <div class="container-fluid ">
    <div class="navbar-header ">
      <a class="navbar-brand" href="index.php">BAC BLANC</a>
    </div>
    <ul class="nav navbar-nav">
	  
	  <?php
	  if(ROLE==2){
		  ?>
	<li><a href="../mes_videos.php">Mes vidéos</a></li> 	
	<?php
	} 
	?>
	<li><a href="videos_all.php">Vidéos</a></li>
	<li><a href="register.php">Inscription</a></li>
	  <?php
	  if(LOGGED){
		  ?>
	<li><a href="deconnection.php">Deconnection</a></li> 	  
		  <?php
		}
		?>
    </ul>
  </div>
</nav>
