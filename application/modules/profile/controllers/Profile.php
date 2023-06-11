<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends MX_Controller {

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
        $this->load->model("profile/profile_model");
    }

    public function index() {
        
        
        
        if ($this->isSessionExist()) {
            
            if ($_POST) {
            
                $this->profile_model->updateProfileInfo();
                
            }
            $data['ProfileInfo']=  $this->profile_model->getProfileInfo();
            
//           echo "<pre>";
//            print_r($data);exit;
            $data['view_page'] = 'profile/index';
            $this->load->view('admin/adminlte/container', $data);
            

        } else {
            redirect('frontpage/index');
        }
    }
    
    
    public function changePassword(){
        $id = $this->input->post('id');
        if ($this->isSessionExist()) {
            
            if (!$_POST) {
            
                $data['ProfileInfo']=  $this->profile_model->getProfileInfo();
                $data['view_page'] = 'profile/password';
                $this->load->view('admin/adminlte/container', $data);
                
            }else{
                
                $dat=array(
                    'username'=>$this->input->post('username'),
                    'password'=>md5($this->input->post('password'))
                );

                $this->db->where(array('id'=>$id));
                $this->db->update('tbl_user',$dat);
                if($this->db->affected_rows()==1){

                    echo json_encode("You have successfully changed your credentials!");
                }else{
                    echo json_encode("Error!");
                }
            }
            
            
            
            
                
        } else {
            echo json_encode("You are not authorised to change it!");
        }
        
    }
    

    function isSessionExist(){
        if($this->session->userdata('id'))
            return TRUE;
        else
            FALSE;
    }
    
    
    
   

}
