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
	'1' => array(
			'icon'	=> 'icon-home' , 
			'title'	=> '组号管理' , 
			'url'	=> '/studentgroup' , 
			'fa_icon'	=> 'fa-group' , 
		) , 
	'2' => array(
			'icon'	=> 'icon-user' , 
			'title'	=> '学生管理' , 
			'url'	=> '/student' , 
			'fa_icon'	=> 'fa-user' , 
		) , 
	// '3' => array(
	// 		'icon'	=> 'icon-home' , 
	// 		'title'	=> '教师组号管理' , 
	// 		'url'	=> '/teachergroup' , 
	// 		'fa_icon'	=> 'fa-group' , 
	// 	) , 
	'4' => array(
		'icon'	=> 'icon-user' , 
		'title'	=> '教师管理' , 
		'url'	=> '/teacher' , 
		'fa_icon'	=> 'fa-user' , 
	) , 
	'5' => array(
		'icon'	=> 'icon-lock' , 
		'title'	=> '管理者信息' , 
		'url'	=> '/admininfo' , 
		'fa_icon'	=> 'fa-key' , 
	) , 
);