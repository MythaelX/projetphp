<?php
	require_once("php/class.php");
	
	/* Affichages selon la page demandée sur la page d'accueil */
	if(!isset($_SESSION["show"]) && !isset($_SESSION["edit"])){
		/* Affichage de la liste des entrées dans la table paramètre */
		$rep = $bdd->select("parametre", "id, libelle");
		?>
<table class="table table-striped">
	<caption>Liste des enregistrements</caption>
	<thead>
		<tr>
			<th scope="col">#</th>
			<th scope="col">Nom de l'enregistrement</th>
			<th scope="col">Actions</th>
		</tr>
	</thead>
	<tbody><?php $i = 1;
			foreach($rep as $array){ ?>
		<tr>
			<th scope="row"><?php echo $i; ?></th>
			<td><?php echo $array["libelle"]; ?></td>
			<td>
				<div class="btn-group" role="group" aria-label="Bouttons d'actions">
					<button type="button" class="btn btn-primary" onclick="showEntry(<?php echo $array["id"]; ?>);"><i class="glyphicon glyphicon-search"></i></button>
					<button type="button" class="btn btn-primary" onclick="editEntry(<?php echo $array["id"]; ?>);"><i class="glyphicon glyphicon-pencil"></i></button>
					<button type="button" class="btn btn-primary" onclick="deleteEntry(<?php echo $array["id"]; ?>);"><i class="glyphicon glyphicon-trash"></i></button>
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
<table class="table table-striped">
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
			<td><?php echo $vals["fmaxmm"]; ?> mm (<?php echo $vals["tmax"]; ?>%)</td>
		</tr>
		<tr>
			<th scope="row">Nombre de points</th>
			<td><?php echo $vals["nb_points"]; ?> points</td>
		</tr>
		<tr>
			<th scope="row">Image du graphique</th>
			<td><a href="<?php echo $vals["fic_img"]; ?>"><i class="glyphicon glyphicon-download-alt"></i></a></td>
		</tr>
		<tr>
			<th scope="row">Fichier CSV</th>
			<td><a href="<?php echo $vals["fic_csv"]; ?>"><i class="glyphicon glyphicon-download-alt"></i></a></td>
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
	var complete = true;
	var libelle = '<?php echo $rep["libelle"]; ?>';
	var corde = <?php echo $rep["corde"]; ?>;
	var tmax = <?php echo $rep["tmax"]; ?>;
	var fmax = <?php echo $rep["fmax"]; ?>;
	var nbpts = <?php echo $rep["nb_points"]; ?>;
	var inter = <?php echo "0"; ?>;
</script>
		<?php
	}
