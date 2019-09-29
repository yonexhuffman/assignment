<div class="row">
    <div class="col-md-8">
        <table class="table table-striped table-bordered table-hover" id="group_table">
            <colgroup>
                <col width="10%"></col>
                <col width="20%"></col>
                <col width="25%"></col>
                <col width="25%"></col>
                <col width="20%"></col>
            </colgroup>
            <thead>
                <tr>
                    <th>
                        序号
                    </th>
                    <th>
                        组号
                    </th>
                    <th>
                        组名
                    </th>
                    <th>
                        教师
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
            ?>
                <tr>
                    <td><?=$i?></td>
                    <td><?=$item['sg_number']?></td>
                    <td><?=$item['sg_label']?></td>
                    <td><?=$item['t_name']?></td>
                    <td>
                        <a href="<?=site_url('/studentgroup/showitem?sg_id=' . $item['sg_id'])?>" class="btn btn-success btn-sm" data-toggle="modal" data-target="#responsive1"><i class="fa fa-edit"></i> </a>
                        <a href="#" class="btn btn-danger btn-sm btn_delete" data-id="<?=$item['sg_id']?>"><i class="fa fa-trash"></i> </a>
                    </td>
                </tr>
            <?php
                    $i ++;
                }
            ?>
            </tbody>
        </table>     
        <div class="well">
            <form method="POST" action="<?=site_url('studentgroup/insert')?>" id="new_data_form">
            <div class="row">
                <div class="col-md-2">
                    <h4>添加</h4>
                </div>
                <div class="col-md-4">
                    <div class="row">
                        <div class="col-md-3">
                            <h5>组号 : </h5>
                        </div>
                        <div class="col-md-9">
                            <input type="text" name="sg_number" class="form-control" placeholder="组号">
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="row">
                        <div class="col-md-3">
                            <h5>组名 : </h5>
                        </div>
                        <div class="col-md-9">
                            <input type="text" name="sg_label" class="form-control" placeholder="组名">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-2"></div>
                <div class="col-md-4">
                    <div class="row">
                        <div class="col-md-3">
                            <h5>担任教师 :</h5>
                        </div>
                        <div class="col-md-9">
                            <select class="form-control" name="t_id">
                                <?php
                                    foreach ($teacherlist as $key => $teacher) {
                                ?>
                                <option value="<?=$teacher['t_id']?>"><?=$teacher['t_name']?></option>
                                <?php
                                    }
                                ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-md-2">
                    <button type="button" class="btn btn-success new_data">添加</button>
                </div>
            </div>
            </form>
        </div>   
    </div>
    <div class="col-md-4">
        <div class="note note-success" style="text-indent: 15px;">
            在组号管理里面可以添加或更新组号。
            删除组号是请确定组里没有学生。
        </div>
        <div class="note note-danger" style="text-indent: 15px;">
            如果删除组号组里的学生会一起删除。
        </div>
    </div>
</div>   

<div id="responsive1" class="modal fade form" tabindex="-1" data-width="660" >
    <form action="<?php echo site_url('studentgroup/update'); ?>" id="letter_form" class="form-horizontal" method="post" enctype="multipart/form-data">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h4 class="modal-title">编辑</h4>
        </div>
        <div class="modal-body">

        </div>  
        <div class="modal-footer">                                          
            <button type="submit" class="btn btn-primary" id="new">保存</button>
            <button type="button" data-dismiss="modal" class="btn btn-default">取消</button>
        </div>
    </form>
</div>