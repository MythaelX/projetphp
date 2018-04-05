<?php
	if(!isset($_SESSION["show"]) && !isset($_SESSION["edit"])){
		?>
<?php
	$rep = $bdd->select("parametre", "id, libelle");
?>
<table class="table table-bordered table-striped">
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
		?>

		<?php
	} else if(isset($_SESSION["edit"])){
		?>

		<?php
	}
