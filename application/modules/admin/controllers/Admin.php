<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends MX_Controller {

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
        
    }

    public function index() {
       //echo "<pre>";print_r($this->session->all_userdata());exit;

        if ($this->session->userdata('id')) {

//            $data['view_page'] = 'admin/body';
//            $this->load->view('admin/adminlte/container', $data);
            $link= site_url().'/user/profile/'.$this->session->userdata('id');
            redirect($link);
        } else {
            redirect('home/index');
        }
    }

    public function email_admin() {


        if ($_POST) {
            $file = get_filenames('./data/temp');  //saving file names
            $file_names = implode(",", $file);



            $config['protocol'] = 'sendmail';
            $config['mailpath'] = '/usr/sbin/sendmail';
            $config['charset'] = 'iso-8859-1';
            $config['wordwrap'] = TRUE;
            $config['mailtype'] = 'html';

            $this->email->initialize($config);
            // print_r($this->input->post());

            $this->email->from('xyz@sexample.com', 'Name');  // email, name

            $this->email->to($this->input->post('to'));

            $this->email->subject($this->input->post('subject'));
            $this->email->message($this->input->post('message'));



            if ($file) {
                // $path = set_realpath('data/temp');
                $path = './data';
                foreach ($file as $key => $value) {
                    $this->email->attach($path . '/' . $file[$key]);
                }

                $this->email->send();
            } else {
                $this->email->send();
            }




            $datestring = " %Y/%m/%d - %h:%i %a";
            $time = time();

            $date = mdate($datestring, $time);


            $dat = array(
                'to' => $this->input->post('to'),
                'from' => "xyz@example.com",
                'subject' => $this->input->post('subject'),
                'content' => $this->input->post('message'),
                'date' => $date
            );
            $this->db->insert('tbl_message', $dat);


            if ($file) {
                delete_files('./data/temp', TRUE);
            }
            echo "success";
        } else {
            redirect('home/index');
        }
    }

    public function sent_delete($param) {
        $this->db->where('id', $param);
        $this->db->delete('tbl_message');
        $this->sent();
    }

    public function logout() {


        $this->session->sess_destroy();
        
        redirect('home/index');
    }

    public function save($table, $page) {

        $this->db->where('username', $this->input->post('username'));
        $query = $this->db->get('tbl_user');
        if ($query->num_rows() > 0) {
            echo "username exists";
        } else {

            //   $this->load->model('adminmodel');
            $ary = array(
                'username' => $this->input->post('username'),
                'password' => $this->input->post('password'),   //md5 encryption
                'user_type' => "1"
            );
            $this->db->insert($table, $ary);
            $id = $this->db->insert_id();
            $this->db->insert('tbl_user_details', array('user_id' => $id, 'email' => $this->input->post('username') . "@mountainoverseas.com"));


            // make account on cpanel
// cPanel info
            $cpuser = 'mountap3'; // cPanel username
            $cppass = 'MountSe$s967???'; // cPanel password
            $cpdomain = 'mountainoverseas.com'; // cPanel domain or IP
            $cpskin = 'rsx3';  // cPanel skin. Mostly x or x2. 
// See following URL to know how to determine your cPanel skin
// http://www.zubrag.com/articles/determine-cpanel-skin.php
// Default email info for new email accounts
// These will only be used if not passed via URL
            $epass = $this->input->post('password'); // email password
            $edomain = 'mountainoverseas.com'; // email domain (usually same as cPanel domain above)
            $equota = 0; // amount of space in megabytes
############################################################### 
# END OF SETTINGS
############################################################### 

            function getVar($name, $def = '') {
                if (isset($_GET[$name]))
                    return $_GET[$name];
                else
                    return $def;
            }

// check if overrides passed
            $euser = $this->input->post('username');

            $edomain = getVar('domain', $edomain);
            $equota = getVar('quota', $equota);

            $msg = '';

            if (!empty($euser))
                while (true) {



                    // Create email account
                    $f = fopen("http://$cpuser:$cppass@$cpdomain:2082/frontend/$cpskin/mail/doaddpop.html?email=$euser&domain=$edomain&password=$epass&quota=$equota", "r");
                    if (!$f) {
                        $msg = 'Cannot create email account. Possible reasons: "fopen" function allowed on your server, PHP is running in SAFE mode';
                        echo " we are facing problem while creating account!!..Please try again later";
                        break;
                    }



                    // Check result
                    while (!feof($f)) {
                        $line = fgets($f, 1024);
                    }

                    $msg = "<h2>Email account {$euser}@{$edomain} created.</h2>";
                    echo $msg;
                    @fclose($f);

                    break;
                }

            // $id = $this->db->insert_id();
//            $data['page'] = 'Job';
//            $data['menu'] = 'Job List';
//            
//            $this->load->view('admin/header');
//            $data['username']=  $this->session->userdata('username');
//                $this->load->view('admin/menu.php',$data);
//                $this->load->view('admin/job_list.php');
//                $this->load->view('admin/footer.php');
            $this->$page($id);
        }
    }

    public function inbox_list() {



        $hostname = '{rsj36.rhostjh.com:993/imap/ssl}INBOX';
        $username = 'xyz@example.com';
        $password = "password";

        /* try to connect */
        $inbox = imap_open($hostname, $username, $password) or die('Cannot connect to Gmail: ' . imap_last_error());

        /* grab emails */
        $emails = imap_search($inbox, 'ALL');

        /* if emails are returned, cycle through each... */
        if ($emails) {

            /* begin output var */
            $output = '';

            /* put the newest emails on top */
            rsort($emails);

            /* for every email... */
            foreach ($emails as $email_number) {

                /* get information specific to this email */
                $overview = imap_fetch_overview($inbox, $email_number, 0);
                $message = imap_fetchbody($inbox, $email_number, 2);

                /* output the email header information */
                $output.= '<div class="toggler ' . ($overview[0]->seen ? 'read' : 'unread') . '">';
                $output.= '<span class="subject">' . $overview[0]->subject . '</span> ';
                $output.= '<span class="from">' . $overview[0]->from . '</span>';
                $output.= '<span class="date">on ' . $overview[0]->date . '</span>';
                $output.= '</div>';

                /* output the email body */
                $output.= '<div class="body">' . $message . '</div>';
            }

            echo $output;
        }

        /* close the connection */
        imap_close($inbox);
    }

    public function messageBody($msgno) {

        $file = array();

        $email_number = $msgno;
        $username = 'info@example.com';
        $password = 'password';
        $config['login'] = $username;
        $config['pass'] = $password;
        $config['host'] = 'server213.web-hosting.com';
        $config['port'] = '993';
        $config['service_flags'] = '/imap/ssl/novalidate-cert';

        $this->load->library('peeker', $config);
        $this->peeker->initialize($config);


        // get the first message 
        $email = $this->peeker->get_message($email_number);

        $data['date'] = $email->date;
        $data['subject'] = $email->subject;
        $data['to'] = $email->toaddress;
        $data['from'] = $email->fromaddress;
        $data['body'] = $email->get_plain();


        if ($email->has_attachment()) {
            // echo "has atch";
            $data['atch'] = "ok";

            $path = 'download' . '/' . $this->session->userdata('id');


            $email->save_all_attachments($path);


            $parts = $email->get_parts_array();
            foreach ($parts as $part) {
                $filename = $part->get_filename();
                $file[] = $filename;
            }

            $data['file'] = $file;
        } else {
            //echo "no atch";
            $data['atch'] = "no";
        }



        $data['mailbox_type'] = 'admin/readmail';
        $data['view_page'] = 'admin/mailbox_body';
        $this->load->view('admin/adminlte/container', $data);
    }

    public function mailbox() {

        if ($this->session->userdata('id')) {
            delete_files('./data/temp', TRUE);
            $hostname = '{server213.web-hosting.com:993/imap/ssl}INBOX';
            $username = 'xyz@example.com';
            $password = 'password';
            /* connect to gmail with your credentials */

            /* try to connect */
            $inbox = imap_open($hostname, $username, $password) or die('Cannot connect to mailbox: ' . imap_last_error());
            $MC = imap_check($inbox);
            $result = imap_fetch_overview($inbox, "1:{$MC->Nmsgs}", 0);

            $reversed_mail = array_reverse($result);


            imap_close($inbox);


            $data['inboxes'] = $reversed_mail;
            $data['mailbox_type'] = 'admin/mailbox';
            $data['view_page'] = 'admin/mailbox_body';
            $this->load->view('admin/adminlte/container', $data);
        } else {
            redirect('home/index');
        }
    }

    public function compose() {

        if ($this->session->userdata('id')) {
            delete_files('./data/temp', TRUE);
            $data['mailbox_type'] = 'admin/compose';
            $data['view_page'] = 'admin/mailbox_body';
            $this->load->view('admin/adminlte/container', $data);
        } else {
            redirect('home/index');
        }
    }

    public function notices() {


        if ($this->session->userdata('id')) {
            if (!$_POST) {



                $result_per_page = 5;  // the number of result per page

                $config['base_url'] = site_url($this->uri->segment(1)) . '/notices?';

                $config['total_rows'] = $this->db->count_all('tbl_notices');
                $config['per_page'] = $result_per_page;
                $config['page_query_string'] = TRUE;

                $config['full_tag_open'] = '<ul class="pagination pagination-sm no-margin">';
                $config['full_tag_close'] = '</ul>';

                $config['first_link'] = 'First';
                $config['first_tag_open'] = '<li class="prev page">';
                $config['first_tag_close'] = '</li>';

                $config['last_link'] = 'Last';
                $config['last_tag_open'] = '<li class="next page">';
                $config['last_tag_close'] = '</li>';

                $config['next_link'] = 'Next';
                $config['next_tag_open'] = '<li class="next page">';
                $config['next_tag_close'] = '</li>';

                $config['prev_link'] = 'Prev';
                $config['prev_tag_open'] = '<li class="prev page">';
                $config['prev_tag_close'] = '</li>';

                $config['cur_tag_open'] = '<li class="active"><a href="">';
                $config['cur_tag_close'] = '</a></li>';

                $config['num_tag_open'] = '<li class="page">';
                $config['num_tag_close'] = '</li>';

                $this->pagination->initialize($config);
                $this->db->order_by("notices_id", "desc");
                $query = $this->db->get('tbl_notices', $result_per_page, $this->input->get('per_page'));
                $data['notice'] = $query->result_array();
                $data['pagination'] = $this->pagination->create_links();
                $data['view_page'] = 'admin/notices';
                $this->load->view('admin/adminlte/container', $data);
            } else {
                
            }
        } else {
            redirect('home/index');
        }
    }

    public function delete_notice() {


        if ($this->session->userdata('id')) {



            $this->db->delete('tbl_notices', array('notices_id' => $this->input->post('notices_id')));

            echo "sucess";
        }
    }

    public function edit_notice() {


        if ($this->session->userdata('id')) {


            $this->db->where(array('notices_id' => $this->input->post('notices_id')));
            $this->db->update('tbl_notices', array('topic' => $this->input->post('topic'), 'content' => $this->input->post('content')));

            echo "sucess";
        }
    }

    public function add_notice() {


        if ($this->session->userdata('id')) {



            $this->db->insert('tbl_notices', array('topic' => $this->input->post('topic'), 'content' => $this->input->post('content')));

            echo "sucess";
        }
    }

    public function carosel() {


        if ($this->session->userdata('id')) {
            if (!$_POST) {

                $data['view_page'] = 'admin/carosel';
                $this->load->view('admin/adminlte/container', $data);
            } else {
                
            }
        } else {
            redirect('home/index');
        }
    }

    public function carosel_upload() {



        if ($this->session->userdata('id')) {
            if ($_POST) {

                $config['upload_path'] = './uploads/home_carosel';
                $config['allowed_types'] = 'gif|jpg|png';
                $config['max_size'] = '10000';
                $config['max_width'] = '1024';
                $config['max_height'] = '768';

                $this->load->library('upload', $config);

                if (!$this->upload->do_upload('carosel')) {
                    $error = array('error' => $this->upload->display_errors());
                } else {
                    $data = array('upload_data' => $this->upload->data());
                }

                $data['view_page'] = 'admin/carosel';
                $this->load->view('admin/adminlte/container', $data);
            } else {
                $data['view_page'] = 'admin/carosel';
                $this->load->view('admin/adminlte/container', $data);
            }
        } else {
            redirect('home/index');
        }
    }

    public function delete_file() {
        @unlink('./uploads/home_carosel/' . $this->input->post('file_name'));
        //@unlink($this->input->post('file_path'));
        echo "sucess";
    }

    public function start_upload_file() {
        if (empty($_FILES) || $_FILES['file']['error']) {
            die('{"OK": 0, "info": "Failed to move uploaded file."}');
        }
        $chunk = isset($_REQUEST["chunk"]) ? intval($_REQUEST["chunk"]) : 0;
        $chunks = isset($_REQUEST["chunks"]) ? intval($_REQUEST["chunks"]) : 0;
        $fileName = isset($_REQUEST["name"]) ? $_REQUEST["name"] : $_FILES["file"]["name"];
        if (!@mkdir('data')) {
            @mkdir('data');
        }

        $filePath = 'data/' . $fileName;
        $filePath1 = 'data/temp/' . $fileName;

        //image file name 

        if (!@mkdir('data/temp')) {
            @mkdir('data/temp');
        }


        // Open temp file
        $out = @fopen("{$filePath}.part", $chunk == 0 ? "wb" : "ab");
        $out1 = @fopen("{$filePath1}.part", $chunk == 0 ? "wb" : "ab");
        if ($out) {
            // Read binary input stream and append it to temp file
            $in = @fopen($_FILES['file']['tmp_name'], "rb");
            if ($in) {
                while ($buff = fread($in, 4096))
                    fwrite($out, $buff);
                fwrite($out1, $buff);
            } else
                die('{"OK": 0, "info": "Failed to open input stream."}');
            @fclose($in);
            @fclose($out);
            @fclose($out1);
            @unlink($_FILES['file']['tmp_name']);
        } else
            die('{"OK": 0, "info": "Failed to open output stream."}');
        // Check if file has been uploaded
        if (!$chunks || $chunk == $chunks - 1) {
            // Strip the temp .part suffix off
            rename("{$filePath}.part", $filePath);
            rename("{$filePath1}.part", $filePath1);
        }
        die('{"OK": 1, "info": "Upload successful."}');
    }

    public function about_company() {
        if ($this->session->userdata('id')) {
            if ($_POST) {

                $this->db->where(array('page' => 'Home Main'));
                $this->db->update('tbl_content', array('content' => $this->input->post('content')));

                echo "success";
            } else {
                $query = $this->db->get_where('tbl_content', array('page' => 'Home Main'));
                $data['home_main'] = $query->row_array();
                $data['view_page'] = 'admin/about_company';
                $this->load->view('admin/adminlte/container', $data);
            }
        } else {
            redirect('home');
        }
    }

    public function about_us() {
        if ($this->session->userdata('id')) {
            if ($_POST) {

                $this->db->where(array('page' => 'CEO_message'));
                $this->db->update('tbl_content', array('content' => $this->input->post('content')));

                echo "success";
            } else {
                $query = $this->db->get_where('tbl_content', array('page' => 'CEO_message'));
                $data['home_main'] = $query->row_array();
                $data['view_page'] = 'admin/aboutus';
                $this->load->view('admin/adminlte/container', $data);
            }
        } else {
            redirect('home');
        }
    }

    public function member() {
        if ($this->session->userdata('id')) {
            if ($_POST) {

                $this->db->where(array('page' => 'CEO_message'));
                $this->db->update('tbl_content', array('content' => $this->input->post('content')));

                echo "success";
            } else {
                $query = $this->db->get('tbl_member');
                $data['members'] = $query->result_array();


                $data['view_page'] = 'admin/member';
                $this->load->view('admin/adminlte/container', $data);
            }
        } else {
            redirect('home');
        }
    }

    public function add_member() {
        if ($this->session->userdata('id')) {
            if ($_POST) {

                if (!@mkdir('./uploads/member')) {
                    @mkdir('./uploads/member');
                }

                $config['upload_path'] = './uploads/member';
                $config['allowed_types'] = 'gif|jpg|png';
                $config['max_size'] = '10000';
                $config['max_width'] = '1024';
                $config['max_height'] = '768';

                $this->load->library('upload', $config);

                if (!$this->upload->do_upload('profile')) {
                    $error = array('error' => $this->upload->display_errors());
                } else {
                    $data1 = array('upload_data' => $this->upload->data());
                }


                $this->db->insert('tbl_member', array('name' => $this->input->post('name'), 'type' => $this->input->post('type'), 'profile_pic' => $data1['upload_data']['file_name']));

                $query = $this->db->get('tbl_member');
                $data['members'] = $query->result_array();


                $data['view_page'] = 'admin/member';
                $this->load->view('admin/adminlte/container', $data);
            } else {
                $query = $this->db->get('tbl_member');
                $data['members'] = $query->result_array();


                $data['view_page'] = 'admin/member';
                $this->load->view('admin/adminlte/container', $data);
            }
        } else {
            redirect('home');
        }
    }

    public function delete_member() {

        $this->db->where('mid', $this->input->post('mid'));
        $this->db->delete('tbl_member');
        @unlink('./uploads/member/' . $this->input->post('profile_pic'));
        echo "sucess";
    }

    public function uploadify() {


        $config['upload_path'] = "./uploads/test";
        $config['allowed_types'] = '*';
        $config['max_size'] = 0;
        $this->load->library('upload', $config);

        if (!$this->upload->do_upload("userfile")) {
            $error = $this->upload->display_errors();
            var_dump($this->upload->data());
            var_dump($error);
        } else {
            $data = $this->upload->data();

            var_dump($data);
        }
    }
    
  
    
    function AssignQuestionToAstro(){
        
        
        $this->db->select('u.id,ast.AstroID,ast.AstroEmail');
        $this->db->from('tbl_user u');
        $this->db->join('astrologers ast','ast.UserID=u.id');
        $this->db->where('u.isActive',1);
        $query = $this->db->get();
        $astroList=$query->result_array();
        //echo"<pre>";
        //print_r($query->result_array());
        
        $store=$this->db->get_where('store',array('Name'=>'AstroID'))->result_array();
        $storeAstroID=$store[0]['ID'];
        
        $nextkey=0;  //to fetch next astrologer...its index in $astroList
        $totalAstro=count($astroList);
        foreach ($astroList as $key => $value) {
            if($storeAstroID==$value['AstroID']){
                
                $nextkey=$key+1;
                
                if($nextkey >= $totalAstro){
                    $nextkey=0;
                }
                break;
            }
            
        }
        $targetAstroID = $astroList[$nextkey]['AstroID'];
        $targetEmail = $astroList[$nextkey]['AstroEmail'];
        
        //update store
        $this->db->where('Name',"AstroID");
        $this->db->update('store',array('ID'=>$targetAstroID));
        $this->sendMailToPerson($targetEmail);
        
        //echo "ID: ".$targetAstroID."   Email: ".$targetEmail;
        
        
      
    }
    
   public function verify(){
       $signed_data='{"orderId":"GPA.3339-6840-2080-50303","packageName":"com.jackmanbegins.mfreedom.fb","productId":"com.jackendra.buttonclick","purchaseTime":1520177556053,"purchaseState":0,"developerPayload":"inapp:com.jackendra.buttonclick:f0940382-dea7-4a76-8a51-b2854532501f","purchaseToken":"gmahhkknlkjkephckgifceeh.AO-J1Owbz6ilJ-Zi2d5CTd51SpoFqfj1zrOsp-joF_iHR5y28FqWg57Sc2cb_ZkFsW92TwseaCgZCv_9plf0aHMSHwKKb_E1PQ-boGlgCQ2RniP2ZPUW0lq2ub244-wDKlmbw-YAnjNjV6U12XD0UA0efjCzYTSn1A"}';
       $signature="Crv1613+Rf1LLOKbhdkc06pp/KpJN1uyZAuN1n9Cb3HXo17Y/AmcN15IO7V2NSG/7WQHZ2Jkg25WqGWaXYScU9cVr0CXpoXiLCS378f8lyB7663rSzJCdKW8eQjOcka5PyWfaSikeQCfnPRFRuKuiv6AqoV2/WXmsSKgoH1G3E+oLwjxHjSxSo8M26jCEE+IaSV/VGf7gQiUz7j1hJuZHd5Kr2JPWstl131XtfnqJX1taQtHuCVAjg5R9rSjCOSIGYwfLA5G7jptckRR7zlxp0MmzAQZhpa8nLAuFlr2/AGbLhUGtt+QWNAQ8Hf0pr3V3ArXtZmWnszRKDlPZGKSzA==";
       $public_key_base64="MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAvsiHa1kskxKvS9s35Xvj2alAX6ogcLhveAaDp4g9Yav80yQTGFarxXCNXJtI5EyId5jBxeDAo1D197PuADGQRQmytJAYHSU/RWxeJumDqGamznxx8KpQQe/yazOBYcp15M2p/fWyCa8Axctr2CKK3P0EjpxToAZlB3Bo8ebSAwPJATCs4672rw4Epdz7fttuAdOwk86XW18vQDZUwHYid656/+cGtcDjchwYQ8f7H5Q4n843Ll2RylG1OF2BuzrThgzIJstpQMUhCsQLuWSLt+ujWRV4bcR9cufgKwFWpX7l4g4Co2FPAzJ5xTtgxZzdle+PTr11UTXNLyxZFANKzQIDAQAB";
       
       $this->verify_market_in_app($signed_data, $signature, $public_key_base64);
       
   }
    
   function verify_market_in_app($signed_data, $signature, $public_key_base64) 
{
	$key =	"-----BEGIN PUBLIC KEY-----\n".
		chunk_split($public_key_base64, 64,"\n").
		'-----END PUBLIC KEY-----';   
	//using PHP to create an RSA key
	$key = openssl_get_publickey($key);
	//$signature should be in binary format, but it comes as BASE64. 
	//So, I'll convert it.
	$signature = base64_decode($signature);   
	//using PHP's native support to verify the signature
	$result = openssl_verify(
			$signed_data,
			$signature,
			$key,
			OPENSSL_ALGO_SHA1);
	if (0 === $result) 
	{
            echo "false";
		return false;
	}
	else if (1 !== $result)
	{
            echo "false";
		return false;
	}
	else 
	{
            echo "true";
          
	    return true;
	}
}


function test(){
    $to_time = strtotime("2008-12-15 10:42:00");
    $from_time = strtotime("2008-12-13 11:21:00");
    $totalmins=round(abs($to_time - $from_time) / 60,2);

//echo round(abs($to_time - $from_time) / 60,2). " minute";
    echo $this->con_min_days($totalmins);
}
    
function con_min_days($mins)
    {

            $hours = str_pad(floor($mins /60),2,"0",STR_PAD_LEFT);
            $mins  = str_pad($mins %60,2,"0",STR_PAD_LEFT);

            if((int)$hours > 24){
            $days = str_pad(floor($hours /24),2,"0",STR_PAD_LEFT);
            $hours = str_pad($hours %24,2,"0",STR_PAD_LEFT);
            }
            if(isset($days)) { $days = $days." d ";}

            return $days.$hours." h ".$mins." m ago";
    }
   

}
