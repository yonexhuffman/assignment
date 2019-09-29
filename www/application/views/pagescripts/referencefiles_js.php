<script type="text/javascript">

    $(document).on('change' , '#ass_id' , function(){
        var ass_id = $(this).val();
        location.href = site_url + 'assignmentlist/referencefiles?ass_id=' + ass_id;
    })
    
    $(document).on('click' , '.reffile_open' , function(){
        $('#reffile_table tbody tr.active').removeClass('active');
        $(this).parents('tr').addClass('active');
        var reffilename = $(this).parent().attr('file-name');
        
        $('#video_tag').find('source').attr('src' , file_path + reffilename);
        var html = $('#video_tag').parent().html();
        console.log(html);
        $('#video_tag').remove();
        $('#video_panel').html(html);
    })

</script>