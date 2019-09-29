<style type="text/css">
    .problem_navigation{
        position: relative;
        margin: 10px 0px 30px 0px;
        padding: 10px;
    }
    .problem_navigation #btn_prev{
        position: absolute;
        left: 0;
    }
    .problem_navigation #btn_next{
        position: absolute;
        right: 0;
    }
    .answer_panel .answer_item{
        display: none;
    }
    .answer_panel .active{
        display: block;
    }
    .answer_item .problem_content {
        margin-bottom: 15px;
    }
    .answer_item .problem_content img {
        width: 100%;
    }
    .problem_indexlabel{
        font-size: 2em;
    }
    .form h5 , h5 {
        font-weight: 800;
        display: inline-block;
    }
    .form img {
        border: 1px solid #ccc;
    }
    section {
        margin: auto;
        text-align: left;
    }
    .fs-container {
        width: 100%;
        margin: auto;
    }

    .literally {
        width: 100%;
        height: 100%;
        position: relative;
    }
    .literally .lc-picker{
        width: 35px;
    }
    .literally .lc-options , .literally .lc-drawing.with-gui{
        left: 35px;
    }
    .lc-color-pickers{
        display: none;
    }
    .literally .lc-picker .fat-button{
        width: 33px;
        margin: 0;
    }
</style>
<?php
    if (count($assignment_list) > 0) {
        $ans_data = $assignment_answer['data'];
        $ass_files = $assignment_answer['ass_files'];
        $ans_files = $assignment_answer['ans_files'];
        $prev_ass_id = -1;
        $next_ass_id = -1;
?>
<script type="text/javascript">
    var answer_file_url = new Array;
    var ans_file_count = parseInt('<?=count($ans_files);?>');
</script>
<div class="row form">
    <form action="<?=site_url('givepoint/submit')?>" method="POST" id="submit_result_form" enctype="multipart/form-data" >
        <div class="col-sm-0 col-md-2"></div>
        <div class="col-sm-12 col-md-8 form-horizontal">
            <input type="hidden" name="ass_id" value="<?=$ans_data['ass_id']?>">  
            <input type="hidden" name="ans_id" value="<?=$ans_data['ans_id']?>">  
            <input type="hidden" name="s_id" value="<?=$ans_data['s_id']?>">  
            <input type="hidden" name="comment" value="">  
            <?php
                $start_index = count($assignment_list) - 1; 
                for ($i = $start_index ; $i >= 0 ; $i --) {
                    $selected = '';
                    if ($ass_id == $assignment_list[$i]['ass_id']) {
                        $selected = 'selected';
                        if (isset($assignment_list[$i + 1])) {
                            $prev_ass_id = $assignment_list[$i + 1]['ass_id'];
                        }
                        if (isset($assignment_list[$i - 1])) {
                            $next_ass_id = $assignment_list[$i - 1]['ass_id'];
                        }
                    }
                }
            ?>
            <div class="form-group">
                <label class="control-label col-md-4">日期 : <?=$ans_data['give_date']?></label>
            </div>    
            <div class="row problem_navigation text-center">
                <?php
                    if ($prev_ass_id > 0) {
                ?>
                <a href="<?=site_url('/givepoint?ass_id=' . $prev_ass_id)?>" class="btn btn-primary" id="btn_prev"><i class="fa fa-arrow-circle-left"></i>上一个作业</a>
                <?php
                    }
                ?>
                <?php
                    if ($next_ass_id > 0) {
                ?>
                <a href="<?=site_url('/givepoint?ass_id=' . $next_ass_id)?>" class="btn btn-primary" id="btn_next">下一个作业 <i class="fa fa-arrow-circle-right"></i></a>
                <?php
                    }
                ?>
            </div>  
            <div class="row">
                <div class="col-sm-12" style="margin: 10px 0px;">
                    <h5>学号:<?php if(isset($ans_data['s_serialNo'])) echo $ans_data['s_serialNo']; ?></h5>
                    <h5>姓名:<?php if(isset($ans_data['s_name'])) echo $ans_data['s_name']; ?></h5>  
                    <h5>得分:</h5>    
                    <span>
                        <input type="text" name="point" value="<?php if(isset($ans_data['point'])) echo $ans_data['point']; ?>" style="width: 20%;" >
                    </span>
                    <div class="clear"></div>
                </div>
            </div>
            <div class="answer_panel">
                <div class="answer_item active">
                    <div class="row">
                        <div class="col-sm-12 problem_content">
                            <h5>作业</h5>
                            <?php
                                foreach ($ass_files as $key => $ass_file) {
                                    $ass_file_url = $uploadpath_assfile . $ass_file['ass_file_name'];
                                    if (file_exists($ass_file_url)) {
                                        if (strpos($ass_file['ass_file_type'] , 'image') !== false) {
                            ?>
                            <a href="<?=base_url($ass_file_url)?>" class="open_newwindow" >
                            <img src="<?=base_url($ass_file_url)?>" >
                            </a>
                            <?php
                                        }
                                        else {
                            ?>
                            <a href="<?=base_url($ass_file_url)?>" class="btn btn-default open_newwindow"><?=$ass_file['ass_file_name']?>打开文件</a>
                            <?php
                                        }
                                    }
                                    else {
                                        echo "找不到相应的文档.";
                                    }
                                }
                            ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 problem_content">
                            <h5>答案 <?php if(count($ans_files) == 0) echo ": 您尚未提交答案."; ?></h5>
                            <?php
                                if (count($ans_files) > 0) {                                    
                                    foreach ($ans_files as $key => $ans_file) {
                                        $ans_file_url = $uploadpath_answerfile . $ans_file['ans_file_name'];
                                        if (file_exists($ans_file_url)) {
                                            if (strpos($ans_file['ans_file_type'] , 'image') !== false) {
                            ?>
                                <input type="hidden" name="upload_image[]" class="upload_process_image" value="">  
                                <input type="hidden" name="image_name_<?=$key?>" value="<?=$ans_file['ans_file_name']?>">  
                                <div class="literally backgrounds">
                                    
                                </div>
<script type="text/javascript">
    answer_file_url.push('<?=base_url($ans_file_url)?>');
</script>
                            <?php
                                            }
                                            else {
                            ?>
                            <a href="<?=base_url($ans_file_url)?>" class="btn btn-default open_newwindow"><?=$ans_file['ans_file_name']?>打开文件</a>
                            <?php
                                            }
                                        }
                                        else {
                                            echo "找不到相应的文档.";
                                        }
                                    }
                                }
                            ?>
                        </div>
                    </div>
                </div>                
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <h5>评价</h5>                                
                    <section id="editor">
                        <div id='edit' style="margin-top: 30px;"><?=$ans_data['comment']?></div>
                    </section>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <h5>讲解视频</h5>
                    <input type="file" name="ref_file">
                <?php
                    $ref_file_url = $uploadpath_referencefile . $ans_data['ref_file'];
                    if (file_exists($ref_file_url)) {
                        if (strpos($ans_data['ref_file_type'] , 'video/mp4') !== false || strpos($ans_data['ref_file_type'] , 'video/webm') !== false) {
                    ?>
                    <video controls style="width: 100%;margin-top: 10px;">
                        <source src="<?=base_url($ref_file_url)?>" type="video/mp4">
                    </video>
                    <?php
                        }
                        else if($ans_data['ref_file'] != '') {
                    ?>
                    <a href="<?=base_url($ref_file_url)?>" class="btn btn-default open_newwindow"><?=$ans_data['ref_file']?> 打开文件</a>
                    <?php
                        }
                    }
                ?>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="note note-danger" style="text-indent: 15px; margin-top: 10px;">
                        视频格式必须得MP4，不然无法保存。 
                    </div>                    
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="f-right">
                        <button type="button" id="sendassignment" class="btn btn-success"><i class="fa fa-save"></i> 保存 </button>
                    </div>
                    <div class="clear"></div>
                </div>
            </div>    
            <div class="row problem_navigation text-center">
                <?php 
                    $i = 1;
                    $prev_s_id = -1;
                    $next_s_id = -1;

                    foreach ($assignment_student_list as $key => $student) {
                        if ($student['s_id'] == $ans_data['s_id']) {
                            if (($key - 1) >= 0) {
                                $prev_s_id = $assignment_student_list[$key - 1]['s_id'];
                            }
                            if (($key + 1) < count($assignment_student_list)) {
                                $next_s_id = $assignment_student_list[$key + 1]['s_id'];
                            }
                        }
                        $i ++;
                    }
                    if ($prev_s_id > 0) {
                        $prev_url = site_url('givepoint?ass_id=' . $ass_id . '&s_id=' . $prev_s_id);
                ?>
                <a href="<?=$prev_url?>" class="btn btn-success" id="btn_prev" style="position: fixed;top: 75%;width: 7%;padding: 10px 8px;"><i class="fa fa-arrow-circle-left"></i></a>
                <?php
                    }
                    else {
                        $prev_url = 'javascript:void(0)';
                    }
                    if ($next_s_id > 0) {
                        $next_url = site_url('givepoint?ass_id=' . $ass_id . '&s_id=' . $next_s_id);
                ?>                
                <a href="<?=$next_url?>" class="btn btn-success" id="btn_next" style="position: fixed;top: 75%;width: 7%;padding: 10px 8px;"><i class="fa fa-arrow-circle-right"></i></a>
                <?php
                    }
                    else {
                        $next_url = 'javascript:void(0)';
                    }
                ?>
                
            </div>    
        </div>
    </form>
</div>   
<?php
    }
    else {
        echo "<h5>没有作业.</h5>";
    }
?>