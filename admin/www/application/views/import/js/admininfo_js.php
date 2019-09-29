<script>
    $(document).on('click' , '#btn_update' , function(){
        var prev_user_pass = $('#update_form #prev_user_pass').val();
        var cur_pass = $('#update_form #cur_password').val();
    	if ($('#update_form input[name=t_name]').val() == ''
            || $('#update_form input[name=t_phone]').val() == ''
            || $('#update_form input[name=t_email]').val() == ''
            || $('#update_form #prev_user_pass').val() == ''
            || $('#update_form #user_pass').val() == ''
            || $('#update_form #new_user_pass_confirm').val() == ''
        ) {
            alert('请输入正确的资料.');
    		return;
    	}
        
        $.ajax({
            url : site_url + '/admininfo/confirmprevpassword' , 
            type: 'POST' , 
            dataType: 'JSON' , 
            data: {
                prev_user_pass : prev_user_pass , 
                cur_pass : cur_pass , 
            } , 
            success: function(response) {
                if(response.success) {

                    if($('#update_form #user_pass').val() != $('#update_form #new_user_pass_confirm').val()){
                        alert('确认密码不正确.');
                        return;
                    }
                    else {
                        loadingstart('#body_container');
                        $('#update_form').submit();
                    }

                }
                else {

                    alert('旧密码不正确.');

                }
            }
        });
    });
</script>