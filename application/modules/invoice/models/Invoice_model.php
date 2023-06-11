<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Invoice_Model extends CI_Model {

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
    
    
    function getInvoiceList(){
    
        $this->db->select();
       
        $this->db->from('invoice_ref ir');
        $this->db->join('tbl_user_details ud','ud.user_id=ir.clientid');
        $this->db->join('account ac','ac.invoicerefid=ir.invoicerefid');
        
        if($this->session->userdata('rolename')=="Client"){
            $this->db->where(array('ir.clientid'=>$this->session->userdata('id')));
            
            
        }
   
        
        return $this->db->get('')->result_array();
    }
    
    
    function makeinvoice(){
        $rosterids= json_decode($this->input->post('rosterids'));
        $clientid=json_decode($this->input->post('clientid'));
        //print_r($rosterids);
        
        
        $now = new DateTime();
        $now->setTimezone(new DateTimezone('Australia/Sydney'));
        $now->format('Y-m-d H:i:s');
        
        //get Invoice reference number
        $suffix='#INV';
        $this->db->insert('invoice_ref',array('suffix'=>$suffix,'invoiceBY'=>$this->session->userdata('id')));
        $invoicerefid=$this->db->insert_id();
        
        //updating the inv ref
        
        //increment 7 days
        $date = date("Y-m-d");
        $mod_date = strtotime($date."+ 7 days");
        $duedate=date("Y-m-d",$mod_date);
        $this->db->where(array('invoicerefid'=>$invoicerefid));
        $this->db->update('invoice_ref',array('clientid'=>$clientid,'createddate'=>$now->format('Y-m-d H:i:s'),'duedate'=>$duedate));
        
        //insert into invoicerecord
        foreach ($rosterids as $value) {
            if(!empty($value)){
                $data=array(
                    'invoicerefid'=>$invoicerefid,
                    'invoicesuffix'=>$suffix,
                    'clientid'=>$clientid,
                    'employeeid'=>$value->employeeid,
                    'rosterid'=>$value->rosterid,
                    'createddate'=>$now->format('Y-m-d H:i:s')

                );
            
                $this->db->insert('invoicerecord',$data);  //record invoice
                //update reference invoice id to roster 
                $this->db->where(array('rosterid'=>$value->rosterid));
                $this->db->update('roster',array('invoicerefid'=>$invoicerefid,'isInvoiceSent'=>1));
            
            }
        }
        
        
//        //insert to the  invoice reference  id to the account
        $client= $this->db->get_where('tbl_user_details',array('user_id'=>$clientid))->row_array();
        $rate=$this->db->get_where('rate',array('rateid'=>$client['rateid']))->row_array();
        
        $this->db->from('invoicerecord ir');
        $this->db->join('roster r','r.rosterid=ir.rosterid');
        $this->db->join('tbl_user_details ud','ud.user_id=ir.employeeid');
        $this->db->where(array('ir.invoicerefid'=>$invoicerefid));
        
        
        $work =$this->db->get('')->result_array();
        $subtotal=$this->Subtotal($work, $rate['rate']);
        $tax= $this->Tax($work, $rate['rate']);
        $total=$tax+$subtotal;
       

        
        $dat=array(
                'invoicerefid'=>$invoicerefid,
                'subtotal'=>$subtotal,
                'tax'=>$tax,
                'total'=>$total,
                'confirmedBY'=>$this->session->userdata('id')
            
            );
            
        $this->db->insert('account',$dat);  //record invoice
        // return clientid and invoice ref id
        $dat=array(
            'clientid'=>$clientid,
            'invoicerefid'=>$invoicerefid
        );
        return $dat;
    }
    
    
    function generateInvoice(){
        $invoicerefid=$this->input->post('invoicerefid');
        $clientid=$this->input->post('clientid');
        
        $query['user']= $this->db->get_where('tbl_user_details',array('user_id'=>$this->session->userdata('id')))->row_array();
        
        $query['client']= $this->db->get_where('tbl_user_details',array('user_id'=>$clientid))->row_array();
        $query['rate']=$this->db->get_where('rate',array('rateid'=>$query['client']['rateid']))->row_array();
        
        $query['invoice']=$this->db->get_where('invoice_ref',array('invoicerefid'=>$invoicerefid))->row_array();
        
        $this->db->from('invoicerecord ir');
        $this->db->join('roster r','r.rosterid=ir.rosterid');
        $this->db->join('tbl_user_details ud','ud.user_id=ir.employeeid');
        $this->db->where(array('ir.invoicerefid'=>$invoicerefid));
        
        
        $query['work'] =$this->db->get('')->result_array();
        $query['subtotal']=$this->Subtotal($query['work'], $query['rate']['rate']);
        $query['tax']= $this->Tax($query['work'], $query['rate']['rate']);
        $query['total']=$query['tax']+$query['subtotal'];
                
        //echo "<pre>" ;print_r($query);exit();
        return $query;
    }
    
    function confirmPayment(){
        $invoicerefid=$this->input->post('invoicerefid');
        $clientid=$this->input->post('clientid');
        
        $this->db->where(array('invoicerefid'=>$invoicerefid));
        $this->db->update('invoice_ref',array('isPaymentDone'=>1));
        
        $invoicelink= site_url().'/invoice/download/'.$clientid.'/'.$invoicerefid;
        $this->sendMailToPersonRemind($this->getEmailByID($clientid), $invoicelink);
        
    }
    
    function getEmailByID($id){
        
        $this->db->where(array('user_id'=>$id));
        return $this->db->get('tbl_user_details')->row_array()['email'];
    }
    
        
    
    function sendMailToPersonRemind($email,$link){
            
            $config['protocol'] = 'sendmail';
            $config['mailpath'] = '/usr/sbin/sendmail';
            $config['charset'] = 'iso-8859-1';
            $config['wordwrap'] = TRUE;
            $config['mailtype'] = 'html';

            
            $subject = "Payment Accepted.";
            $message='
            <p>Staffing Solution has recevied your payment!</p>
            <p><a href="'.$link.'"><button> Click here to view invoice</button></a></p>';

            $this->email->initialize($config);

            $this->email->from('info@staffingsolution.live', 'Staffing Solution');  // email, name

            $this->email->to($email);

            $this->email->subject($subject);
            $this->email->message($message);
            $this->email->send();
            //echo $this->email->print_debugger();
    
        
    }
    
    function calcHrs($date1,$date2){
    //    $t1 = StrToTime ( '2006-04-14 11:30:00' );
    //    $t2 = StrToTime ( '2006-04-12 12:30:00' );
        $t1 = StrToTime ($date1 );
        $t2 = StrToTime ($date2);
        $diff = abs($t1 - $t2);
        $hours = $diff / ( 60 * 60 );

        return round($hours,2);

    }

    function calcTotal($hrs,$rate){

        $total = (double)$hrs * (double)$rate;
        return round($total,2);
    }

    function Subtotal($work1,$rate){
        $total=0.0;

        foreach ($work1 as $value) {

            $total+=$this->calcTotal($this->calcHrs($value['startdatetime'], $value['enddatetime']), $rate);
        }


        return round($total,2);
    }

    function Tax($w,$r){
        return round(9.3 *$this->Subtotal($w,$r)/100,2);
    }


    function Grand($w,$r){
        return Tax($w, $r) +$this->Subtotal($w,$r);
    }
    
    function  uploadreceipt(){
        $postdata=$this->input->post();
        $invoicerefid=$postdata['invoicerefid'];
        $filename="";
         
        if(!empty($_FILES['receipt']['name'])){
            $file=$this->picUpload();
            $filename=$file['file_name'];
            
            $this->db->where(array('invoicerefid'=> $invoicerefid));
            $this->db->update('invoice_ref',array('isReceptUploaded'=>1,'receiptpic'=>$file['file_name']));
            
            return $filename;
        }
        
    }
    
    function picUpload(){
        
        $filename=null;
        $path = './uploads/receipts/users/'.$this->session->userdata('id').'/';
        if(!is_dir($path)){
              mkdir($path,0755,TRUE);
        } 
        $config['upload_path']          = $path;
        $config['allowed_types']        = 'gif|jpg|png';
        $this->load->library('upload', $config);
        if ( ! $this->upload->do_upload('receipt')){
            $data = array('error' => $this->upload->display_errors());
            
        }else{
            $data = array('upload_data' => $this->upload->data());
            
            
        }
        return $this->upload->data();
        
        
    }
    
    
}
