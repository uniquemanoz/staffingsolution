<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Profile_Model extends CI_Model {

    function __construct() {

        parent::__construct();
        
    }


    function getProfileInfo(){
        
        
        $this->db->select('*');
        $this->db->from('tbl_user u');
        $this->db->join('tbl_user_details ud','u.id=ud.user_id');
        $this->db->join('company c','c.companyid=ud.companyid');
        $this->db->join('role r','r.roleid=ud.roleid');
        $this->db->join('tbl_user_type ut','ut.user_type_id=u.user_type');
        $this->db->where(array('u.id'=>$this->session->userdata('id')));
       
         
        return $this->db->get()->result();
    }
    
   function updateProfileInfo(){
        
        $postdata=$this->input->post();
//        echo "<pre>";
//        print_r($postdata);
//        print_r($_FILES);exit;
        $companyProfile=$postdata['company_profile'];
        unset($postdata['company_profile']);  ///$postdata['company_profile'] is on other table company
        
        if(!empty($_FILES['profilepic']['name'])){
            $file=$this->picUpload();
            $postdata['profilepic']=$file['file_name'];
            $filename=$file['file_name'];
            $this->session->set_userdata(array('profilelink'=>$filename));
        }
       
        $this->db->where(array('user_id'=> $this->session->userdata('id')));
        $this->db->update('tbl_user_details',$postdata);
        
        // updating company profile
        $companyid=$this->getProfileInfo()[0]->companyid;
        if($companyid){
            $this->db->where(array('companyid'=> $companyid));
            $this->db->update('company',array('company_profile'=>$companyProfile));
        }
    }
    
    
    function picUpload(){
        
        $filename=null;
        $path = './uploads/users/'.$this->session->userdata('id').'/';
        if(!is_dir($path)){
              mkdir($path,0755,TRUE);
        } 
        $config['upload_path']          = $path;
        $config['allowed_types']        = 'gif|jpg|png';
        $this->load->library('upload', $config);
        if ( ! $this->upload->do_upload('profilepic')){
            $data = array('error' => $this->upload->display_errors());
            
        }else{
            $data = array('upload_data' => $this->upload->data());
            
        }
        return $this->upload->data();
        
        
    }

    
    
}
