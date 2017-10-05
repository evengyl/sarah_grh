<div class='col-lg-12' id='date_picker'></div>

<div class="col-lg-12" >
	<div class=" col-xs-12" style="padding-bottom:10px;">
		<div class="col-xs-12 pull-right" id="todo_list">
			<? require "appel_ajax/todo_list.php"; ?>
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

		$("#todo_list").on('click', "button[data-action='ajout']", function()
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