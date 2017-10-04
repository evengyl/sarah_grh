<div class="col-lg-12" >
	<div class=" col-xs-12" style="padding-bottom:10px;">
		<div class="col-xs-12 pull-right" id="todo_list">
			<h3 class="title">&nbsp; Liste de vos choses à faire</h3>
			<table id="table_list_todo" class="table table-stripped table-hover table-bordered table-responsibe" style="background:white;">
				<tr>
					<th>N°</th>
					<th>Titre</th>
					<th>A faire</th>
					<th></th>
				</tr>
				<?
				foreach($list_todo as $row_todo)
				{?>
					<tr class="<?=($row_todo->visible == 1)?'success':'danger'; ?>">
						<td ><?= $row_todo->id; ?></td>
						<td contenteditable="true" data-action="edit" data-column="todo_title" data-id="<?= $row_todo->id ?>"><?= $row_todo->todo_title; ?></td>
						<td contenteditable="true" data-action="edit" data-column="todo_content" data-id="<?= $row_todo->id ?>"><?= $row_todo->todo_content; ?></td>
						<td><?=($row_todo->visible == 1)?'<button data-id="'.$row_todo->id .'" data-action="suppression" class="btn btn-info">Valider comme Fait</button>':''; ?></td>
					</tr><?
				}?>
				<tr class="" style="display:none;">
					<td ><?= $row_todo->id+1; ?></td>
					<td contenteditable="true" data-action="edit" data-column="todo_title" data-id="<?= $row_todo->id+1 ?>"></td>
					<td contenteditable="true" data-action="edit" data-column="todo_content" data-id="<?= $row_todo->id+1 ?>"></td>
					<td></td>
				</tr>
			</table>
			<button data-id="<?= $row_todo->id; ?>" data-action="ajout" class="btn btn-info">Ajouter une chose à faire</button>
			<div style="width:10%; padding:5px; margin-right:15px; float:left;" class="alert alert-success" role="alert">à Faire</div>
			<div style="width:10%; padding:5px; float:left;" class="alert alert-danger" role="alert">Déjà faite</div>
		</div>
	</div>
</div>

