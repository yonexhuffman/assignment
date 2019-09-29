<style type="text/css">
    .detail_panel{
        width: 60%;
    }
    .image_panel{
        width: 40%;
    }
    .image_panel img{
        border: 1px solid #ddd;
        width:100%;
    }
    .title{
        font-size: 1.1em;
        font-weight: 400;
    }
    .assignment_item{
        margin: 5px 10px 0px 0px !important;
    }
</style>
<?php 
    $group = '';
    $img_url = '';
    if ($userdata['user_role'] == 'TEA') {
        $img_url = base_url($this->uploadpath_teacherphoto . $userdata['photo']);
    }
    else {
        $group = $userdata['sg_label'];
        $img_url = base_url($this->uploadpath_studentphoto . $userdata['photo']);
    }
?>
<?php
    if ($userdata['user_role'] == 'STU') {
?>
    <div class="row">
        <div class="col-sm-0 col-md-2"></div>
        <div class="col-sm-12 col-md-8">
        <?php
            if (isset($rival_data)) {
        ?>
            <p class="title">
                <span>我的侠客号:</span><strong><?=$userdata['s_serialNo']?></strong>
                <span>答题次数:</span><strong><?=$rival_data['mine_point']['assignment_times']?></strong>
                <span>总积分:</span><strong><?=$rival_data['mine_point']['total_point']?></strong>
            </p>            
        <?php
                foreach ($rival_data['rival_point'] as $key => $rival_item) {
                    if (empty($rival_item['s_serialNo'])) {
                        continue;
                    }
        ?>
            <p class="title">
                <span>对手侠客号:</span><strong><?=$rival_item['s_serialNo']?></strong>
                <span>答题次数:</span><strong><?=$rival_item['assignment_times']?></strong>
                <span>总积分:</span><strong><?=$rival_item['total_point']?></strong>
            </p>   
        <?php
                }
            }
        ?>
        </div>        
    </div>
<?PHP
    }
?>

<div class="row">
    <div class="col-sm-0 col-md-2"></div>
    <div class="col-sm-12 col-md-8">
        <div class="detail_panel f-left">
            <p class="title">姓名 : <strong><?=$userdata['name']?></strong> </p>
            <p class="title">性别 : <strong><?=$gender[$userdata['gender']]?></strong> </p>
        <?php
            if ($userdata['user_role'] == 'STU') {
        ?>
            <p class="title">学号 : <strong><?=$userdata['s_serialNo']?></strong> </p>
            <p class="title">学校 : <strong><?=$userdata['s_schoolname']?></strong> </p>
            <p class="title">年届 : <strong><?=$userdata['s_grade']?></strong></p>
        <?PHP
            }
        ?>
        <?php
            if (!empty($group)) {
        ?>
            <p class="title">组号 : <?=$group?></p>
        <?php
            }
        ?>
            <p class="title">出生日期 : <strong><?=$userdata['birth']?></strong> </p>
        </div>
        <div class="image_panel f-right">
            <img src="<?=$img_url?>" />
        </div>
        <div class="clear"></div>
    </div>
</div>
<?php
    if (isset($assignment_list)) {
?>
<div class="row">
    <div class="col-sm-0 col-md-2"></div>
    <div class="col-sm-12 col-md-8">
        <h4 style="font-weight: 800;">我的答案</h4>
        <?php
            foreach ($assignment_list as $key => $item) {
        ?>
        <a href="<?=site_url('assignmentlist?ass_id=' . $item['ass_id'])?>" class="btn btn-primary assignment_item" ><?=($key + 1)?></a>
        <?php
            }
        ?>
    </div>
</div>
<?php
    }
?>
<input type="hidden" id="acc_id" value="<?=$userdata['acc_id']?>">
<div class="row" style="margin-top: 10px;">
    <div class="col-sm-0 col-md-2"></div>
	<div class="col-sm-12 col-md-8">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h4 class="panel-title">
				<a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion1" href="#collapse_2" aria-expanded="false">
				更新密码 </a>
				</h4>
			</div>
			<div id="collapse_2" class="panel-collapse collapse form" aria-expanded="false" style="height: 0px;">
				<div class="panel-body form-horizontal" id="update_form">							
		            <div class="form-group">
		                <label class="control-label col-md-3">旧密码</label>
		                <div class="col-md-7">
		                    <input type="password" id="prev_user_pass" class="form-control" value="">
		                </div>
		            </div>
		            <div class="form-group">
		                <label class="control-label col-md-3">新密码</label>
		                <div class="col-md-7">
		                    <input type="password" id="user_pass" class="form-control" value="">
		                </div>
		            </div>
		            <div class="form-group">
		                <label class="control-label col-md-3">密码确认</label>
		                <div class="col-md-7">
		                    <input type="password" id="new_user_pass_confirm" class="form-control" value="">
		                </div>
		            </div>
		            <div class="form-group">
		                <div class="col-md-12 text-center">
		                    <button type="button" class="btn btn-success" id="btn_passwordupdate" >更新</button>
		                </div>
		            </div>
				</div>
			</div>
		</div>
	</div>
</div>