<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Roster extends MX_Controller {

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
     * 
     * 
     */
    
    
    public function __construct() {
        parent::__construct();
        $this->load->library('pagination');
        
        $this->load->library('email');
        $this->load->helper('date');
        $this->load->model("roster/roster_model");
    }

    public function index() {
        
        
        
        if ($this->isSessionExist()) {
            
            if (!$_POST) {
            
               
                $data['client']=  $this->roster_model->getClientList();
                $data['availEmployee']=  $this->roster_model->getEmployeeListByAvai();
                //echo "<pre>"; print_r($data);exit;
                $data['view_page'] = 'roster/index';
                $this->load->view('admin/adminlte/container', $data);
                
            }
            
            

        } else {
            redirect('frontpage/index');
        }
    }
    
    function addRoster(){
        if ($this->isSessionExist()) {
            
            if ($_POST) {
                
                $this->roster_model->addRoster();
                
            }
          
        } else {
            redirect('frontpage/index');
        }
        
    }
    
    function getRoster(){
        if ($this->isSessionExist()) {
            
            if ($_POST) {
                
                $data=$this->roster_model->getRoster();
                //echo "<pre>";   print_r($this->roster_model->getRoster());exit;
                echo json_encode($data);
            }
          
        } else {
            redirect('frontpage/index');
        }
        
    }
    
    function viewroster(){
        if ($this->isSessionExist()) {
            
            if (!$_POST) {
                
                $data['Clients']= $this->roster_model->getClinetList();
                $data['rosters']= $this->roster_model->viewRoster();
                
                //echo "<pre>"; print_r($data);exit;
                $data['view_page'] = 'roster/viewroster';
                $this->load->view('admin/adminlte/container', $data);
                
            }
          
        } else {
            redirect('frontpage/index');
        }
        
    }
    
        function cancelRoster(){
        if ($this->isSessionExist()) {
            
                
                $rosterid=$this->input->post('rosterid');
                $isCancelled=$this->input->post('isCancelled');
                $sql = "UPDATE roster SET isCancelled = not isCancelled where rosterid=$rosterid";
                $querry = $this->db->query($sql);

                if ($querry && isCancelled==0) {
                    return "Successfully Cancelled the routine";
                } elseif ($querry && isCancelled==1) {
                    return "Successfully uncancelled the routine!";
               }
                else{
                    return "Failed";

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
