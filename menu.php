<nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="index.php">BAC BLANC</a>
    </div>
    <ul class="nav navbar-nav">
	  
	  <?php
	  if(ROLE==2){
		  ?>
	<li><a href="#">Page 1</a></li> 	
	<?php
	} 
	?>
	<li><a href="videos_all.php">Vidéos</a></li>
      <li><a href="#">Page 2</a></li> 
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
