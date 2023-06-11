<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Facebook extends MX_Controller {
     public function __construct()
	{
		parent::__construct();
		$this->load->library('pagination');
                
                $this->load->library('email');
                $this->load->helper('date');
	 
	}
        
        public function index()
	{
            
             
            $data['view_page']="facebook/index";
            $this->load->view('admin/adminlte/container', $data);
        }
        
        
        
  
        
}