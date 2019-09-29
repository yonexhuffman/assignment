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
                <col width="13%"></col>
                <col width="15%"></col>
                <col width="10%"></col>
                <col width="15%"></col>
                <col width="10%"></col>
                <col width="10%"></col>
                <col width="10%"></col>
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
                        姓名
                    </th>
                    <th>
                        性别
                    </th>
                    <th>
                        出生日期
                    </th>
                    <th>
                        账号
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
                    $img_url = $upload_path . $item['t_photo'];
                    if (!file_exists($img_url)) {
                        if($item['t_gender'] == 1) {
                            $img_url = $upload_path . 'default_man.png';
                        }
                        else
                            $img_url = $upload_path . 'default_women.png';
                    }
            ?>
                <tr>
                    <td><?=$i?></td>
                    <td>
                        <a class="fancybox-button" title="<?=$item['t_name']?>" rel="gallery" 
                            href="<?=base_url($img_url);?>"><img style="width: 50px; height: 50px;" src="<?=base_url($img_url);?>"></a>
                    </td>
                    <td><?=$item['t_name']?></td>
                    <td><?=$gender[$item['t_gender']]?></td>
                    <td><?=$item['t_birth']?></td>
                    <td><?=$item['user_id']?></td>
                    <!-- <td><?php
                        foreach ($tg_list as $key => $g_item) {
                            if ($g_item['tg_id'] == $item['tg_id']) {
                                echo $g_item['tg_label'];
                            }
                        }
                    ?></td> -->
                    <td>
                        <a href="#" title="密码初始化" class="btn btn-primary btn-sm initpassword" data-id="<?=$item['t_id']?>"><i class="fa fa-lock"></i> </a>
                        <a href="<?=site_url('/teacher/showitem?t_id=' . $item['t_id'])?>" 
                            title="编辑" class="btn btn-success btn-sm" data-toggle="modal" data-target="#responsive_update"><i class="fa fa-edit"></i> </a>
                        <a href="#" class="btn btn-danger btn-sm btn_delete" title="删除" acc-id="<?=$item['acc_id']?>" data-id="<?=$item['t_id']?>"><i class="fa fa-trash"></i> </a>
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

<a href="<?=site_url('/teacher/newteacher')?>" class="btn btn-success" data-toggle="modal" data-target="#responsive_new"><i class="fa fa-plus"></i> 添加</a>

<div id="responsive_new" class="modal fade form" tabindex="-1" data-width="660" >
    <form action="<?php echo site_url('teacher/insert'); ?>" id="new_data_form" class="form-horizontal" method="post" enctype="multipart/form-data">
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
    <form action="<?php echo site_url('teacher/update'); ?>" id="update_data_form" class="form-horizontal" method="post" enctype="multipart/form-data">
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