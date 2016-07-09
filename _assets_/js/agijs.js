$(function(){
	$('#old_pwd').focus(function(){$('#msg_').html('');});
	$('#new_pwd').focus(function(){$('#msg_').html('');});
	$('#new_re-pwd').focus(function(){$('#msg_').html('');});
	
	$('#changepwdbutt').click(function(){
		if($.trim($('#old_pwd').val()) == ''){
			$('#msg_').html("X: Please mention your old password");
		} else if($.trim($('#new_pwd').val()) == ''){
			$('#msg_').html("X: New password should not be left blank.");
		} else if($.trim($('#new_pwd').val()) != $.trim($('#new_re-pwd').val())){
			$('#msg_').html("X: Please confirm the new password correctly.");
		} else {
			url_ = site_url_ + '/c_pwd/changepwd';
			data_ = $('#frm_cpwd').serialize();

			$('#msg_').html('<span style="color: #0000ff">Loading...</span>');
			
			$.ajax({
				type: "POST",
				url: url_,
				data: data_,
				success: function(data){
					if(data == "All three chances over."){
						$('#fullform').css({'padding':'20px'});
						$('#fullform').html("Please contact administrator to reset your password.<br /><a href='"+site_url_+"/dashboard/log__out'>Logout</a>");
					} else {
						if(data == 'good'){
							good = '<span style="padding: 5px; border-radius: 5px; background: #00AA00; color: #ffffff;"> Password changed successfully </span><br /><br />[ <a href="'+site_url_+'/login">Click here login again</a> ]';
							$('#fullform').css({'padding':'20px'});
							$('#fullform').html(good);	
						}
					}
					$('#frm_cpwd')[0].reset();
				}
			});
		}
	});

	$('#chkStatus').click(function(){ 
		if($('#chkStatus').is(':checked')){
			$('#txtStatus').val(1);
		} else {
			$('#txtStatus').val(0);
		}
	});
});