$(document).ready(function(){
		
	var ias= jQuery.ias({
		container: '#timeline',
		item: '.publication-item',
		pagination: '.pagination',
		next: '.pagination .next_link',
		triggerPageThreshold: 5
		
	});
	
	ias.extension(new IASTriggerExtension({
		text: 'Ver más publicaciones',
		offset: 3
	}));
	
	ias.extension(new IASSpinnerExtension({
		src: URL + '/../assets/images/ajax-loader.gif' 
		
	}));
	
	ias.extension(new IASNoneLeftExtension({
		text: 'No hay más publicaciones'
		
	}));
	
	ias.on('ready',function(event){
		buttons();
		
	});


	ias.on('rendered',function(event){
		buttons();
		
	});
	
	
});

function buttons (){

	
	$(".btn-delete-pub").unbind('click').click(function(){
		
		$(this).parent().parent().addClass('hidden');
		
		$.ajax({
			url: URL+'/publicacion/borra/'+ $(this).attr("data-id"),
			type: 'GET',
			success: function(response){
				
				console.log(response);
				
			}
			
		});
	});
	
	
}

