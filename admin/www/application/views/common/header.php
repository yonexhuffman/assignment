
<!-- BEGIN THEME STYLES -->
<link href="<?php echo base_url('../assets/global/css/components.css');?>" id="style_components" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url('../assets/global/css/plugins.css');?>" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url('../assets/admin/layout/css/layout.css');?>" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url('../assets/admin/layout/css/themes/darkblue.css');?>" rel="stylesheet" type="text/css" id="style_color"/>
<link href="<?php echo base_url('../assets/admin/layout/css/custom.css');?>" rel="stylesheet" type="text/css"/>

<!-- END THEME STYLES -->
<link rel="shortcut icon" href="<?php echo base_url(FAVICONURL);?>"/>
<style>
    .page-sidebar-closed.page-sidebar-fixed .page-sidebar:hover .sidebar-toggler, .page-sidebar .sidebar-toggler{
        margin-bottom: 15px;
    }
    .page-container-bg-solid .page-bar{
        margin: -25px -20px 20px -20px;
    }
    .page-header.navbar .top-menu .navbar-nav > li.dropdown-user > .dropdown-menu{
        width: 230px;
    }
    .table>caption+thead>tr:first-child>td, .table>caption+thead>tr:first-child>th, .table>colgroup+thead>tr:first-child>td, .table>colgroup+thead>tr:first-child>th, .table>thead:first-child>tr:first-child>td, .table>thead:first-child>tr:first-child>th {
        text-align : center;        
    }
    table.table-bordered tbody th, table.table-bordered tbody td{
        text-align : center;
        vertical-align: middle;
    }
</style>
<script>
    var site_url = "<?=site_url('/')?>";
    var base_url = "<?=base_url('/')?>";
</script>