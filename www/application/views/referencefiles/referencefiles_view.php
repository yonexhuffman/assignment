<style type="text/css">
    .row {
        margin-top: 10px;
    }
</style>
<script type="text/javascript">
    var file_path = '<?=base_url($uploadpath_referencefile)?>';
</script>
<div class="row form">
    <div class="col-sm-0 col-md-2"></div>
    <div class="col-sm-12 col-md-8 form-horizontal">     
        <div class="row">
            <div class="col-sm-12" id="video_panel">
                <?php
                    $buf_ass_id = -1;
                    if (count($referencefiles) > 0) {
                        $ref_file_url = $uploadpath_referencefile . $referencefiles[0]['ref_file']; 
                        $buf_ass_id = $referencefiles[0]['ass_id'];
                        foreach ($referencefiles as $key => $reffile) {
                            if (empty($reffile['ref_file'])) {
                                continue;
                            }
                            if ($reffile['ass_id'] == $ass_id) {
                                $ref_file_url = $uploadpath_referencefile . $reffile['ref_file']; 
                                $buf_ass_id = $reffile['ass_id'];
                            }
                        }               
                ?>
                    <video autoplay controls style="width: 100%;margin-top: 10px;" id="video_tag">
                        <source src="<?=base_url($ref_file_url)?>" type="video/mp4">
                    </video>
                <?php
                    }
                    else {
                ?>
                    <video controls style="width: 100%;margin-top: 10px;" id="video_tag">
                        <source src="#" type="video/mp4">
                    </video>
                <?php
                    }
                ?>
            </div>
        </div>
<?php
    if (count($referencefiles) > 0) {
?>
        <div class="row">
            <div class="col-sm-12">
                <table class="table" id="reffile_table">
                    <thead>
                        <tr>
                            <th>题号</th>
                            <th>文件名</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        $file_count = 0;
                        foreach ($referencefiles as $key => $reffile) {
                            if (empty($reffile['ref_file'])) {
                                continue;
                            }
                            else {
                                $file_count ++;
                            }
                            $active = '';
                            if ($buf_ass_id > 0 && $buf_ass_id == $reffile['ass_id']) {
                                $active = 'active';
                            }
                            else if ($ass_id == $reffile['ass_id']) {
                                $active = 'active';
                            }
                    ?>
                        <tr class="<?=$active?>">
                            <td><?=$file_count?></td>
                            <td><?=$reffile['ref_file']?></td>
                            <td file-name="<?=$reffile['ref_file']?>" >
                                <button class="btn btn-success btn-sm reffile_open">
                                    <i class="fa fa-folder-open"></i>
                                </button>
                            </td>
                        </tr>
                    <?php
                        }
                        if ($file_count == 0) {
                    ?>
                        <tr><td colspan="3">没有文件.</td></tr>
                    <?php
                        }
                    ?>                        
                    </tbody>
                </table>
            </div>
        </div>
<?php
    }
    else {
        echo "没有文件.";
    }
?>
    </div>
</div>  