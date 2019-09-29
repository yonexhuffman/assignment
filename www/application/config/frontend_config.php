<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$config['gender'] = array(
	1 => '男',
	2 => '女'
);

$config['user_role'] = array(
	'ADM' => '管理者',
	'TEA' => '教师',
	'STU' => '学生'
);

$config['menu'] = array(
	'TEA' => array(
		'1' => array(
				'icon'	=> 'icon-home' , 
				'title'	=> '首页' , 
				'url'	=> '/dashboard' , 
				'fa_icon'	=> 'fa-home' , 
			) , 
		'2' => array(
				'icon'	=> 'icon-notebook' , 
				'title'	=> '发布作业' , 
				'url'	=> '/assignmentproduce' , 
				'fa_icon'	=> 'fa-book' , 
			) , 
		'3' => array(
				'icon'	=> 'icon-layers' , 
				'title'	=> '检查作业' , 
				'url'	=> '/givepoint' , 
				'fa_icon'	=> 'fa-paw' , 
			) , 
		'4' => array(
			'icon'	=> 'icon-puzzle' , 
			'title'	=> '答题统计' , 
			'url'	=> '/statistics' , 
			'fa_icon'	=> 'fa-database' , 
		) , 
		'5' => array(
			'icon'	=> 'icon-logout' , 
			'title'	=> '注销' , 
			'url'	=> '/login/signup' , 
			'fa_icon'	=> 'fa-user' , 
		) , 
	) , 
	'STU' => array(
		'1' => array(
				'icon'	=> 'icon-home' , 
				'title'	=> '首页' , 
				'url'	=> '/dashboard' , 
				'fa_icon'	=> 'fa-home' , 
			) , 
		// '2' => array(
		// 		'icon'	=> 'icon-notebook' , 
		// 		'title'	=> '我的作业' , 
		// 		'url'	=> '/assignmentsubmit' , 
		// 		'fa_icon'	=> 'fa-book' , 
		// 	) , 
		'3' => array(
				'icon'	=> 'icon-badge' , 
				'title'	=> '我的作业' , 
				'url'	=> '/assignmentlist' , 
				'fa_icon'	=> 'fa-paw' , 
			) , 
		'4' => array(
			'icon'	=> 'icon-docs' , 
			'title'	=> '视频讲解' , 
			'url'	=> '/assignmentlist/referencefiles' , 
			'fa_icon'	=> 'fa-bookmark' , 
		) , 
		'5' => array(
			'icon'	=> 'icon-logout' , 
			'title'	=> '注销' , 
			'url'	=> '/login/signup' , 
			'fa_icon'	=> 'fa-user' , 
		) , 
	) , 
		
);