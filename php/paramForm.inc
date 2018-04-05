<form method="post" class="container" action="php/database.php">
	<div class="form-group">
		<label for="libelle">Intitulé :</label><br />
		<input type="text" class="form-control" name="libelle" />
	</div>
	<div class="form-group">
		<label for="corde">Taille de la corde (en mm):</label><br />
		<input type="number" class="form-control" name="corde" />
	</div>
	<div class="form-group">
		<div class="form-group" style="display: inline-block; width: 50%;">
			<label for="tmax">Tmax (en %) :</label><br />
			<input type="number" class="form-control" name="tmax" />
		</div>
		<div class="form-group" style="display: inline-block; width: 45%;">
			<label for="fmax">Fmax (en %) :</label><br />
			<input type="number" class="form-control" name="fmax" />
		</div>
	</div>
	<div class="form-group">
		<div class="form-group" style="display: inline-block; width: 50%;">
			<label for="nb_points">Nombre de points pour les calculs :</label><br />
			<input type="number" class="form-control" name="nb_points" />
		</div>
		<div class="form-group" style="display: inline-block; width: 45%;">
			<label for="interval">Interval entre les points:</label><br />
			<input type="number" class="form-control" name="interval" />
		</div>
	</div>
	<input type="submit" value="Envoyer" />
</form>
