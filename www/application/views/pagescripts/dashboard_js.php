<script type="text/javascript">
    $(document).on('click' , '#btn_passwordupdate' , function(){
        var prev_user_pass = $('#update_form #prev_user_pass').val();
        var user_pass = $('#update_form #user_pass').val();
        var new_user_pass_confirm = $('#update_form #new_user_pass_confirm').val();
        var acc_id = $('#acc_id').val();
    	if (prev_user_pass == '' || user_pass == '' || new_user_pass_confirm == '') {
    		alert('请填空所有的输入框.');
    		return;
    	}
        
        $.ajax({
            url : site_url + '/dashboard/updatepassword' , 
            type: 'POST' , 
            dataType: 'JSON' , 
            data: {
                acc_id : acc_id , 
                prev_user_pass : prev_user_pass , 
                user_pass : user_pass , 
                new_user_pass_confirm : new_user_pass_confirm , 
            } , 
            success: function(response) {
                if(response.success) {
                	toastr['success'](response.message);
                }
                else {
                	toastr['error'](response.message);
                }
            }
        });
    });
</script>