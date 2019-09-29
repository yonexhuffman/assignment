<?php
    $today = new DateTime();
    $today = $today->format('Y-m-d');
?>
<style type="text/css">
    .problem_index_label{
        width: 20%;
        line-height: 25px;
    }
    .problem_everycount_label{
        width: 45%; 
        text-align: center;        
        margin-top: 10px;
    }
    .problem_everycount{
        width: 35%;
        margin-top: 5px;
    }
    .problem_content_file{
        width: 70%;
    }
    #problems_content .form-group{
        background: #eee;
        padding: 10px 5px;
    }
</style>
<div class="row form">
    <form action="<?=site_url('assignmentproduce/newassignment')?>" method="POST" id="new_assignment_form" enctype="multipart/form-data" >            
        <div class="col-sm-0 col-md-2"></div>
        <div class="col-sm-12 col-md-8 form-horizontal"> 
            <input type="hidden" name="t_id" value="<?=$cur_userdata['member_id']?>">
            <input type="file" name="buffer_file" style="display: none;">
            <div class="form-group">
                <label class="control-label col-md-3">日期 : </label>
                <div class="col-sm-8 col-md-8">
                    <input type="text" name="give_date" class="form-control date-picker" value="<?=$today?>" placeholder="请输入作业日期">
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-3">组号 : </label>
                <div class="col-sm-8 col-md-6">
                    <select name="sg_id" class="form-control">
                    <?php
                        foreach ($studentgroup as $key => $sgitem) {
                    ?>
                        <option value="<?=$sgitem['sg_id']?>"><?=$sgitem['sg_label']?></option>
                    <?php
                        }
                    ?>
                    </select>
                </div>
            </div>
            <div class="form-group" id="ass_files_panel">
                <label class="control-label col-md-3">作业 : </label>
                <div class="col-sm-8 col-md-8">
                    <input type="file" name="ass_files[]" multiple class="form-control" value="" placeholder="作业题数">
                </div>
            </div> 
            <div class="row">
                <div class="f-right">
                    <button type="button" id="sendassignment" class="btn btn-success"><i class="fa fa-save"></i> 发布 </button>
                </div>
                <div class="clear"></div>
            </div>      
        </div>
    </form>
</div>   