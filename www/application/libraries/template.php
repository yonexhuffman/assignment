<?php defined('BASEPATH') OR exit('No direct script access allowed');

class template {
	protected $CI;

	public function __construct() {
		// Assign the CodeIgniter super-object
		$this->CI =& get_instance();
	}

	public function pageview($page_name , $header_data = array() , $view_data = array() , $footer_data = array()) {		
		// IMPORT CORE CSS 
		$this->CI->load->view('common/header' , $header_data);
		
		// SIDEBAR
		$this->CI->load->view('common/sidebar' , $header_data);
		// // MAIN PAGE VIEW
		$this->CI->load->view($page_name . '/' . $page_name . '_view' , $view_data);
		
		// IMPORT PLUGIN JS
		$this->CI->load->view('common/footer' ,  $footer_data);
		// // CUSTOMIZING PAGE JS
		$this->CI->load->view('pagescripts/' . $page_name . '_js' ,  $footer_data);
		$this->CI->load->view('common/html_footer');
	}
}
