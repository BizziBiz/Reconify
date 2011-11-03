$(function(){
	$('#overlay').hide();
	
	$('#email_popup_link').click(function(){
		$('#overlay').show();
	});
	
	$('.overlay_close').click(function(){
		$('#overlay').hide();
	});
	
	$('#email_send').click(function(){
		$(this).attr('disabled', 'disabled');		
		var to = $('#email_to').val();
		var from =  $('#email_from').val();
		var url = $('#email_url').val();
		var msg = $('#email_message').val();
		var dataString = 'email=true&to='+to+'&from='+from+'&url='+url+'&msg='+encodeURIComponent(msg);

		$.ajax({
			type: "POST",
			data: dataString,
			success: function(rval){
				if(rval == 'true'){
					alert("Email Sent!");
					$('#overlay').hide();
					$('#email_send').removeAttr('disabled');
				}else{
					alert("Email could not be sent. Please verify the information and try again.");
					$('#email_send').removeAttr('disabled');
				}
			}
		});
	});
	
	$('.show_all > a').click(function(){
		$(this).siblings('div').show();
		$(this).hide();
	});
	
	$('.collapse').hide();
});