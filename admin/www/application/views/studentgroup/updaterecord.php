<input type="hidden" name="sg_id" value="<?=$sg_id?>">
<div class="form-group">
	<label class="control-label col-md-3">组号</label>
	<div class="col-md-8">
		<input type="text" name="sg_number" class="form-control" value="<?=$itemdata['sg_number']?>">
	</div>
</div>
<div class="form-group">
	<label class="control-label col-md-3">组名</label>
	<div class="col-md-8">
		<input type="text" name="sg_label" class="form-control" value="<?=$itemdata['sg_label']?>">
	</div>
</div>
<div class="form-group">
	<label class="control-label col-md-3">担任教师</label>
	<div class="col-md-8">
        <select class="form-control" name="t_id">
            <option></option>
            <?php
                foreach ($teacherlist as $key => $teacher) {
                	$active = '';
                	if ($itemdata['t_id'] == $teacher['t_id']) {
                		$active = 'selected';
                	}
            ?>
            <option value="<?=$teacher['t_id']?>" <?=$active?>><?=$teacher['t_name']?></option>
            <?php
                }
            ?>
        </select>
	</div>
</div>