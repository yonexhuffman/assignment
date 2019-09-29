<script type="text/javascript">
	
	$(document).on('click' , '.noanswer' , function(){
		alert('还没提交答案.');
	})
	
	$(document).on('change' , '#ass_id' , function(){
		if (parseInt($(this).val()) > 0) {
			location.href = site_url + 'statistics?ass_id=' + $(this).val();
			return;
		}
		location.href = site_url + 'statistics';
	})

</script>