$(document).ready(function(){
	
	
	if ($(".label-mensajes").text() == 0){
		$(".label-mensajes").addClass("hidden");
	}
	else{
		$(".label-mensajes").removeClass("hidden");
	}
	
	mensajes();
	setInterval(function(){
		mensajes();
	}	,10000);
	
	
	
});

function mensajes(){
	
	$.ajax({
		
		url: URL + '/mensaje_privado/get',
		type: 'GET',
		success: function(response){
			
			$(".label-mensajes").html(response);
			if(  response == 0){
				$(".label-mensajes").addClass("hidden");
			
			}
			else{
				$(".label-mensajes").removeClass("hidden");
				
			}
		}
		
		
	});
	
}

