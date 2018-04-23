<?php
	require_once("php/class.php");

	/* Affichages selon la page demandée sur la page d'accueil */
	if(!isset($_SESSION["show"]) && !isset($_SESSION["edit"])){
		/* Affichage de la liste des entrées dans la table paramètre */
		$rep = $bdd->select("parametre", "id, libelle");
		?>
		<h1>Liste des enregistrements</h1>
<table class="table table-striped table-dark table-bordered">
	<thead class="thead-light">
		<tr>
			<th scope="col">ID</th>
			<th scope="col">Nom de l'enregistrement</th>
			<th scope="col">Voir / Modifier / Supprimer</th>
		</tr>
	</thead>
	<tbody><?php $i = 1;
			foreach($rep as $array){ ?>
		<tr>
			<th scope="row"><?php echo $i; ?></th>
			<td><?php echo $array["libelle"]; ?></td>
			<td>
				<div class="btn-group" role="group" aria-label="Bouttons d'actions">
					<button type="button" class="btn btn-light" onclick="showEntry(<?php echo $array["id"]; ?>);"><img src="./design/icons/si-glyph-document-search.svg" height="25px" width="auto"></button>
					<button type="button" class="btn btn-light" onclick="editEntry(<?php echo $array["id"]; ?>);"><img src="./design/icons/si-glyph-pencil.svg" height="25px" width="auto"></button>
					<button type="button" class="btn btn-light" onclick="deleteEntry(<?php echo $array["id"]; ?>);"><img src="./design/icons/si-glyph-trash.svg" height="25px" width="auto"></button>
				</div>
			</td>
		</tr>
				<?php $i++;
			} ?>
	</tbody>
</table>
		<?php
	} else if(isset($_SESSION["show"])){
		/* Affichage des informations spécifiques au paramètre demandé */
		$rep = $bdd->select("parametre", "*", "WHERE id=".$_SESSION["show"]);
		$rep = $rep[0];

		$i = 0;

		foreach($rep as $key => $val){
			$keys[$i] = $key;
			$keys[$key] = $key;
			$vals[$i] = $val;
			$vals[$key] = $val;
			$i++;
		}
		?>
<h1>Informations sur le paramètre</h1>
<table class="table table-striped table-dark table-bordered">
	<caption>Enregistrement : <?php echo $rep["libelle"]; ?> fait le <?php echo $rep["date"]; ?></caption>
	<thead>
		<tr>
			<th scope="col">Paramètre</th>
			<th scope="col">Valeur</th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<th scope="row">Longueur de la corde</th>
			<td><?php echo $vals["corde"]; ?> mm</td>
		</tr>
		<tr>
			<th scope="row">Tmax</th>
			<td><?php echo $vals["tmaxmm"]; ?> mm (<?php echo $vals["tmax"]; ?>%)</td>
		</tr>
		<tr>
			<th scope="row">Fmax</th>
			<td><?php echo $vals["fmaxmm"]; ?> mm (<?php echo $vals["fmax"]; ?>%)</td>
		</tr>
		<tr>
			<th scope="row">Nombre de points</th>
			<td><?php echo $vals["nb_points"]; ?> points</td>
		</tr>
		<tr>
			<th scope="row">Image du graphique</th>
			<td><a href="./design/img/<?php echo $vals["fic_img"]; ?>"><img id="graphic" src="./design/img/<?php echo $vals["fic_img"]; ?>" /></a></td>
		</tr>
		<tr>
			<th scope="row">Fichier CSV</th>
			<td><a href="./csv/<?php echo $vals["fic_csv"]; ?>"><img src="./design/icons/si-glyph-file-download.svg" height="25px" width="auto"></a></td>
		</tr>
	</tbody>
</table>
		<?php
	} else if(isset($_SESSION["edit"])){
		/* Affichage de la page d'édition du paramètre demandé */
		$rep = $bdd->select("parametre", "*", "WHERE id=".$_SESSION["edit"]);
		$rep = $rep[0];
		?>
<?php require_once("php/paramForm.inc"); ?>
<script>
	complete = true;
	var libelle = '<?php echo $rep["libelle"]; ?>';
	var corde = <?php echo $rep["corde"]; ?>;
	var tmax = <?php echo $rep["tmax"]; ?>;
	var fmax = <?php echo $rep["fmax"]; ?>;
	var nbpts = <?php echo $rep["nb_points"]; ?>;
	var inter = <?php echo "0"; ?>;
</script>
		<?php
	}
