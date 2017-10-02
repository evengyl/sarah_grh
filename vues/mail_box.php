<div class="col-sm-6 col-md-12" >
	<div class="thumbnail col-xs-12" style="padding-bottom:10px;">
		<div class="col-xs-12 pull-right ressource_now">
			<h3 class="title">&nbsp; Liste de vos message recu (vert), envoyer (rouge), lu (neutre)</h3>
			<table class="table table-stripped table-hover" style="color:white;">
				<tr class="success" style="color:black;">
					<th>N°</th>
					<th>Nom du Joueur</th>
					<th>Dernière connexion</th>
					<th>Heures de réception</th>
				</tr>
				<?
				foreach($list_user as $row_user)
				{?>
					<tr class="info" style="color:black;">
						<td><?= $row_user->position; ?></td>
						<td><?= $row_user->login; ?></td>
						<td><?= $row_user->last_connect; ?></td>
						<td><?= $row_user->point; ?></td>
					</tr>
					<tr class="info" style="color:black;">
						<td colspan="4">Message : 
							Liste de vos message recu (vert), envoyer (rouge), lu (neutre)Liste de vos message recu (vert), envoyer (rouge), lu (neutre)Liste de vos message recu (vert), envoyer (rouge), lu (neutre)
						</td>
					</tr>
					<tr><td></td></td><?
					
				}?>
			</table>
		</div>
	</div>
</div>