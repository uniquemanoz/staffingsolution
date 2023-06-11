<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class home extends MX_Controller {

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
    }

    public function index() {

        $data['page'] = "login";

        $data['msg'] = "";
        $data['view_page'] = "user/login_form";
        $this->load->view('container', $data);

    }


  
    public function login_check() {

        if (!$_POST) {
            $data['msg'] = "";
            $data['view_page'] = "user/login_form";
            $this->load->view('container', $data);
        } else 
            {

            $username = $this->input->post('form-username');
            $password = $this->input->post('form-password');
            // user_type= 1: super    2: admin  3: user



            $query = $this->db->get_where('tbl_user', array('username' => $username, 'password' => md5($password)));

            
            $user_mode = 0;  // in loop..for non users....$user_mode=0
            $block = 0;
            $isSuper = 0;
            $id=0;
            $msg=0;
            //print_r($query->result());
            foreach ($query->result() as $row) {
                $user_mode = $row->user_type;
                $block = $row->block_status;     // block_status= 0 means unblocked user
                $id = $row->id;
                $isSuper = $row->isSuper;
                
            }
            
            if(!empty($query->result())&& $query->result()[0]->isActive ==0){
                    $msg="User is inactive for now!  Please contact with Administrator!";
                }
                elseif(!empty($query->result())&& $query->result()[0]->isDeleted ==1){
                
                    $msg="Sorry to inform you that this User Account is Deleted for forever";
                }
            elseif(!empty($query->result())&& $query->result()[0]->block_status ==1){
                
                    $msg="Sorry to inform you that this User Account is Blocked...Please Contact Administractor";
            }
            
            elseif($id!=0 && $query->result()[0]->isActive==1 && $query->result()->isDeleted==0 ){ // user exist
                    $usrArray=$query->result();
                    $usertype_name=  $this->db->get_where('tbl_user_type',array('user_type_id'=>$user_mode))->result_array();
                    $user_details=$this->db->get_where('tbl_user_details',array('user_id'=>$id))->result();
                    $roleid=$user_details[0]->roleid;
                    $rolename=$this->db->get_where('role',array('roleid'=>$roleid))->result()[0]->rolename;
                    
                    //print_r($user_details);
                    $session_data = array(
                            'username' => $this->input->post('form-username'),
                            //'password'     => md5($this->input->post('form-password')),
                            'logged_in' => TRUE,
                            'mode' => $user_mode,
                            'id' => $id,
                            'usertype_name'=>$usertype_name[0]['user_type_name'],
                            'rolename'=>$rolename,
                            'name'=>ucfirst($user_details[0]->first_name)." ".ucfirst($user_details[0]->middle_name)." ".ucfirst($user_details[0]->last_name),
                            'email'=>$user_details[0]->email,
                            'profilelink'=>$user_details[0]->profilepic
                        );


                        $this->session->set_userdata($session_data);
                        $data['username'] = $this->session->userdata('username');

                        redirect('admin/index');
                   



                }
                
                elseif(empty ($query->result())){  // user doesnot exits or credentials may not match
                     $msg="Username or Password may be incorrect!";
                }
                $data['page'] = "home";
                       
                $data['msg'] = $msg;
                $data['view_page'] = "user/login_form";
                $this->load->view('container', $data);
//                print_r($data);
                
            }
            

    }

    function test(){
        
        echo md5("admin");
        $jack= array(
            'id'=>12,
            'name'=>"manoj"
        );
        print_r($jack);
        $jack['id']=23;
        print_r($jack);
    }


}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */