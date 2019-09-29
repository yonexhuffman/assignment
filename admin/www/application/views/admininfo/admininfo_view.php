<div class="row">
    <div class="col-sm-0 col-md-2"></div>
    <div class="col-md-8 form"> 
        <form action="<?php echo site_url('admininfo/update'); ?>" class="form-horizontal" method="post" id="update_form" enctype="multipart/form-data">
            <input type="hidden" name="acc_id" value="<?=$admindata['acc_id']?>" />
            <input type="hidden" name="t_id" value="<?=$admindata['t_id']?>" />
            <input type="hidden" name="tg_id" value="0" />
            <input type="hidden" id="cur_password" value="<?=$admindata['user_pass']?>" />
            <input type="hidden" name="admin_img_name" value="<?=$admindata['t_photo']?>" />
            
            <div class="form-group">
                <div class="col-md-4"></div>
                <div class="col-md-3">
                    <img src="<?=base_url($this->uploadpath_teacherphoto . $admindata['t_photo'])?>" style="width:100%;" />
                </div>
                <div class="col-md-4"></div>
            </div>
            
            <div class="form-group">
                <label class="control-label col-sm-3 col-md-3">姓名</label>
                <div class="col-sm-9 col-md-7">
                    <input type="text" name="t_name" class="form-control" value="<?=$admindata['t_name']?>">
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-3">账号</label>
                <div class="col-md-7">
                    <input type="text" name="user_id" class="form-control" value="<?=$admindata['user_id']?>">
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-3">旧密码</label>
                <div class="col-md-7">
                    <input type="password" id="prev_user_pass" class="form-control" value="">
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-3">新密码</label>
                <div class="col-md-7">
                    <input type="password" name="user_pass" id="user_pass" class="form-control" value="">
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-3">确认密码</label>
                <div class="col-md-7">
                    <input type="password" id="new_user_pass_confirm" class="form-control" value="">
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-3">性别</label>
                <div class="col-md-8" style="padding-left: 50px;">
                    <div class="radio-list">
                        <label class="radio-inline">
                        <input type="radio" name="t_gender" id="optionsRadios4" value="1" 
                        <?php 
                            if ($admindata['t_gender'] == 1)
                                echo 'checked';					
                        ?>
                        > <?=$gender[1]?> </label>
                        <label class="radio-inline">
                        <input type="radio" name="t_gender" id="optionsRadios5" value="2"
                        <?php 
                            if ($admindata['t_gender'] == 2)
                                echo 'checked';					
                        ?>
                        > <?=$gender[2]?> </label>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-3">照片</label>
                <div class="col-md-4">
                    <input type="file" name="t_photo" class="form-control">
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-3">出生日期</label>
                <div class="col-md-7">
                    <input type="text" name="t_birth" class="form-control" value="<?=$admindata['t_birth']?>">
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-12 text-center">
                    <button type="button" class="btn btn-success" id="btn_update" >更新</button>
                </div>
            </div>
        </form>
    </div>

</div>   