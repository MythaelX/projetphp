<form method="post" class="container" action="php/database.php">
	<div class="form-group">
		<label for="libelle">Intitulé :</label><br />
		<input type="text" class="form-control" name="libelle" id="libelle" />
	</div>
	<div class="form-group">
		<label for="corde">Taille de la corde (en mm):</label><br />
		<input type="number" min=0 step=0.1 class="form-control" name="corde" id="corde" />
	</div>
	<div class="form-group">
		<div class="form-group" style="display: inline-block; width: 50%;">
			<label for="tmax">Tmax (en %) :</label><br />
			<input type="number" min=0 max=100 step=0.1 class="form-control" name="tmax" id="tmax" />
		</div>
		<div class="form-group" style="display: inline-block; width: 45%;">
			<label for="fmax">Fmax (en %) :</label><br />
			<input type="number" min=0 max=100 step=0.1 class="form-control" name="fmax" id="fmax" />
		</div>
	</div>
	<div class="form-group">
		<div class="form-group" style="display: inline-block; width: 50%;">
			<label for="nb_points">Nombre de points pour les calculs :</label><br />
			<input type="number" min=0 step=1 class="form-control" name="nb_points" id="nb_points" />
		</div>
		<div class="form-group" style="display: inline-block; width: 45%;">
			<label for="interval">Interval entre les points:</label><br />
			<input type="number" min=0 step=0.1 class="form-control" name="interval" id="interval" />
		</div>
	</div>
	<input type="hidden" name="action" value="<?php
		$action = "";
		
		if(isset($_GET["action"])){
			$action = $_GET["action"];	
		} else {
			$action = $_POST["action"];
		}
		
		echo $action;
	?>" />
	<?php
		if(isset($_POST["id_param"])){
			?>
			<input type="hidden" name="id_param" value="<?php echo $_POST["id_param"]; ?>" />
			<?php
		}
	?>
	<input type="submit" class="btn btn-success" value="Envoyer" />
</form>
