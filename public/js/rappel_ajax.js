
$(document).ready(function()
{

	function refresh(balise_to_refresh, url_for_refresh)
	{
		$.post(url_for_refresh, {"action":"list"}, function( data_return )
		{
        	$(balise_to_refresh).html( data_return );
    	});
	}


	$("#table_list_employer").on('blur', "td[data-action='edit']",function()
	{

		$(this).addClass("loading");
		var current_select = $(this);

		$.ajax({
			url: "../app/controller/controller_ajax/admin_employer.php",
			type: "POST",
			data:'column='+current_select.attr("data-column")+'&editval='+this.innerHTML+'&id='+current_select.attr("data-id")+'&action=edit',
			success: function(data){
				current_select.removeClass("loading").removeClass("danger");

				current_select.addClass("success validate").delay(1000).queue(function(next){
					current_select.removeClass("success validate");
					next();
				});
			}        
	   });
	});


	$("td[data-action='edit']").on('click', function()
	{
		$(this).removeClass("success").addClass("danger");
	});



	$("#table_list_employer").on('click', "button[data-action='suppression']", function()
	{
		if(confirm("êtes vous sur de vouloir supprimer l'employer de la liste ?"))
		{
			var current_select = $(this);
			$.ajax({
				url: "../app/controller/controller_ajax/admin_employer.php",
				type: "POST",
				data:'id='+current_select.attr("data-id")+'&action=delete',
				success: function(data_return){
					refresh("#table_list_employer", "../app/controller/controller_ajax/admin_employer.php");
				}
	   		});
		}
			
	});

	$("#table_list_employer").on('click', "button[data-action='ajout']", function()
	{
		if(confirm("êtes vous sur de vouloir ajouter un employer de la liste ?"))
		{	
			var current_select = $(this);
			$.ajax({
				url: "../app/controller/controller_ajax/admin_employer.php",
				type: "POST",
				data:'id='+current_select.attr("data-id")+'&action=delete',
				success: function(data_return){
					refresh("#table_list_employer", "../app/controller/controller_ajax/admin_employer.php");
				}
	   		});
		}
				
	});
});





	

	

