<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Systemmsg_Model extends CI_Model {

    function __construct() {

        parent::__construct();
        
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
    
    function getReminderList(){
        //reminding is like reminding a client has some days remaining to pay the money
        $now = new DateTime();
        $now->setTimezone(new DateTimezone('Australia/Sydney'));
        $now->format('Y-m-d');
        
        $this->db->select('*');
        $this->db->where(array('duedate >='=>$now->format('Y-m-d')));
        $this->db->where(array('isPaymentDone'=>0));
        
        $data=$this->db->get('invoice_ref')->result_array();
        foreach ($data as $value) {
           
           $invoicelink= site_url().'/invoice/download/'.$value['clientid'].'/'.$value['invoicerefid'];
           
           $email= $this->getEmailByID($value['clientid']);
            echo $email.  '  '.$invoicelink;
           $this->sendMailToPersonRemind($email,$invoicelink);
        }
    }
    
    function getAlertList(){
        //Alert is like reminding a client has cross the due date
        $now = new DateTime();
        $now->setTimezone(new DateTimezone('Australia/Sydney'));
        $now->format('Y-m-d');
        
        $this->db->select('*');
        $this->db->where(array('duedate <='=>$now->format('Y-m-d')));
        $this->db->where(array('isPaymentDone'=>0));
        
        $data=$this->db->get('invoice_ref')->result_array();
        
        
        foreach ($data as $value) {
           
           $invoicelink= site_url().'/invoice/download/'.$value['clientid'].'/'.$value['invoicerefid'];
           
           $email= $this->getEmailByID($value['clientid']);
           echo $email.  '  '.$invoicelink;
           
           $this->sendMailToPersonAlert($email,$invoicelink);
        }
    }
    
    function getEmailByID($id){
        
        $this->db->where(array('user_id'=>$id));
        return $this->db->get('tbl_user_details')->row_array()['email'];
    }
    
    function sendMailToPersonAlert($email,$link){
            
            $config['protocol'] = 'sendmail';
            $config['mailpath'] = '/usr/sbin/sendmail';
            $config['charset'] = 'iso-8859-1';
            $config['wordwrap'] = TRUE;
            $config['mailtype'] = 'html';

            
            $subject = "Alert Message for crossing payment due date.";
            $message='
            <p>You have crossed the payment due date of invoice.Staffing Solution is reminding the payment of this attached invoice.  </p>
            <p><a href="'.$link.'"><button> Click here to view invoice</button></a></p>';

            $this->email->initialize($config);

            $this->email->from('info@staffingsolution.live', 'Staffing Solution');  // email, name

            $this->email->to($email);

            $this->email->subject($subject);
            $this->email->message($message);
            $this->email->send();
            //echo $this->email->print_debugger();
    
        
    }

    
    
    function sendMailToPersonRemind($email,$link){
            
            $config['protocol'] = 'sendmail';
            $config['mailpath'] = '/usr/sbin/sendmail';
            $config['charset'] = 'iso-8859-1';
            $config['wordwrap'] = TRUE;
            $config['mailtype'] = 'html';

            
            $subject = "Reminding Message for  payment before due date.";
            $message='<p>You have crossed the payment due date of invoice.Staffing Solution is reminding the payment of this attached invoice.  </p>
            <p><a href="'.$link.'"><button> Click here to view invoice</button></a></p>';

            $this->email->initialize($config);

            $this->email->from('info@staffingsolution.live', 'Staffing Solution');  // email, name

            $this->email->to($email);

            $this->email->subject($subject);
            $this->email->message($message);
            $this->email->send();
            //echo $this->email->print_debugger();
    
        
    }


  
   

   
    
}
