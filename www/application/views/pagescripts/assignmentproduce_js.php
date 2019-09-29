<script type="text/javascript"> 
    
    $(document).on('click' , '#sendassignment' , function(){
        if ($('select[name=sg_id]').val() == null) {
            bootbox.alert('请选择组号.');
            return;
        }
        else if ($('#ass_files_panel input[type=file]').val() == '') {
            bootbox.alert('请选择有效的文件.');    
            return;
        }
        else {             
            bootbox.confirm('确定进行操作吗?' , function(result){
                if (result) {
                    $('#new_assignment_form').submit();                            
                }
            })
        }
    });
    
    $('.date-picker').datepicker({
        format: 'yyyy-mm-dd',
        autoclose : true , 
    });
    
<?php
    if (isset($post_result_alarm_message)){
        if ($post_result_alarm_message['success']) {
?>
            toastr['success']('<?=$post_result_alarm_message['post_message']?>');
<?php
        }
        else {
?>
            toastr['error']('<?=$post_result_alarm_message['post_message']?>');
<?php        
        }
    }
?>
</script>