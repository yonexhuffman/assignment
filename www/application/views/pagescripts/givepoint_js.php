<script type="text/javascript">
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

    $(document).on('change' , '#ass_id' , function(){
        var ass_id = $(this).val();
        location.href = site_url + 'givepoint?ass_id=' + ass_id;
    })

    $(function(){
        $('#edit').froalaEditor({
            toolbarButtons: ['bold', 'italic', 'underline', 'emoticons', '|', 'undo', 'redo'],
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
    
    if (answer_file_url.length > 0) {
        var lc = new Array;
        $('.literally.backgrounds').each(function(index){
            var backgroundImage = new Image()
            backgroundImage.src = answer_file_url[index];
            lc[index] = LC.init(
                document.getElementsByClassName('literally backgrounds')[index],
                {
                    imageURLPrefix: base_url + 'assets/global/plugins/literallycanvas/_assets/lc-images',
                    backgroundShapes: [
                        LC.createShape('Image', {x: 0, y: 0, image: backgroundImage, scale: 1}) , 
                    ] , 
                    tools: [
                          LC.tools.Pencil,
                          // LC.tools.Eraser,
                          // LC.tools.Line,
                          // LC.tools.Rectangle,
                          // LC.tools.Text,
                          // LC.tools.Polygon,
                          LC.tools.Pan,
                          // LC.tools.Eyedropper
                    ] ,
                    defaultStrokeWidth : 4
                });
            // the background image is not included in the shape list that is
            // saved/loaded here
            localStorage.clear();
            var localStorageKey = 'drawing-with-background-' + index;
            if (localStorage.getItem(localStorageKey)) {
                lc[index].loadSnapshotJSON(localStorage.getItem(localStorageKey));
            }
            lc[index].on('drawingChange', function() {
                localStorage.setItem(localStorageKey, lc[index].getSnapshotJSON());
            });

        })

        $(document).on('click' , '#sendassignment' , function(){
            console.log($('input[name=point]'));
            if ($('input[name=point]').val() == '') {
                bootbox.alert('请再输入得分.');
                return;
            }
            else {
                $('input[name=comment]').val($('section#editor .fr-wrapper .fr-element').html());

                for (var i = 0 ; i < lc.length ; i ++) {
                    var img = lc[i].getImage().toDataURL();
                    $('input.upload_process_image').eq(i).val(img);
                }

                $('#submit_result_form').submit();
            }
        });
    }
    else {
        $(document).on('click' , '#sendassignment' , function(){
            if ($('input[name=point]').val() == '') {
                bootbox.alert('请再输入得分.');
                return;
            }
            else {
                $('input[name=comment]').val($('section#editor .fr-wrapper .fr-element').html());
                $('#submit_result_form').submit();
            }
        });
    }

</script>