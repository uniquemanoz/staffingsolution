<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class User_Model extends CI_Model {

    function __construct() {

        parent::__construct();
        
    }


    function getUsersList(){
        
        $this->db->select('*');
        $this->db->from('tbl_user u');
        $this->db->join('tbl_user_details ud','u.id=ud.user_id');
        $this->db->join('company c','c.companyid=ud.companyid');
        $this->db->join('role r','r.roleid=ud.roleid');
        $this->db->join('tbl_user_type ut','ut.user_type_id=u.user_type');
        return $this->db->get('')->result_array();
    }
    
    function changeStatus(){
        $id=$this->input->post('id');
        $status=$this->input->post('status');
        $data=array();
        if($status=="block"){
             $data=array('block_status'=>1);
        }
        if($status=="unblock"){
             $data=array('block_status'=>0);
        }
        if($status=="delete"){
             $data=array('isDeleted'=>1);
        }
        if($status=="active"){
             $data=array('isActive'=>1);
        }
        if($status=="inactive"){
             $data=array('isActive'=>0);
        }
        print_r($data);
        //exit();
        $this->db->where('id',$id);
        $query=$this->db->update('tbl_user',$data);
        return $query;
    }
    
    public function getUserProfile($userid){
        
        $this->db->select('*');
        $this->db->from('tbl_user u');
        $this->db->join('tbl_user_details ud','u.id=ud.user_id');
        $this->db->join('company c','c.companyid=ud.companyid');
        $this->db->join('role r','r.roleid=ud.roleid');
        $this->db->join('tbl_user_type ut','ut.user_type_id=u.user_type');
        $this->db->join('state s','s.stateid=c.stateid');
        $this->db->where(array('u.id'=>$userid));
        return $this->db->get('')->result();
    }

}
