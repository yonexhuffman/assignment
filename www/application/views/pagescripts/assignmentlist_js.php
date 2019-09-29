<script type="text/javascript">

    $(document).on('change' , '#ass_id' , function(){
        var ass_id = $(this).val();
        location.href = site_url + 'assignmentlist?ass_id=' + ass_id;
    })

    $(function(){
        $('.edit').froalaEditor({
            toolbarButtons: [],
            emoticonsStep: 4,
            emoticonsSet: [
              { code: '1f600', desc: 'Grinning face' },
              { code: '1f601', desc: 'Grinning face with smiling eyes' },
              { code: '1f602', desc: 'Face with tears of joy' },
              { code: '1f603', desc: 'Smiling face with open mouth' },
              { code: '1f604', desc: 'Smiling face with open mouth and smiling eyes' },
              { code: '1f605', desc: 'Smiling face with open mouth and cold sweat' },
              { code: '1f606', desc: 'Smiling face with open mouth and tightly-closed eyes' },
              { code: '1f607', desc: 'Smiling face with halo' }
            ]
        })
    });
    $(document).on('click' , '#sendassignment' , function(){
        if ($('.answer_panel input[type=file]').val() == '') {
            bootbox.alert('请选择有效的文件.');
            return;
        }
        bootbox.confirm('确定进行操作码?' , function(result){
            if (result) {
                $('#submit_result_form').submit();                            
            }
        })     
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