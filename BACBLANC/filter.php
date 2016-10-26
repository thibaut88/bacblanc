			<div class="col-sm-2"> 
			<div  id="filterDiv">
				<center><h2>Trier:</h2></center><center>
				<center><h4>catégorie:</h4></center><center>
				<a href="videos_all.php"><button type="button" onclick="filterCat('all')">TOUT</button></a>
				<button type="button" onclick="filterCat('categorie-1')">MUSIQUE</button>
				<button type="button" onclick="filterCat('categorie-2)">RAP</button>
				<button type="button" onclick="filterCat('categorie-3)">ROCK</button>
				<button type="button" onclick="filterCat('categorie-5')">BLUES</button>
				<button type="button" onclick="filterCat('categorie-4')">METAL</button>
				<center><h4>date:</h4></center><center>
				<button type="button" onclick="filterDate('ASC',this)">DATE ASC</button>
				<button type="button" onclick="filterDate('DESC',this)">DATE DESC</button>
				</center>
				
				<div class="form-group">
				<h4>titre:</h4>
					<input type="text" class="form-control" name="search"placeholder="Search">
				  </div>		
			</div><!-- filterDIV-->
			</div><!-- COL-3-->