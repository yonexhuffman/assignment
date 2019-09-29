<script>
    var table = $('#group_table');

    // begin first table
    table.dataTable({

        // Internationalisation. For more info refer to http://datatables.net/manual/i18n

        // Or you can use remote translation file
        //"language": {
        //   url: '//cdn.datatables.net/plug-ins/3cfcc339e89/i18n/Portuguese.json'
        //},

        // Uncomment below line("dom" parameter) to fix the dropdown overflow issue in the datatable cells. The default datatable layout
        // setup uses scrollable div(table-scrollable) with overflow:auto to enable vertical scroll(see: assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js). 
        // So when dropdowns used the scrollable div should be removed. 
        //"dom": "<'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>r>t<'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>",

        "bStateSave": true, // save datatable state(pagination, sort, etc) in cookie.

        "columns": [
            { "orderable": true } , 
            { "orderable": false } , 
            { "orderable": true } , 
            { "orderable": true } , 
            { "orderable": true } , 
            { "orderable": true } , 
            { "orderable": true } , 
            { "orderable": true } , 
            { "orderable": true } , 
            { "orderable": false } , 
        ],
        "lengthMenu": [
            [20, 50, 100, -1],
            [20, 50, 100, "全部"] // change per page values here
        ],
        // set the initial value
        "pageLength": 20,            
        "pagingType": "bootstrap_full_number",
        "language": {
            "aria": {
                "sortAscending": ": activate to sort column ascending",
                "sortDescending": ": activate to sort column descending"
            },
            "emptyTable": "没有资料.",
            "info": " _START_ ~ _END_ (总共 : _TOTAL_) ",
            "infoEmpty": "没有资料.",
            "infoFiltered": "( 全部资料 _MAX_ )",
            "lengthMenu": "Show _MENU_ entries",
            "search": "关键词:",
            "zeroRecords": "没有查询结果.",
            "sInfo": " _START_ ~ _END_ (总共 : _TOTAL_) ",
            "sInfoEmpty": " ",
            "search": "关键词: ",
            "lengthMenu": "  _MENU_ ",
            "paginate": {
                "previous":"上一页",
                "next": "下一页",
                "last": "尾页",
                "first": "首页"
            }
        },
        "columnDefs": [{  // set default column settings
            'orderable': false,
            'targets': [2]
        }, {
            "searchable": false,
            "targets": [2]
        }],
        "order": [
            [3, "asc"]
        ] // set first column as a default sort by asc
    });

    $(document).on('click' , '#new_data' , function(){
        if ($('#new_data_form input[name=s_serialNo]').val() == '') {
            alert('请输入学号.');
            return;
        }
        if ($('#new_data_form input[name=s_name]').val() == '') {
            alert('请输入姓名.');
            return;
        }
        else if ($('#new_data_form input[name=s_birth]').val() == '') {
            alert('请输入出生日期.');
            return;
        } 
        loadingstart('#body_container');
        $('#new_data_form').submit();
    });

    $(document).on('click' , '#update_data' , function(){
        if ($('#update_data_form input[name=s_name]').val() == '') {
            alert('请输入姓名.');
            return;
        }
        else if ($('#update_data_form input[name=s_birth]').val() == '') {
            alert('请输入出生日期.');
            return;
        } 
        loadingstart('#body_container');
        $('#update_data_form').submit();
    });

    $(document).on('click' , '.initpassword' , function(){
    	var s_id = $(this).attr('data-id');
        if (confirm('确定进行当前的操作吗?')) {
            loadingstart('#body_container');
            $.ajax({
                url : site_url + 'student/initpassword' , 
                type: 'POST' , 
                dataType: "JSON" , 
                data: {
                    s_id : s_id , 
                } , 
                success: function(response) {
                    loadingend('#body_container');
                    if (response.success) {                 
                        toastr['success']('操作成功.');
                    }
                    else {
                        toastr['error']('操作失败.');    
                    }
                } , 
            });
        }        	
    });
    
    $(document).on('click' , '.btn_delete' , function(){
    	var s_id = $(this).attr('data-id');
    	var acc_id = $(this).attr('acc-id');
        if (confirm('确定进行当前的操作吗?')) {
            loadingstart('#body_container');
            $.ajax({
                url : site_url + 'student/delete' , 
                type: 'POST' , 
                dataType: "JSON" , 
                data: {
                    s_id : s_id , 
                    acc_id : acc_id , 
                } , 
                success: function(response) {
                    if (response.success) {                 
                        toastr['success']('操作成功.');
                        location.href = site_url + '/student';
                    }
                    else {
                        toastr['error']('操作失败.');   
                        loadingend('#body_container');
                    }
                } 
            })
        }  
    });

    $(document).on('change' , 'select[name=sg_id]' , function(){   
        var sg_id = $(this).val();     
        var selectObj = $("select[name=s_rival_id]");
        selectObj.empty();
                
        $.ajax({
            url : site_url + 'student/get_student_list' , 
            method: "POST" ,
            dataType: 'json' ,
            data: {
                sg_id: sg_id ,
            }
        })
        .done(function(data) {  
            var innerHtml = '';
            for(var i = 0 ; i < data.length ; i ++){
                innerHtml += '<option value="' + data[i].s_id + '">' + data[i].s_name + '</option>';
            }
            selectObj.append(innerHtml);
        });
    })

<?php
    if (isset($post_result_alarm_message)){
        if ($post_result_alarm_message['success']) {
?>
            toastr['success']('<?=$post_result_alarm_message['post_message']?>');
<?php
        }
        else {
?>
            toastr['error']('<?=$post_result_alarm_message['post_message']?>');
<?php        
        }
    }
?>
</script>