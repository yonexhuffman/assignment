<style>
    table.table-bordered tbody th, table.table-bordered tbody td{
        vertical-align: middle;
    }
</style>
<div class="row">
    <div class="col-md-12">
        <table class="table table-striped table-bordered table-hover" id="group_table">
            <colgroup>
                <col width="7%"></col>
                <col width="10%"></col>
                <col width="7%"></col>
                <col width="10%"></col>
                <col width="10%"></col>
                <col width="13%"></col>
                <col width="9%"></col>
                <col width="9%"></col>
                <col width="9%"></col>
                <col width="10%"></col>
            </colgroup>
            <thead>
                <tr>
                    <th>
                        序号
                    </th>
                    <th>
                        照片
                    </th>
                    <th>
                        学号
                    </th>
                    <th>
                        姓名
                    </th>
                    <th>
                        性别
                    </th>
                    <th>
                        出生日期
                    </th>
                    <th>
                        学校名称
                    </th>
                    <th>
                        账号
                    </th>
                    <th>
                        组号
                    </th>
                    <th>
                        操作
                    </th>
                </tr>
            </thead>
            <tbody>
            <?php
                $i = 1;
                foreach ($groupdata as $key => $item) {
                    $img_url = $upload_path . $item['s_photo'];
                    if (!file_exists($img_url)) {
                        if($item['s_gender'] == 1) {
                            $img_url = $upload_path . 'default_man.png';
                        }
                        else
                            $img_url = $upload_path . 'default_women.png';
                    }
            ?>
                <tr>
                    <td><?=$i?></td>
                    <td>
                        <a class="fancybox-button" title="<?=$item['s_name']?>" rel="gallery" 
                            href="<?=base_url($img_url);?>"><img style="width: 50px; height: 50px;" src="<?=base_url($img_url);?>"></a>
                    </td>
                    <td><?=$item['s_serialNo']?></td>
                    <td><?=$item['s_name']?></td>
                    <td><?=$gender[$item['s_gender']]?></td>
                    <td><?=$item['s_birth']?></td>
                    <td><?=$item['s_schoolname']?></td>
                    <td><?=$item['user_id']?></td>
                    <td><?php
                        foreach ($sg_list as $key => $g_item) {
                            if ($g_item['sg_id'] == $item['sg_id']) {
                                echo $g_item['sg_label'];
                            }
                        }
                    ?></td>
                    <td>
                        <a href="javascript:void(0);" title="密码初始化" class="btn btn-primary btn-sm initpassword" data-id="<?=$item['s_id']?>"><i class="fa fa-lock"></i> </a>
                        <a href="<?=site_url('/student/showitem?s_id=' . $item['s_id'])?>" 
                            title="编辑" class="btn btn-success btn-sm" data-toggle="modal" data-target="#responsive_update"><i class="fa fa-edit"></i> </a>
                        <a href="javascript:void(0);" class="btn btn-danger btn-sm btn_delete" title="删除" acc-id="<?=$item['acc_id']?>" data-id="<?=$item['s_id']?>"><i class="fa fa-trash"></i> </a>
                    </td>
                </tr>
            <?php
                    $i ++;
                }
            ?>
            </tbody>
        </table>   
    </div>
</div>   

<a href="<?=site_url('/student/newstudent')?>" class="btn btn-success" data-toggle="modal" data-target="#responsive_new"><i class="fa fa-plus"></i> 添加</a>

<div id="responsive_new" class="modal fade form" tabindex="-1" data-width="660" >
    <form action="<?php echo site_url('student/insert'); ?>" id="new_data_form" class="form-horizontal" method="post" enctype="multipart/form-data">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h4 class="modal-title">添加</h4>
        </div>
        <div class="modal-body">

        </div>  
        <div class="modal-footer">                                          
            <button type="button" class="btn btn-primary" id="new_data">保存</button>
            <button type="button" data-dismiss="modal" class="btn btn-default">取消</button>
        </div>
    </form>
</div>

<div id="responsive_update" class="modal fade form" tabindex="-1" data-width="660" >
    <form action="<?php echo site_url('student/update'); ?>" id="update_data_form" class="form-horizontal" method="post" enctype="multipart/form-data">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h4 class="modal-title">资料更新</h4>
        </div>
        <div class="modal-body">
             
        </div>  
        <div class="modal-footer">                                          
            <button type="button" class="btn btn-primary" id="update_data">保存</button>
            <button type="button" data-dismiss="modal" class="btn btn-default">取消</button>
        </div>
    </form>
</div>