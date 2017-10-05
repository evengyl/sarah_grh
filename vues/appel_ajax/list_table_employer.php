<table id="table_list_employer" style="background:white; color:black;" class="table table-hover table-responsive table-striped table-bordered">
	<tr>
		<th style="width:2%;">Id</th>
		<th style="width:5%;">Nom</th>
		<th style="width:6%;">Prénom</th>
		<th style="width:8%;">GSM</th>
		<th style="width:2%;">Age</th>
		<th style="width:7%;">Habite</th>
		<th style="width:15%;">Shop le plus proche n°1</th>
		<th style="width:15%;">Shop le plus proche n°2</th>
		<th style="width:15%;">Shop le plus proche n°3</th>
		<th style="width:15%;">Shop le plus proche n°4</th>
		<th style="width:10%;">Option</th>
	</tr><?
	if(!empty($list_employer))
	{
		foreach($list_employer as $employer)
		{?>
			<tr>
				<td><b><?= $employer->id ?></b></td>
				<td contenteditable="true" data-action="edit" data-column="prenom" data-id="<?= $employer->id ?>"><?= $employer->prenom ?></td>
				<td contenteditable="true" data-action="edit" data-column="nom" data-id="<?= $employer->id ?>"><?= $employer->nom ?></td>
				<td contenteditable="true" data-action="edit" data-column="gsm" data-id="<?= $employer->id ?>"><?= $employer->gsm ?></td>
				<td contenteditable="true" data-action="edit" data-column="age" data-id="<?= $employer->id ?>"><?= $employer->age ?></td>
				<td contenteditable="true" data-action="edit" data-column="habite" data-id="<?= $employer->id ?>"><?= $employer->habite ?></td>
				
				<td contenteditable="true" data-action="edit_shop" 
											data-column="id_shop_proche_1" 
											data-id-employer="<?= $employer->id ?>" 
											data-id-shop="<?= $employer->shop_proche_1['id'] ?>" 
											style="background-color:<?= $employer->shop_proche_1['color_id_shop_1'] ?>;"><?= $employer->shop_proche_1['nom_shop_1'] ?></td>

				<td contenteditable="true" data-action="edit_shop" 
											data-column="id_shop_proche_2" 
											data-id-employer="<?= $employer->id ?>" 
											data-id-shop="<?= $employer->shop_proche_2['id'] ?>" 
											style="background-color:<?= $employer->shop_proche_2['color_id_shop_2'] ?>;"><?= $employer->shop_proche_2['nom_shop_2'] ?></td>

				<td contenteditable="true" data-action="edit_shop" 
											data-column="id_shop_proche_3" 
											data-id-employer="<?= $employer->id ?>" 
											data-id-shop="<?= $employer->shop_proche_3['id'] ?>" 
											style="background-color:<?= $employer->shop_proche_3['color_id_shop_3'] ?>;"><?= $employer->shop_proche_3['nom_shop_3'] ?></td>

				<td contenteditable="true" data-action="edit_shop" 
											data-column="id_shop_proche_4" 
											data-id-employer="<?= $employer->id ?>" 
											data-id-shop="<?= $employer->shop_proche_4['id'] ?>" 
											style="background-color:<?= $employer->shop_proche_4['color_id_shop_4'] ?>;"><?= $employer->shop_proche_4['nom_shop_4'] ?></td>

				<td>
					<button data-id="<?= $employer->id ?>" data-action="suppression" class="btn btn-danger">Supprimer L'employé</button>
				</td>
			</tr><?
		}
	}else
	{
		echo "<div class='col-lg-12 alert alert-danger' role='alert'>Il n'y aucun employé dans la base de donnée veuillez en creez un</div>";
	}?>
</table>
<div data-id="<?= $employer->id ?>" data-action="ajout" class="btn btn-info">Ajouter un employé</div>