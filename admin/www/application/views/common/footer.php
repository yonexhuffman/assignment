<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="<?php echo base_url('../assets/global/scripts/metronic.js');?>" type="text/javascript"></script>
<script src="<?php echo base_url('../assets/admin/layout/scripts/layout.js');?>" type="text/javascript"></script>
<script src="<?php echo base_url('../assets/admin/layout/scripts/demo.js');?>" type="text/javascript"></script>
<!-- END PAGE LEVEL SCRIPTS -->
<script>
function loadingstart(target_id){
    Metronic.blockUI({
        target: target_id ,
        animate: true
    });
}
function loadingend(target_id){
    Metronic.unblockUI(target_id);
}

jQuery(document).ready(function() {     
	Metronic.init(); // init metronic core components
	Layout.init(); // init current layout
	Demo.init();


	$(document).on('click' , '.btn_formsubmit' , function(){
		loadingstart('#body_container');
	});

});
</script>
<!-- END JAVASCRIPTS -->