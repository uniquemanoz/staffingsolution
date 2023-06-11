<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Account extends MX_Controller {

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
        $this->load->helper('email');
        $this->load->helper('form');
        $this->load->model("account/account_model");
        
    }

    public function index() {

        if ($this->isSessionExist()) {
            
            if (!$_POST) {
            
                $data['InvoiceList']=  $this->account_model->getInvoiceList();
                //echo "<pre>"; print_r($data);exit;
                $data['view_page'] = 'account/index';
                $this->load->view('admin/adminlte/container', $data);
                
            }else{
                
            
                $data['InvoiceList']=  $this->account_model->getInvoiceList();
                //echo "<pre>"; print_r($data);exit;
                $data['view_page'] = 'account/index';
                $this->load->view('admin/adminlte/container', $data);
                
            
                
            }
            
            

        } else {
            redirect('frontpage/index');
        }

    }
    


     function isSessionExist(){
        if($this->session->userdata('id'))
            return TRUE;
        else
            FALSE;
    }
  
    

 

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */