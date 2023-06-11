<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Systemmsg extends MX_Controller {

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     * 		http://example.com/index.php/welcome
     * 	- or -  
     * 		http://example.com/index.php/welcome/index
     * 	- or -
     * Since this controller is set as the default controller in 
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see http://codeigniter.com/user_guide/general/urls.html
     */
    public function __construct() {
        parent::__construct();
        $this->load->library('pagination');
        $this->load->helper('directory');
        $this->load->library('email');
        $this->load->helper('form');
        $this->load->model("systemmsg/systemmsg_model");
        
        
    }

    public function index() {
       
      
      // $this->systemmsg_model->getReminderList();
       //$this->systemmsg_model->getAlertList();
       
    }
    
    function alertmessage(){
        $this->systemmsg_model->getAlertList();
    }
    
    function remindermessage(){
        $this->systemmsg_model->getReminderList();
    }


   


  



}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */