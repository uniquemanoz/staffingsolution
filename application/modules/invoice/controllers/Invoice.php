<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Invoice extends MX_Controller {

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
        $this->load->model("invoice/invoice_model");
       

    }

    public function index() {
        
        
        
        if ($this->isSessionExist()) {
            
            if (!$_POST) {
            
                $data['InvoiceList']=  $this->invoice_model->getInvoiceList();
                //echo "<pre>"; print_r($data);exit;
                $data['view_page'] = 'invoice/index';
                $this->load->view('admin/adminlte/container', $data);
                
            }
            
            

        } else {
            redirect('frontpage/index');
        }
    }
    

    

    
    function listwork(){
        if ($this->isSessionExist()) {
            
            if (!$_POST) {
                
                $data['Clients']= $this->invoice_model->getClinetList();
                $data['rosters']= $this->invoice_model->viewRoster();
                
                //echo "<pre>"; print_r($data);exit;
                $data['view_page'] = 'invoice/viewroster';
                $this->load->view('admin/adminlte/container', $data);
                
            }
          
        } else {
            redirect('frontpage/index');
        }
        
    }
    
        
    function makeinvoice(){
        if ($this->isSessionExist()) {
            
            if ($_POST) {
                
                $datToSendEmail=$this->invoice_model->makeinvoice();
                $this->sendMailToPerson($datToSendEmail['clientid'], $datToSendEmail['invoicerefid']);
                //echo "<pre>"; print_r($data);exit;
//                $data['view_page'] = 'invoice/viewroster';
//                $this->load->view('admin/adminlte/container', $data);
                
            }
          
        } else {
            redirect('frontpage/index');
        }
    }
    
    
    function generateInvoice(){
        if ($this->isSessionExist()) {
            
            if ($_POST) {
                
                $data=$this->invoice_model->generateInvoice();
                
                
                $load=$this->load->view('invoice/invoice', $data,TRUE);
                echo $load;
            }
          
        } else {
            redirect('frontpage/index');
        }
    }
    
    function download($cid,$invr){
       
        $_POST['clientid'] = $cid;
        $_POST['invoicerefid'] = $invr;
        $data=$this->invoice_model->generateInvoice();
        
       
        $data['view_page'] = 'invoice/invoice';
        $load=$this->load->view('admin/adminlte/container', $data);
       

        
    }
    
    function confirmPayment(){
        if ($this->isSessionExist()) {
            
            if ($_POST) {
                
                $data=$this->invoice_model->confirmPayment();
                $load=$this->load->view('invoice/invoice', $data,TRUE);
                
            }
          
        } else {
            redirect('frontpage/index');
        }
    }
    
    function uploadreceipt(){
        if ($this->isSessionExist()) {
            
            if ($_POST) {

                $data=$this->invoice_model->uploadreceipt();
                 echo json_encode($data);
                
            }
          
        } else {
            redirect('frontpage/index');
        }
    }
            
    
    function sendMailToPerson($cid,$invr){
            
            $config['protocol'] = 'sendmail';
            $config['mailpath'] = '/usr/sbin/sendmail';
            $config['charset'] = 'iso-8859-1';
            $config['wordwrap'] = TRUE;
            $config['mailtype'] = 'html';
        

            $config['charset']='utf-8';
            $config['newline']="\r\n";
            $config['wordwrap'] = TRUE;
            $config['mailtype'] = 'html';
            $email= $this->db->get_where('tbl_user_details',array('user_id'=>$cid))->row_array()['email'];
            $link= site_url('invoice/download').'/'.$cid.'/'.$invr;
            $subject = "Invoice Attached";
            $message='
            <p>Please Click this link to view invoice</p>
            <p><a href="'.$link.'"><button> Click here to downlaod invoice</button></a></p>';

            $this->email->initialize($config);

            $this->email->from('info@staffingsolution.live', 'Staffing Solution');  // email, name

            $this->email->to($email);

            $this->email->subject($subject);
            $this->email->message($message);
            $this->email->send();
            //echo $this->email->print_debugger();
    
        
    }
    
 
 
    function isSessionExist(){
        if($this->session->userdata('id'))
            return TRUE;
        else
            FALSE;
    }
    
    
    
   

}
