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
    .answer_item .problem_content {
        margin-bottom: 15px;
    }
    .answer_item .problem_content img {
        width: 100%;
    }
    .problem_indexlabel{
        font-size: 2em;
    }
    .form img {
        border: 1px solid #ccc;
    }
    .form h4 , h4 {
        font-weight: 800;
    }
    section {
        margin: auto;
        text-align: left;
    }
    .fs-container {
        width: 100%;
        margin: auto;
    }
</style>
<?php
    if (count($assignment_list) > 0) {
        $ans_data = $answer_data['data'];
        $ass_files = $answer_data['ass_files'];
        $ans_files = $answer_data['ans_files'];
        $is_checked = FALSE;
        if (!empty($ans_data['point'])) {
            $is_checked = TRUE;
        }
        $prev_ass_id = -1;
        $next_ass_id = -1;
?>
<div class="row form">
    <form action="<?=site_url('assignmentlist/submit')?>" method="POST" id="submit_result_form" enctype="multipart/form-data" >
        <div class="col-sm-0 col-md-2"></div>
        <div class="col-sm-12 col-md-8 form-horizontal">
            <input type="file" name="buffer_file" style="display: none;">
            <input type="hidden" name="ans_id" value="<?=$ans_data['ans_id']?>">
            <div class="form-group">
                <label class="control-label col-md-4">
                    日期 : <?php echo (count($answer_data) > 0) ? $answer_data['data']['give_date'] : 0; ?>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                </label>
                <div class="col-sm-8 col-md-6">
                    <input type="hidden" name="ass_id" value="<?=$ass_id?>">
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
                </div>
            </div> 
            <div class="row problem_navigation text-center">
                <?php
                    if ($prev_ass_id > 0) {
                ?>
                <a href="<?=site_url('/assignmentlist?ass_id=' . $prev_ass_id)?>" class="btn btn-primary" id="btn_prev"><i class="fa fa-arrow-circle-left"></i>上个作业</a>
                <?php
                    }
                ?>
                <?php
                    if ($next_ass_id > 0) {
                ?>
                <a href="<?=site_url('/assignmentlist?ass_id=' . $next_ass_id)?>" class="btn btn-primary" id="btn_next">下个作业 <i class="fa fa-arrow-circle-right"></i></a>
                <?php
                    }
                ?>
            </div>  
            <div class="answer_panel">
                <div class="answer_item">
                    <div class="row">
                        <div class="col-sm-12 problem_content">
                            <h4>作业</h4>
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
                            <h4>答案 <?php if(count($ans_files) == 0) echo ": 您尚未提交答案."; ?></h4>
                            <?php
                                if (count($ans_files) > 0) {                                    
                                    foreach ($ans_files as $key => $ans_file) {
                                        $ans_file_url = $uploadpath_answerfile . $ans_file['ans_file_name'];
                                        if (file_exists($ans_file_url)) {
                                            if (strpos($ans_file['ans_file_type'] , 'image') !== false) {
                            ?>
                            <a href="<?=base_url($ans_file_url)?>" class="open_newwindow" >
                            <img src="<?=base_url($ans_file_url)?>" >
                            </a>
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
                    <div class="row">
                        <div class="col-sm-12">
                            <?php
                                if (!$is_checked) {
                            ?>
                            <span class="f-left">新的答案 : &nbsp;&nbsp;&nbsp;</span>
                            <input type="file" name="ans_files[]" multiple class="f-left" style="width: 65%;">
                            <div class="clear"></div>
                            <?php
                                }
                            ?>                            
                        </div>
                    </div>
                    <?php
                        if (!empty($ans_data['comment'])) {
                    ?>
                    <div class="row">
                        <div class="col-sm-12 col-md-8">
                            <h4>评价</h4>                            
                            <section id="editor">
                                <div class='edit' style="margin-top: 30px;"><?=$ans_data['comment']?></div>
                            </section>
                        </div>
                    </div>
                    <?php
                        }
                    ?>
                    <div class="row">
                        <div class="col-sm-12 col-md-8 ref_file_panel">    
                        <?php
                            if (!empty($ans_data['ref_file'])) {
                        ?>                            
                            <h4>视频讲解 : <a href="<?=site_url('/assignmentlist/referencefiles?ass_id=' . $ass_id)?>" class="show_video"><?=$ans_data['ref_file']?></a></h4>                   
                        <?php
                            }
                        ?> 
                        </div>
                    </div>
                    <?php
                        if (!empty($ans_data['point'])) {
                    ?>
                    <div class="row">
                        <div class="col-sm-12 col-md-8">  
                            <h4>
                            <?php
                                echo '得分:&nbsp;&nbsp;&nbsp;' . $ans_data['point'];
                            ?>                                
                            </h4>   
                        </div>
                    </div>
                    <?php
                        }
                    ?>
                </div>
            </div> 
            <?php
                if (empty($ans_data['point'])) {
            ?>
            <div class="row">
                <div class="col-sm-12">
                    <button type="button" class="btn btn-success f-right" id="sendassignment">提交</button>
                    <div class="clear"></div>
                </div>
            </div> 
            <?php
                }
            ?>
            <div class="row problem_navigation text-center">
                <?php
                    if ($prev_ass_id > 0) {
                ?>
                <a href="<?=site_url('/assignmentlist?ass_id=' . $prev_ass_id)?>" class="btn btn-primary" id="btn_prev"><i class="fa fa-arrow-circle-left"></i>上个作业</a>
                <?php
                    }
                ?>
                <?php
                    if ($next_ass_id > 0) {
                ?>
                <a href="<?=site_url('/assignmentlist?ass_id=' . $next_ass_id)?>" class="btn btn-primary" id="btn_next">下个作业 <i class="fa fa-arrow-circle-right"></i></a>
                <?php
                    }
                ?>
            </div>   
        </div>
    </form>
</div>   
<?php
    }
    else {
        echo "没有作业题.";
    }
?>