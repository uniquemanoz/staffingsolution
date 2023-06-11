<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class User extends MX_Controller {

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
        
        $this->load->model("user/user_model");
        $this->load->model("roster/roster_model");
        
        
    }

    public function index() {
        
        if ($this->session->userdata('id')) {

            $data['users']=  $this->user_model->getUsersList();
            //echo "<pre>";            print_r($data); exit();
            $data['msg'] = "";
            $data['view_page'] = "user/index";
            $this->load->view('admin/adminlte/container', $data);
        } else {
            redirect('home/index');
        }

        
        
    }
    
    public function profile($userid){
        if ($this->session->userdata('id')) {

            $data['roleOfUser']=$this->roster_model->getRoleByID($userid);
            $data['userProfile']=  $this->user_model->getUserProfile($userid);
            $data['UpcommingRoster']=$this->roster_model->getUpcommingRoster($userid);
            $data['PastRoster']=$this->roster_model->getPastRoster($userid);
            //echo "<pre>";            print_r($data); exit();
            $data['msg'] = "";
            $data['view_page'] = "user/profile";
            $this->load->view('admin/adminlte/container', $data);
        } else {
            redirect('home/index');
        }
        
        
        
    }


  
    public function adduser($id=0) {
        
        
        if (!$_POST) {
            
            $data['msg'] = "";
            $data['invoicetype']=  $this->db->get('invoice_type')->result_array();
            $data['rate']=  $this->db->get('rate')->result_array();
            $data['role']=  $this->db->get('role')->result_array();
            $data['state']=  $this->db->get('state')->result_array();
            $data['company']=  $this->db->get('company')->result_array();
            if($id!=0){
               $data['userProfile']=  $this->user_model->getUserProfile($id);
               
            }
            
            
            $data['view_page'] = "user/adduser";
            $this->load->view('admin/adminlte/container', $data);
        } else {
             
            
             $password=  $this->randomPassword();
             $user=array(
                 'username'=>$this->input->post('email'),
                 
                 'user_type'=>'2',
                 'isActive'=>1
             );
//            echo "<pre>";print_r($_POST);exit;
            $id=0;
            if(!empty($this->input->post('id'))){
                $id=$this->input->post('id');
                unset($_POST['id']);
            }
            
            if($id==0){
                 $user['password']=md5($password);
            }
            
             
            $this->db->where('username',$this->input->post('email'));
            $q = $this->db->get('tbl_user');
            
            if ( $q->num_rows() ==0 || $id!=0) 
            {
               if($id!=0){  
                    $this->db->where(array('id'=>$id));
                    $this->db->update('tbl_user',$user);
                }else{ echo "new ";
                    $this->db->insert('tbl_user',$user);
                   
                }
               
               
               $dat=array(
                   'user_id'=>$this->db->insert_id(),
                   'first_name'=>$this->input->post('first_name'),
                   'last_name'=>$this->input->post('last_name'),
                   'middle_name'=>$this->input->post('middle_name'),
                   'gender'=>$this->input->post('gender'),
                   'birthday'=>$this->input->post('birthday'),
                   'email'=>$this->input->post('email'),
                   'roleid'=>$this->input->post('roleid'),
                   'companyid'=>$this->input->post('companyid'),
                   'phone'=>$this->input->post('phone'),
                   'rateid'=>$this->input->post('rateid'),
                   'invoicetypeid'=>$this->input->post('invoicetypeid')
               );
              
               if($id!=0){ 
                    $dat['user_id']=$id;
                    $this->db->where(array('user_id'=>$id));
                    $this->db->update('tbl_user_details',$dat);
                }else{
                    
                    $this->db->insert('tbl_user_details',$dat);
                    
                    $this->sendMailToPerson($this->input->post('email'),$password);
                }
               
              
               redirect('user'); 
            }else{
                $data['view_page'] = "user/adduser";
                $data['msg'] = "Email Already Exists";
                $this->load->view('admin/adminlte/container', $data);
                
            }
            
            
        }
    }
    
        public function addrole() {

        if ($_POST && $this->session->userdata('id')) {
            $rolename=$this->input->post('rolename');
            if(count($this->db->get_where('role',array('rolename'=>$rolename))->result())>0){
                echo json_encode("Choose different Role Name. This is already exist!");
            }else{
                 $this->db->insert('role',array('rolename'=>$rolename));
                 
                 echo json_encode($this->db->insert_id());
            }
           
            
        } 
    }
    
    public function addrate() {

        if ($_POST && $this->session->userdata('id')) {
            $rate=$this->input->post('rate');
            if(count($this->db->get_where('rate',array('rate'=>$rate))->result())>0){
                echo json_encode("Choose different Rate. This is already exist!");
            }else{
                 $this->db->insert('rate',array('rate'=>$rate,'currency'=>'AUD'));
                 
                 echo json_encode($this->db->insert_id());
            }
           
            
        } 
    }
    
    public function addInvoiceType() {

        if ($_POST && $this->session->userdata('id')) {
            $invoicetypename=$this->input->post('invoicetypename');
            if(count($this->db->get_where('invoice_type',array('invoicetypename'=>$invoicetypename))->result())>0){
                echo json_encode("Choose different Invoice-Type. This is already exist!");
            }else{
                 $this->db->insert('invoice_type',array('invoicetypename'=>$invoicetypename));
                 
                 echo json_encode($this->db->insert_id());
            }
           
            
        } 
    }
    
    public function change_status(){
        if ($_POST && $this->session->userdata('id')||$this->session->userdata('user_type_name')=="admin") {
            
            if($this->user_model->changeStatus()){
                echo json_encode(TRUE);
            }else{
                echo json_encode(FALSE);
            }
                 
            
        }
          
         
    }
    
    public function lostpassword(){
        
        
        $email=$this->input->post('email');
        $userid=$this->db->get_where('tbl_user_details',array('email'=>$email))->result()[0]->user_id;
        $password=$this->randomPassword();
        if(!empty($userid)){
            $this->db->where(array('id'=>$userid));
            $this->db->update('tbl_user',array('password'=>md5($password)));
               
            $this->sendMailToPerson($this->input->post('email'),$password);
            echo json_encode("Successfully password resent messagge is sent in your mail");
        }else{
             echo json_encode("Failed!");
        }
        
    }
    
      public function addcompany() {

        if ($_POST && $this->session->userdata('id')) {
            $rolename=$this->input->post('rolename');
//            if(count($this->db->get_where('role',array('rolename'=>$rolename))->result())>0){
//                echo json_encode("Choose different Role Name. This is already exist!");
//            }else
                {
                 $this->db->insert('company',$this->input->post());
                 
                 echo json_encode($this->db->insert_id());
            }
           
            
        } 
    }

    
  function randomPassword() {
    $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
    $pass = array(); //remember to declare $pass as an array
    $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
    for ($i = 0; $i < 8; $i++) {
        $n = rand(0, $alphaLength);
        $pass[] = $alphabet[$n];
    }
    return implode($pass); //turn the array into a string
}


 
         


                

    
    

    function sendMailToPerson($email,$pass){
            
            $config['protocol'] = 'sendmail';
            $config['mailpath'] = '/usr/sbin/sendmail';
            $config['charset'] = 'iso-8859-1';
            $config['wordwrap'] = TRUE;
            $config['mailtype'] = 'html';
        

            $config['charset']='utf-8';
            $config['newline']="\r\n";
            $config['wordwrap'] = TRUE;
            $config['mailtype'] = 'html';
        
            
            $subject = "Verify your account";
            $message='<p style="text-align: center;"><strong>Welcome to Staffing Solution!!</strong></p>
            <p>Please verify your email and update the password.&nbsp; Click in this link below:</p>
            <p>username:'.$email.'</p>
            <p>password:'.$pass.'</p>
            <p><a href="'.site_url('home').'"><button> Click here to verify and change password </button></a></p>';

            $this->email->initialize($config);

            $this->email->from('info@staffingsolution.live', 'Staffing Solution');  // email, name

            $this->email->to($email);

            $this->email->subject($subject);
            $this->email->message($message);
            $this->email->send();
            //echo $this->email->print_debugger();
    
        
    }
    
    

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */