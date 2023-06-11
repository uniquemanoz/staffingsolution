<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Roster_Model extends CI_Model {

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
    
    function addRoster(){
        //std obj
        $post= json_decode($this->input->post('employees'));
        $clientid=json_decode($this->input->post('clientid'));
        unset($post[0]);
        unset($post[1]);
        $now = new DateTime();
        $now->setTimezone(new DateTimezone('Australia/Sydney'));
        $now->format('Y-m-d H:i:s');
//        echo "<pre>";
//        print_r($post);
        
        
        foreach ($post as $value) {
//            $value->employeeid;
//            $value->start;
//            $value->end;
            $data=array(
                'employeeid'=>$value->employeeid,
                'clientid'=>$clientid,
                'startdatetime'=>$value->start,
                'enddatetime'=>$value->end,
                'assignedBy'=>$this->session->userdata('id'),
                'assignedDate'=>$now->format('Y-m-d H:i:s')
            );
            
            $this->db->insert('roster',$data);
           
        }
    }
    
    function getRoster(){
        $now = new DateTime();
        $now->setTimezone(new DateTimezone('Australia/Sydney'));
        $now->format('Y-m-d H:i:s');
        
        $start =   date('Y-m-d H:i:s',strtotime($this->input->post('start'))) ;
        $end =date('Y-m-d H:i:s',strtotime($this->input->post('end'))) ;
        
        
        

        $WhoHasWork =  "select distinct employeeid as id From roster where "
        . " isCancelled = 0 and "
        . " `startdatetime`  between STR_TO_DATE('{$start}', '%Y-%m-%d %H:%i:%s') and STR_TO_DATE('{$end}', '%Y-%m-%d %H:%i:%s')"
        . "  OR enddatetime  between STR_TO_DATE('{$start}', '%Y-%m-%d %H:%i:%s') and STR_TO_DATE('{$end}', '%Y-%m-%d %H:%i:%s') ";

        // second case in finding emp
        if(empty($this->db->query($WhoHasWork)->result_array())){
            $WhoHasWork =  "select distinct employeeid as id From roster where  "
                    . "  isCancelled = 0 and"
                    . "( startdatetime <STR_TO_DATE('{$start}', '%Y-%m-%d %H:%i:%s') and enddatetime > STR_TO_DATE('{$start}', '%Y-%m-%d %H:%i:%s')) "
                    . "and (startdatetime <STR_TO_DATE('{$end}', '%Y-%m-%d %H:%i:%s') and enddatetime > STR_TO_DATE('{$end}', '%Y-%m-%d %H:%i:%s')) ";
                    
        }
//        echo "<pre>";
//        
//        print_r($this->db->query($WhoHasWork)->result_array()); exit;

        $sql=" select * from tbl_user u "
                . "inner join tbl_user_details ud on u.id=ud.user_id "
                . "inner join company c on c.companyid=ud.companyid "
                . "inner join role r on r.roleid=ud.roleid "
                . "inner join tbl_user_type ut on ut.user_type_id=u.user_type "
                . "where r.rolename='Employee' "
                . "and u.id not in ({$WhoHasWork})"
                ;
       
        
        return $this->db->query($sql)->result_array();
        
    }
    
    function viewRoster(){
        
        $this->db->select('r.*,'
                . 'e.id as e_id,ude.first_name as e_first_name, ude.last_name as e_last_name, come.companyid as e_companyid,come.companyname as e_companyname, re.rolename as e_rolename, '
                . 'c.id as c_id,udc.first_name as c_first_name, udc.last_name as c_last_name,comc.companyid as c_companyid,comc.companyname as c_companyname, rc.rolename as c_rolename'
                
                );
        
        $this->db->from('roster r');
        
        $this->db->join('tbl_user e','e.id=r.employeeid');
        $this->db->join('tbl_user_details ude','e.id=ude.user_id');
        $this->db->join('company come','come.companyid=ude.companyid');
        $this->db->join('role re','re.roleid=ude.roleid');
        $this->db->join('tbl_user_type ute','ute.user_type_id=e.user_type');
        
        
        $this->db->join('tbl_user c','c.id=r.clientid');
        $this->db->join('tbl_user_details udc','c.id=udc.user_id');
        $this->db->join('company comc','comc.companyid=udc.companyid');
        $this->db->join('role rc','rc.roleid=udc.roleid');
        $this->db->join('tbl_user_type utc','utc.user_type_id=c.user_type');
       
       
        return $this->db->get('')->result();
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
    
    
    function getUpcommingRoster($userid){  // 
        
        $clientRole =$this->getRoleByID($userid);
        
        $now = new DateTime();
        $now->setTimezone(new DateTimezone('Australia/Sydney'));
        $now->format('Y-m-d H:i:s');
        
        $this->db->select('r.*,'
                . 'e.id as e_id,ude.first_name as e_first_name, ude.last_name as e_last_name, come.companyid as e_companyid,come.companyname as e_companyname, re.rolename as e_rolename, '
                . 'c.id as c_id,udc.first_name as c_first_name, udc.last_name as c_last_name,comc.companyid as c_companyid,comc.companyname as c_companyname, rc.rolename as c_rolename'
                
                );
        
        $this->db->from('roster r');
        
        $this->db->join('tbl_user e','e.id=r.employeeid');
        $this->db->join('tbl_user_details ude','e.id=ude.user_id');
        $this->db->join('company come','come.companyid=ude.companyid');
        $this->db->join('role re','re.roleid=ude.roleid');
        $this->db->join('tbl_user_type ute','ute.user_type_id=e.user_type');
        
        
        $this->db->join('tbl_user c','c.id=r.clientid');
        $this->db->join('tbl_user_details udc','c.id=udc.user_id');
        $this->db->join('company comc','comc.companyid=udc.companyid');
        $this->db->join('role rc','rc.roleid=udc.roleid');
        $this->db->join('tbl_user_type utc','utc.user_type_id=c.user_type');
        
        if($clientRole=="Client"){
            $this->db->where(array('c.id'=>$userid,'enddatetime >'=>$now->format('Y-m-d H:i:s')));
            
            
        }
        if($clientRole=="Employee"){
            $this->db->where(array('e.id'=>$userid,'enddatetime >'=>$now->format('Y-m-d H:i:s')));
        }
        
      
        return $this->db->get('')->result();
        
    }
    
        function getPastRoster($userid){  // 
        
        $clientRole =$this->getRoleByID($userid);
        
        $now = new DateTime();
        $now->setTimezone(new DateTimezone('Australia/Sydney'));
        $now->format('Y-m-d H:i:s');
        
        $this->db->select('r.*,'
                . 'e.id as e_id,ude.first_name as e_first_name, ude.last_name as e_last_name, come.companyid as e_companyid,come.companyname as e_companyname, re.rolename as e_rolename, '
                . 'c.id as c_id,udc.first_name as c_first_name, udc.last_name as c_last_name,comc.companyid as c_companyid,comc.companyname as c_companyname, rc.rolename as c_rolename'
                
                );
        
        $this->db->from('roster r');
        
        $this->db->join('tbl_user e','e.id=r.employeeid');
        $this->db->join('tbl_user_details ude','e.id=ude.user_id');
        $this->db->join('company come','come.companyid=ude.companyid');
        $this->db->join('role re','re.roleid=ude.roleid');
        $this->db->join('tbl_user_type ute','ute.user_type_id=e.user_type');
        
        
        $this->db->join('tbl_user c','c.id=r.clientid');
        $this->db->join('tbl_user_details udc','c.id=udc.user_id');
        $this->db->join('company comc','comc.companyid=udc.companyid');
        $this->db->join('role rc','rc.roleid=udc.roleid');
        $this->db->join('tbl_user_type utc','utc.user_type_id=c.user_type');
        
        if($clientRole=="Client"){
            $this->db->where(array('c.id'=>$userid,'enddatetime <'=>$now->format('Y-m-d H:i:s')));
            
            
        }
        if($clientRole=="Employee"){
            $this->db->where(array('e.id'=>$userid,'enddatetime <'=>$now->format('Y-m-d H:i:s')));
        }
        
      
        return $this->db->get('')->result();
        
    }
    
    
    function getRoleByID($userid){
        $this->db->select('r.rolename');
        $this->db->from('tbl_user_details ud');
        $this->db->join('role r','r.roleid=ud.roleid');
        $this->db->where('ud.user_id',$userid);
        return $this->db->get('')->result()[0]->rolename;
        
    }
}
