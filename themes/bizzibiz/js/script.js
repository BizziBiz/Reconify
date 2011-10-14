$(function(){
	$('#overlay').hide();
	
	$('#email_popup_link').click(function(){
		$('#overlay').show();
	});
	
	$('.overlay_close').click(function(){
		$('#overlay').hide();
	});
	
	$('#email_send').click(function(){		
		var to = $('#email_to').val();
		var from =  $('#email_from').val();
		var dataString = 'email=true&to='+to+'&from='+from;
	
		$.ajax({
			type: "POST",
			data: dataString,
			success: function(){
				alert("Sent!");
				$('#overlay').hide();
			}
		});
	});
});