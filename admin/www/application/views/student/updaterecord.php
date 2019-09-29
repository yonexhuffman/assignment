<?php
	if (isset($s_id) && $s_id > 0) {
		echo '<input type="hidden" name="s_id" value="'. $s_id .'"><input type="hidden" name="acc_id" value="'. $itemdata['acc_id'] .'">';
	}
?>
<div class="form-group">
	<label class="control-label col-md-3">学号</label>
	<div class="col-md-8">
		<input type="text" name="s_serialNo" class="form-control" value="<?php if(isset($itemdata) && isset($itemdata['s_serialNo'])) echo $itemdata['s_serialNo'];?>">
	</div>
</div>
<div class="form-group">
	<label class="control-label col-md-3">姓名</label>
	<div class="col-md-8">
		<input type="text" name="s_name" class="form-control" value="<?php if(isset($itemdata) && isset($itemdata['s_name'])) echo $itemdata['s_name'];?>">
	</div>
</div>
<div class="form-group">
	<label class="control-label col-md-3">性别</label>
	<div class="col-md-8" style="padding-left: 50px;">
		<div class="radio-list">
			<label class="radio-inline">
			<input type="radio" name="s_gender" id="optionsRadios4" value="1" 
			<?php 
				if(isset($itemdata)) {
					if (isset($itemdata['s_gender']) && $itemdata['s_gender'] == 1)
						echo 'checked';					
				}
				else {
					echo 'checked';
				}
			?>
			> <?=$gender[1]?> </label>
			<label class="radio-inline">
			<input type="radio" name="s_gender" id="optionsRadios5" value="2"
			<?php 
				if(isset($itemdata) && isset($itemdata['s_gender']) && $itemdata['s_gender'] == 2) 
					echo 'checked';
			?>
			> <?=$gender[2]?> </label>
		</div>
	</div>
</div>
<div class="form-group">
<?php
	if(isset($itemdata) && isset($itemdata['s_photo'])) {
		echo '<input type="hidden" name="uploaded_filename" value="' . $itemdata['s_photo'] . '">';
	}
?>
	<label class="control-label col-md-3">照片</label>
	<?php 
		if(isset($itemdata) && isset($itemdata['s_photo'])) {
	?>
	<div class="col-md-4">
		<input type="file" name="s_photo" class="form-control" value="">
	</div>
	<div class="col-md-4">
	<?php
		$filepath = $upload_path . $itemdata['s_photo'];
		if (file_exists($filepath)) {
	?>
	<img src="<?=base_url($filepath)?>" class="" style="width:100%;" >
	<?php
		}
		else {
			if($itemdata['s_gender'] == 1) {
				$filepath = $upload_path . 'default_man.png';
			}
			else
				$filepath = $upload_path . 'default_women.png';
	?>
	<img src="<?=base_url($filepath)?>" class="" style="width:100%;" >
	<?php
		}
	?>
	</div>	
	<?php
		}
		else {
	?>
	<div class="col-md-8">
		<input type="file" name="s_photo" class="form-control" value="">
	</div>
	<?php
		}
	?>
</div>
<div class="form-group">
	<label class="control-label col-md-3">出生日期</label>
	<div class="col-md-4">
		<input type="text" name="s_birth" class="form-control date-picker" value="<?php if(isset($itemdata) && isset($itemdata['s_birth'])) echo $itemdata['s_birth'];?>">
	</div>
</div>
<div class="form-group">
	<label class="control-label col-md-3">学校名称</label>
	<div class="col-md-8">
		<input type="text" name="s_schoolname" class="form-control" value="<?php if(isset($itemdata) && isset($itemdata['s_schoolname'])) echo $itemdata['s_schoolname'];?>">
	</div>
</div>
<div class="form-group">
	<label class="control-label col-md-3">학년</label>
	<div class="col-md-8">
		<input type="text" name="s_grade" class="form-control" value="<?php if(isset($itemdata) && isset($itemdata['s_grade'])) echo $itemdata['s_grade'];?>">
	</div>
</div>
<div class="form-group">
	<label class="control-label col-md-3">组号</label>
	<div class="col-md-8">
		<select name="sg_id" class="form-control">
			<option></option>
		<?php
			foreach ($sg_list as $key => $item) {
		?>
			<option value="<?=$item['sg_id']?>" 
			<?php 
				if(isset($itemdata) && isset($itemdata['sg_id']) && $itemdata['sg_id'] == $item['sg_id']) 
					echo 'selected';
			?>
			><?=$item['sg_number']?> - <?=$item['sg_label']?></option>
		<?php
			}
		?>
		</select>
	</div>
</div>
<div class="form-group">
	<label class="control-label col-md-3">경쟁대상</label>
	<div class="col-md-8">
		<select name="s_rival_id" class="form-control">
			<option></option>
		<?php
			if (isset($sg_members)) {				
				foreach ($sg_members as $key => $member) {
					$selected = '';
					if(isset($itemdata) && isset($itemdata['s_rival_id']) && $itemdata['s_rival_id'] == $member['s_id']) {
						$selected = 'selected';
					}
		?>
			<option value="<?=$member['s_id']?>" <?=$selected?> ><?=$member['s_name']?></option>
		<?php
				}
			}
		?>
		</select>
	</div>
</div>

<script type="text/javascript">	
	$('.date-picker').datepicker({
		format: 'yyyy-mm-dd',
		autoclose : true , 
	});
</script>