<div class="col-xs-10 col-lg-offset-1 col-without-padding">	
	<div class="col-xs-12">
		<div class="col-xs-12" style="padding:0px;">
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
							<td><?= $employer->id ?></td>
							<td class="employer" contenteditable="true" data-column="nom" data-id="<?= $employer->id ?>"><?= $employer->nom ?></td>
							<td class="employer" contenteditable="true" data-column="prenom" data-id="<?= $employer->id ?>"><?= $employer->prenom ?></td>
							<td class="employer" contenteditable="true" data-column="age" data-id="<?= $employer->id ?>"><?= $employer->age ?></td>
							<td class="employer" contenteditable="true" data-column="habite" data-id="<?= $employer->id ?>"><?= $employer->habite ?></td>
							<td class="employer" contenteditable="true" data-column="travail" data-id="<?= $employer->id ?>"><?= $employer->travail ?></td>

							<td>
								<button class="btn btn-danger">Supprimer L'employé</button>
							</td>
						</tr><?
					}
				}else
				{
					echo "<div class='col-lg-12 alert alert-danger' role='alert'>Il n'y aucun employé dans la base de donnée veuillez en creez un</div>";
				}?>

				
			</table>

		</div>
	</div>
</div>


<script>


$(document).ready(function(){
	$(".employer").on('blur', function(){

		$(this).addClass("loading");
		var current_select = $(this);
		$.ajax({
			url: "../app/controller/controller_ajax/list_employer.php",
			type: "POST",
			data:'column='+current_select.attr("data-column")+'&editval='+this.innerHTML+'&id='+current_select.attr("data-id"),
			success: function(data){
				current_select.removeClass("loading").removeClass("danger");

				current_select.addClass("success validate").delay(1000).queue(function(next){
					current_select.removeClass("success validate");
					next();
				});
			}        
	   });
	});


	$(".employer").on('click', function(){
		$(this).removeClass("success").addClass("danger");
	});

});

</script>
