<div class="col-xs-10 col-without-padding">	
	<div class="col-xs-12">
		<div class="col-xs-12" style="padding:0px;" id="employer_list">
			<table id="table_list_employer" style="background:white; color:black;" class="table table-hover table-responsive table-striped table-bordered">
				<tr>
					<th style="width:20%;">Nom</th>
					<th style="width:10%;">GSM</th>
					<th style="width:10%;">Habite</th>
					<th style="width:10%;">Lundi</th>
					<th style="width:10%;">Mardi</th>
					<th style="width:10%;">Mercredi</th>
					<th style="width:10%;">Jeudi</th>
					<th style="width:10%;">Vendredi</th>
					<th style="width:10%;">Samedi</th>
				</tr><?
				if(!empty($horraires))
				{
					foreach($horraires as $employer)
					{?>
						<tr>
							<td><?= $employer->nom ?></td>

							<td><?= $employer->gsm ?></td>

							<td><?= $employer->habite ?></td>
							
							<td contenteditable="true"  
									data-action="edit" 
									data-jour="lundi"
									data-id-employer="<?= $employer->id ?>" 
									data-id-shop="<?= $employer->horraire['lundi']['id_shop'] ?>" 
									style="background-color:<?= $employer->horraire['lundi']['couleur_shop'] ?>;">
							</td>

							<td contenteditable="true"  
									data-action="edit" 
									data-jour="mardi" 
									data-id-employer="<?= $employer->id ?>" 
									data-id-shop="<?= $employer->horraire['mardi']['id_shop'] ?>" 
									style="background-color:<?= $employer->horraire['mardi']['couleur_shop'] ?>;">
							</td>

							<td contenteditable="true"  
									data-action="edit" 
									data-jour="mercredi" 
									data-id-employer="<?= $employer->id ?>" 
									data-id-shop="<?= $employer->horraire['mercredi']['id_shop'] ?>" 
									style="background-color:<?= $employer->horraire['mercredi']['couleur_shop'] ?>;">
							</td>

							<td contenteditable="true"  
									data-action="edit" 
									data-jour="jeudi" 
									data-id-employer="<?= $employer->id ?>" 
									data-id-shop="<?= $employer->horraire['jeudi']['id_shop'] ?>" 
									style="background-color:<?= $employer->horraire['jeudi']['couleur_shop'] ?>;">
							</td>

							<td contenteditable="true"  
									data-action="edit"
									data-jour="vendredi" 
									data-id-employer="<?= $employer->id ?>" 
									data-id-shop="<?= $employer->horraire['vendredi']['id_shop'] ?>" 
									style="background-color:<?= $employer->horraire['vendredi']['couleur_shop'] ?>;">
							</td>

							<td contenteditable="true"  
									data-action="edit" 
									data-jour="samedi" 
									data-id-employer="<?= $employer->id ?>" 
									data-id-shop="<?= $employer->horraire['samedi']['id_shop'] ?>" 
									style="background-color:<?= $employer->horraire['samedi']['couleur_shop'] ?>;">
							</td>

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

<div class="col-lg-2"><?
	foreach($list_shop as $row_shop)
	{
		?><div class="col-lg-12" style="color:black; text-align:center; padding:9px; background:<?= $row_shop->couleur_horraire ?>;"><?= $row_shop->id.' - '.$row_shop->nom ?></div><?
	}?>
</div>



<script>
$(document).ready(function()
{
	$("#employer_list").on('click', "td[data-action='edit']",function()
	{
		$(this).removeClass("success").addClass("danger");
	});

	$("#employer_list").on('blur', "td[data-action='edit']",function()
	{
		$(this).addClass("loading");
		var current_select = $(this);

		$.ajax(
		{
			url: "../app/controller/controller_ajax/admin_employer.php",
			type: "POST",
			data:{'jour' : $(this).data("jour"), 'id_shop' : this.innerHTML, 'id_user' : $(this).data("id-employer"), 'action' : 'edit'},
			success: function(data)
			{
				current_select.removeClass("loading").removeClass("danger");

				current_select.addClass("success validate").delay(1000).queue(function(next)
				{
					current_select.removeClass("success validate");
					next();

					$.ajax(
					{
						url:"../app/controller/controller_ajax/admin_employer.php",
						type : 'POST',
						data : {"action":"list", "jour":$(this).data("jour"), "id_user":$(this).data("id-employer") },
						dataType: 'json',
						success: function(test)
						{
							current_select.data('id-shop',test[0].id_shop).css('background-color', test[0].couleur_shop).html("");
						}
					});
				});
			}        
	   });
	});
/*
	$("#employer_list").on('blur', "td[data-action='edit_shop']",function()
	{
		$(this).css('background-color','transparent').addClass('loading');


		var current_select = $(this);
		var id_employer = $(this).attr("data-id-employer");
		var id_shop_current = $(this).attr("data-id-shop");
		var id_shop_entering = this.innerHTML;

		if(id_shop_entering == 'Non Connu') id_shop_entering = '0';
		if(id_shop_entering.length > 2) id_shop_entering = $(this).attr("data-id-shop");
		if(id_shop_current == id_shop_entering)
		{
			$.post("../app/controller/controller_ajax/admin_employer.php", {"action":"list"}, function( data_return )
			{
	        	$("#employer_list").html(data_return);
	    	});
		}



		$.ajax({
			url: "../app/controller/controller_ajax/admin_employer.php",
			type: "POST",
			data:'column='+$(this).attr("data-column")+'&id_shop='+id_shop_entering+'&id_employer='+id_employer+'&action=edit_shop',
			success: function(data){

				current_select.removeClass("loading").removeClass("danger");
//faire en sorte que le systme mette et enleve les classe que quand success et pas tout de suite, il dois attendre la fin du systeme
//voir mettre en place un ajax au lieu d'un $.post
				current_select.addClass("success validate").delay(1000).queue(function(next){
					$.post("../app/controller/controller_ajax/admin_employer.php", {"action":"list"}, function( data_return )
					{
			        	$("#employer_list").html(data_return);
			    	});
					current_select.removeClass("success validate");
					next();
				});
			}        
	   });
	});

*/
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

/*
	$("#employer_list").on('click', "div[data-action='ajout']", function()
	{
		var current_select = $(this);
		if(confirm("êtes vous sur de vouloir ajouter un employer de la liste ?"))
		{

			$.post("../app/controller/controller_ajax/admin_employer.php", {"action":"get_last_id"}, function( data_return )
			{
        		$("#table_list_employer").append('<tr><td><b>'+data_return+'</b></td>'+
												'<td contenteditable="true" data-action="edit" data-column="prenom" data-id="'+data_return+'"></td>'+
												'<td contenteditable="true" data-action="edit" data-column="nom" data-id="'+data_return+'"></td>'+
												'<td contenteditable="true" data-action="edit" data-column="gsm" data-id="'+data_return+'"></td>'+
												'<td contenteditable="true" data-action="edit" data-column="age" data-id="'+data_return+'"></td>'+
												'<td contenteditable="true" data-action="edit" data-column="habite" data-id="'+data_return+'"></td>'+
												'<td contenteditable="true" data-action="edit" data-column="travail" data-id="'+data_return+'"></td>'+
												'<td contenteditable="true" data-action="edit" data-column="id_shop_proche_1" data-id="'+data_return+'"></td>'+
												'<td contenteditable="true" data-action="edit" data-column="id_shop_proche_2" data-id="'+data_return+'"></td>'+
												'<td contenteditable="true" data-action="edit" data-column="id_shop_proche_3" data-id="'+data_return+'"></td>'+
												'<td contenteditable="true" data-action="edit" data-column="id_shop_proche_4" data-id="'+data_return+'"></td>'+
											'<td></td></tr>');

    			//remettre le new block a jour pour ajouter 
				$('#table_list_employer tr').last().addClass('success');
					
    		});
		}
	});*/
});
</script>