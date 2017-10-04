<div class='col-lg-12' id='date_picker'></div>

<div class="col-lg-12" >
	<div class=" col-xs-12" style="padding-bottom:10px;">
		<div class="col-xs-12 pull-right" id="todo_list">
			<h3 class="title">&nbsp; Liste de vos choses à faire</h3>
				<table id="table_list_todo" class="table table-stripped table-hover table-bordered table-responsibe" style="background:white;">
					<tr>
						<th style="width:5%;">N°</th>
						<th style="width:20%;">Titre</th>
						<th style="width:45%;">A faire</th>
						<th style="width:15%;">Date de création</th>
						<th style="width:15%;">Option</th>
					</tr><?
					if(!empty($list_todo))
					{
						foreach($list_todo as $row_todo)
						{?>
							<tr class="<?=($row_todo->visible == 1)?'success':'danger'; ?>">
								<td ><?= $row_todo->id; ?></td>
								<td contenteditable="true" data-action="edit" data-column="todo_title" data-id="<?= $row_todo->id ?>"><?= $row_todo->todo_title; ?></td>
								<td contenteditable="true" data-action="edit" data-column="todo_content" data-id="<?= $row_todo->id ?>"><?= $row_todo->todo_content; ?></td>
								<td contenteditable="true" data-action="edit" data-column="date" data-id="<?= $row_todo->id ?>"><?= $row_todo->date; ?></td>
								<td><?=($row_todo->visible == 1)?'<button data-id="'.$row_todo->id .'" data-action="suppression" class="btn btn-info">Valider comme Fait</button>':''; ?></td>
							</tr><?
						}
					}
					else
					{
						echo "<div class='col-lg-12 alert alert-danger' role='alert'>Il n'y plus rien à faire pour le moment à cette date ci</div>";
					}?>
				</table>
			<div class="col-lg-4 alert alert-info" style="cursor:pointer;" data-action="ajout">Ajouter une chose à faire</div>
			<div class="col-lg-2">&nbsp;</div>
			<div class="col-lg-3 alert alert-success">à Faire</div>
			<div class="col-lg-3 alert alert-danger">Déjà faite</div>
		</div>
	</div>
</div>




<script>
	//mise en route du calendrier
	$( "#date_picker" ).datepicker();
	$( "#date_picker" ).datepicker( "option", "yearRange", "2000:2050" );
	$( "#date_picker" ).datepicker( "option", "weekHeader", "N° Semaine" );
	$( "#date_picker" ).datepicker( "option", "dateFormat", "dd-mm-yy" );

	


	$(document).ready(function()
	{
		//attribution des pastile de couleur pour chaque date sur le calendirer
		   <?php
		        $list = '"'.implode('","',$list_date).'"';
		    ?>
		    var list_date = new Array(<?php echo $list ?>);
    	//en pause car pas d'idée pour mettre la petit puce sur les jours 


		//dès que l'on change de date on envoi la date par ajax pour recuperer la liste des todo du jour selctionner
		$("#date_picker").on('change', function(){
			console.log($('#date_picker')[0].value);


			$.post("../app/controller/controller_ajax/admin_todo_list.php", {"action":"list_with_date", "current_select_date":$('#date_picker')[0].value}, function( data_return )
			{
	        	$("#todo_list").html( data_return );
	    	});	
		});
	


		$("#todo_list").on('blur', "td[data-action='edit']",function()
		{

			$(this).addClass("loading");

			$.ajax({
				url: "../app/controller/controller_ajax/admin_todo_list.php",
				type: "POST",
				data:'column='+$(this).attr("data-column")+'&editval='+this.innerHTML+'&id='+$(this).attr("data-id")+'&current_date='+$('#date_picker')[0].value+'&action=edit',
				success: function(data){
					$(this).removeClass("loading").removeClass("danger");

					$(this).addClass("validate").delay(1000).queue(function(next){
						$(this).removeClass("validate");
						next();
						$.post("../app/controller/controller_ajax/admin_todo_list.php", {"action":"list_with_date", "current_select_date":$('#date_picker')[0].value}, function( data_return )
						{
				        	$("#todo_list").html( data_return );
				    	});
					});
				}        
		   });
		});


		$("#todo_list").on('click', "button[data-action='suppression']", function()
		{
			if(confirm("Avez bien fait cette tâche ?"))
			{
				var current_select = $(this);
				$.ajax({
					url: "../app/controller/controller_ajax/admin_todo_list.php",
					type: "POST",
					data:'id='+current_select.attr("data-id")+'&action=delete',
					success: function(data_return){
						$.post("../app/controller/controller_ajax/admin_todo_list.php", {"action":"list_with_date", "current_select_date":$('#date_picker')[0].value}, function( data_return )
						{
				        	$("#todo_list").html( data_return );
				    	});;
					}
		   		});
			}
		});

		$("#todo_list").on('click', "div[data-action='ajout']", function()
		{
			var current_select = $(this);
			console.log($('#date_picker')[0].value);
			$.post("../app/controller/controller_ajax/admin_todo_list.php", {"action":"get_last_id"}, function( data_return )
			{
	        	$("#table_list_todo").append('<tr>'+
												'<td >'+data_return+'</td>'+
												'<td contenteditable="true" data-action="edit" data-column="todo_title" data-id="'+data_return+'"></td>'+
												'<td contenteditable="true" data-action="edit" data-column="todo_content" data-id="'+data_return+'"></td>'+
												'<td></td>'+
											'</tr>');

        	//remettre le new block a jour pour ajouter 
			$('#table_list_todo tr').last().addClass('success');
			$('#table_list_todo tr td').last().html($('#date_picker')[0].value);
						
	    	});
			
		});
	});
</script>