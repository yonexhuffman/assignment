<?php
	if (isset($t_id) && $t_id > 0) {
		echo '<input type="hidden" name="t_id" value="'. $t_id .'"><input type="hidden" name="acc_id" value="'. $itemdata['acc_id'] .'">';
	}
?>
<div class="form-group">
	<label class="control-label col-md-3">姓名</label>
	<div class="col-md-8">
		<input type="text" name="t_name" class="form-control" value="<?php if(isset($itemdata) && isset($itemdata['t_name'])) echo $itemdata['t_name'];?>">
	</div>
</div>
<div class="form-group">
	<label class="control-label col-md-3">性别</label>
	<div class="col-md-8" style="padding-left: 50px;">
		<div class="radio-list">
			<label class="radio-inline">
			<input type="radio" name="t_gender" id="optionsRadios4" value="1" 
			<?php 
				if(isset($itemdata)) {
					if (isset($itemdata['t_gender']) && $itemdata['t_gender'] == 1)
						echo 'checked';					
				}
				else {
					echo 'checked';
				}
			?>
			> <?=$gender[1]?> </label>
			<label class="radio-inline">
			<input type="radio" name="t_gender" id="optionsRadios5" value="2"
			<?php 
				if(isset($itemdata) && isset($itemdata['t_gender']) && $itemdata['t_gender'] == 2) 
					echo 'checked';
			?>
			> <?=$gender[2]?> </label>
		</div>
	</div>
</div>
<div class="form-group">
<?php
	if(isset($itemdata) && isset($itemdata['t_photo'])) {
		echo '<input type="hidden" name="uploaded_filename" value="' . $itemdata['t_photo'] . '">';
	}
?>
	<label class="control-label col-md-3">照片</label>
	<?php 
		if(isset($itemdata) && isset($itemdata['t_photo'])) {
	?>
	<div class="col-md-4">
		<input type="file" name="t_photo" class="form-control" value="">
	</div>
	<div class="col-md-4">
	<?php
		$filepath = $upload_path . $itemdata['t_photo'];
		if (file_exists($filepath)) {
	?>
	<img src="<?=base_url($filepath)?>" class="" style="width:100%;" >
	<?php
		}
		else {
			if($itemdata['t_gender'] == 1) {
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
		<input type="file" name="t_photo" class="form-control" value="">
	</div>
	<?php
		}
	?>
</div>
<div class="form-group">
	<label class="control-label col-md-3">出生日期</label>
	<div class="col-md-4">
		<input type="text" name="t_birth" class="form-control date-picker" value="<?php if(isset($itemdata) && isset($itemdata['t_birth'])) echo $itemdata['t_birth'];?>">
	</div>
</div>
<script type="text/javascript">	
	$('.date-picker').datepicker({
		format: 'yyyy-mm-dd',
		autoclose : true , 
	});
</script>