<div class="col-xs-10 col-lg-offset-1 col-without-padding">	
	<div class="col-xs-12">
		<div class="col-xs-12" style="padding:0px;" id="employer_list">
			<table id="table_list_employer" style="background:white;" class="table table-hover table-responsive table-striped table-bordered"><?
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
							<td contenteditable="true" data-action="edit" data-column="gsm" data-id="<?= $employer->id ?>"><?= $employer->gsm ?></td>
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
			<div data-id="<?= $employer->id ?>" data-action="ajout" class="btn btn-info">Ajouter un employé</div>
		</div>
	</div>
</div>



<script>
$(document).ready(function()
{
	$("td[data-action='edit']").on('click', function()
	{
		$(this).removeClass("success").addClass("danger");
	});

	$("#table_list_employer").on('blur', "td[data-action='edit']",function()
	{
		$(this).addClass("loading");
		var current_select = $(this);
		
		$.ajax({
			url: "../app/controller/controller_ajax/admin_employer.php",
			type: "POST",
			data:'column='+$(this).attr("data-column")+'&editval='+this.innerHTML+'&id='+$(this).attr("data-id")+'&action=edit',
			success: function(data){
				current_select.removeClass("loading").removeClass("danger");

				current_select.addClass("success validate").delay(1000).queue(function(next){
					current_select.removeClass("success validate");
					next();
				});
			}        
	   });
	});


	$("#employer_list").on('click', "button[data-action='suppression']", function()
	{
		if(confirm("êtes vous sur de vouloir supprimer l'employer de la liste ?"))
		{
			var current_select = $(this);
			$.ajax({
				url: "../app/controller/controller_ajax/admin_employer.php",
				type: "POST",
				data:'id='+current_select.attr("data-id")+'&action=delete',
				success: function(data_return){
					$.post("../app/controller/controller_ajax/admin_employer.php", {"action":"list"}, function( data_return )
					{
			        	$("#employer_list").html(data_return);
			    	});
				}
	   		});
		}
			
	});


	$("#employer_list").on('click', "div[data-action='ajout']", function()
	{
		var current_select = $(this);
		if(confirm("êtes vous sur de vouloir ajouter un employer de la liste ?"))
		{

			$.post("../app/controller/controller_ajax/admin_employer.php", {"action":"get_last_id"}, function( data_return )
			{
        		$("#table_list_employer").append('<tr><td><b>'+data_return+'</b></td>'+
												'<td contenteditable="true" data-action="edit" data-column="nom" data-id="'+data_return+'"></td>'+
												'<td contenteditable="true" data-action="edit" data-column="prenom" data-id="'+data_return+'"></td>'+
												'<td contenteditable="true" data-action="edit" data-column="gsm" data-id="'+data_return+'"></td>'+
												'<td contenteditable="true" data-action="edit" data-column="age" data-id="'+data_return+'"></td>'+
												'<td contenteditable="true" data-action="edit" data-column="habite" data-id="'+data_return+'"></td>'+
												'<td contenteditable="true" data-action="edit" data-column="travail" data-id="'+data_return+'"></td>'+
											'<td></td></tr>');

    			//remettre le new block a jour pour ajouter 
				$('#table_list_employer tr').last().addClass('success');
					
    		});
		}
	});
});
</script>