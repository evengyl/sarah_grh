<div class="col-xs-10 col-lg-offset-1 col-without-padding">	
	<div class="col-xs-12">
		<div class="col-xs-12" id='table_list_employer' style="padding:0px;">
			<table style="background:white;" class="table table-hover table-responsive table-striped table-bordered"><?
				$affiche_th = 1;
				if(!empty($list_employer))
				{
					foreach($list_employer as $employer)
					{
						if($affiche_th != 0)
						{
							echo "<tr>";
								foreach($employer as $key => $row)
								{
									echo "<th>".$key."</th>";
								}?>
								<th>Option</th>
							</tr>
							<?
							$affiche_th = 0;
						}?>

						<tr>
							<td><b><?= $employer->id ?></b></td>
							<td contenteditable="true" data-action="edit" data-column="nom" data-id="<?= $employer->id ?>"><?= $employer->nom ?></td>
							<td contenteditable="true" data-action="edit" data-column="prenom" data-id="<?= $employer->id ?>"><?= $employer->prenom ?></td>
							<td contenteditable="true" data-action="edit" data-column="gsm" data-id="<?= $employer->gsm ?>"><?= $employer->gsm ?></td>
							<td contenteditable="true" data-action="edit" data-column="age" data-id="<?= $employer->id ?>"><?= $employer->age ?></td>
							<td contenteditable="true" data-action="edit" data-column="habite" data-id="<?= $employer->id ?>"><?= $employer->habite ?></td>
							<td contenteditable="true" data-action="edit" data-column="travail" data-id="<?= $employer->id ?>"><?= $employer->travail ?></td>

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
			<button data-id="<?= $employer->id ?>" data-action="ajout" class="btn btn-info">Ajouter un employé</button>
		</div>
	</div>
</div>



