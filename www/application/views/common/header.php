<!DOCTYPE html>
<!-- 
Template Name: Metronic - Responsive Admin Dashboard Template build with Twitter Bootstrap 3.3.2
Version: 3.7.0
Author: KeenThemes
Website: http://www.keenthemes.com/
Contact: support@keenthemes.com
Follow: www.twitter.com/keenthemes
Like: www.facebook.com/keenthemes
Purchase: http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes
License: You must have a valid license purchased only from themeforest(the above link) in order to legally use the theme for your project.
-->
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en" class="no-js">
<!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
<meta charset="utf-8"/>
<title><?=SCHOOLTITLE?></title>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<meta http-equiv="Content-type" content="text/html; charset=utf-8">
<meta content="" name="description"/>
<meta content="" name="author"/>
<!-- BEGIN GLOBAL MANDATORY STYLES -->
<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url('assets/global/plugins/font-awesome/css/font-awesome.min.css');?>" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url('assets/global/plugins/simple-line-icons/simple-line-icons.min.css');?>" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url('assets/global/plugins/bootstrap/css/bootstrap.min.css');?>" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url('assets/global/plugins/uniform/css/uniform.default.css');?>" rel="stylesheet" type="text/css"/>
<!-- END GLOBAL MANDATORY STYLES -->
<link href="<?php echo base_url('assets/global/plugins/bootstrap-toastr/toastr.min.css');?>" rel="stylesheet" type="text/css"/>
<!-- BEGIN PAGE LEVEL PLUGINS -->
<!-- IMPORT PLUGIN CSS -->
<?php
    if (isset($plugin_css) && is_array($plugin_css)) {
        foreach ($plugin_css as $key => $css) {
?>
<link href="<?php echo base_url('assets/global/plugins/' . $css);?>" rel="stylesheet" type="text/css"/>
<?php
        }
    }
?>
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN THEME STYLES -->
<link href="<?php echo base_url('assets/global/css/components.css');?>" id="style_components" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url('assets/global/css/plugins.css');?>" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url('assets/admin/layout/css/layout.css');?>" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url('assets/admin/layout/css/themes/darkblue.css');?>" rel="stylesheet" type="text/css" id="style_color"/>
<link href="<?php echo base_url('assets/admin/layout/css/custom.css');?>" rel="stylesheet" type="text/css"/>

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
    table.table-bordered tbody th, table.table-bordered tbody td , table.table tbody td{
        text-align : center;
        vertical-align: middle;
    }
    .f-left{
        float: left;
    }
    .f-right{
        float: right;
    }
    .clear{
        clear: both;
    }
    .scroll-to-top > i{
        font-size: 40px;
    }
</style>
<script>
    var site_url = "<?=site_url('/')?>";
    var base_url = "<?=base_url('/')?>";
    var emoticon_src_url = base_url + 'assets/global/plugins/emoticon/js/plugins/emoticons/';
</script>
