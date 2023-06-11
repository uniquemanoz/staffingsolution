<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Account_Model extends CI_Model {

    function __construct() {

        parent::__construct();
        
    }


    function getClientList(){
        
        $this->db->select('*');
        $this->db->from('tbl_user u');
        $this->db->join('tbl_user_details ud','u.id=ud.user_id');
        $this->db->join('company c','c.companyid=ud.companyid');
        $this->db->join('role r','r.roleid=ud.roleid');
        $this->db->join('tbl_user_type ut','ut.user_type_id=u.user_type');
        $this->db->where('r.rolename','Client');
        return $this->db->get('')->result_array();
    }
    
    function getEmployeeListByAvai(){
        
        $this->db->select('*');
        $this->db->from('tbl_user u');
        $this->db->join('tbl_user_details ud','u.id=ud.user_id');
        $this->db->join('company c','c.companyid=ud.companyid');
        $this->db->join('role r','r.roleid=ud.roleid');
        $this->db->where('r.rolename','Employee');
        return $this->db->get('')->result_array();
    }
    


    function getClinetList(){
        
        $this->db->select('*');
        $this->db->from('tbl_user u');
        $this->db->join('tbl_user_details ud','u.id=ud.user_id');
        $this->db->join('company c','c.companyid=ud.companyid');
        $this->db->join('role r','r.roleid=ud.roleid');
        $this->db->join('tbl_user_type ut','ut.user_type_id=u.user_type');
        $this->db->where('r.rolename','Client');
        return $this->db->get('')->result();
    }
  

    function getInvoiceList(){
    
        $this->db->select();
       
        $this->db->from('invoice_ref ir');
        $this->db->join('tbl_user_details ud','ud.user_id=ir.clientid');
        $this->db->join('account ac','ac.invoicerefid=ir.invoicerefid');
        
        if($this->session->userdata('rolename')=="Client"){
            $this->db->where(array('ir.clientid'=>$this->session->userdata('id')));
      
        }
        if($_POST){
   
            $start =date('Y-m-d',strtotime($this->input->post('start')));
            $end = date('Y-m-d',strtotime($this->input->post('end')));
            

            $this->db->where('ir.createddate BETWEEN "'. date('Y-m-d', strtotime($start)). '" and "'. date('Y-m-d', strtotime($end)).'"');
            
        }
   
        
        return $this->db->get('')->result_array();
    }
    

   
    
}
