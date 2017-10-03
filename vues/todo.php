<div class="col-lg-12" >
	<div class=" col-xs-12" style="padding-bottom:10px;">
		<div class="col-xs-12 pull-right" id="todo_list">
			<!-- ajax content -->
		</div>
	</div>
</div>


<script>


$(document).ready(function(){

	function refresh()
	{
		$.post( "../app/controller/controller_ajax/admin_todo_list.php", {"action":"list"}, function( data_return ){
        	$( "#todo_list" ).html( data_return );
    	});
	}

	refresh();
	

	$("#todo_list").on('blur', "td[data-action='edit']",function(){

		$(this).addClass("loading");
		var current_select = $(this);

		$.ajax({
			url: "../app/controller/controller_ajax/admin_todo_list.php",
			type: "POST",
			data:'column='+current_select.attr("data-column")+'&editval='+this.innerHTML+'&id='+current_select.attr("data-id")+'&action=edit',
			success: function(data){
				current_select.removeClass("loading").removeClass("danger");

				current_select.addClass("validate").delay(1000).queue(function(next){
					current_select.removeClass("validate");
					next();
					refresh();
				});
			}        
	   });
	});


	$("#todo_list").on('click', "button[data-action='suppression']", function(){
		if(confirm("Avez bien fait cette tâche ?"))
		{
			var current_select = $(this);
			$.ajax({
				url: "../app/controller/controller_ajax/admin_todo_list.php",
				type: "POST",
				data:'id='+current_select.attr("data-id")+'&action=delete',
				success: function(data_return){
					refresh();
				}
	   		});
		}
	});

	$("#todo_list").on('click', "button[data-action='ajout']", function(){

		var current_select = $(this);

		//remettre le new block a jour pour ajouter 
		$('#table_list_todo tr').last().removeAttr( 'style' );
	});

	
});

</script>