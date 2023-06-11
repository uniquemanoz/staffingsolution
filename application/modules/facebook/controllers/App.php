<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class App extends MX_Controller {
     public function __construct()
	{
		parent::__construct();
		$this->load->library('pagination');
                
                $this->load->library('email');
                $this->load->helper('date');
	 
	}
        
        public function index()
	{
            
            
            $data['view_page']="app/index";
      
            $this->load->view('container',$data);
        }
        
        public function numerology(){
//           $month=03;
//            $day=16;
//            $year=1990;
            
            $birthday= $_POST["bday"];
            $splt= explode('/', $birthday);
            $month=$splt[0];
            $day=$splt[1];
            $year=$splt[2];
            
            $sum= $year+$month+$day;
              
            $lifepath = $this->singleNumber($sum);
            
            $query= $this->db->get_where('tbl_numerology',array('lifepathID'=>$lifepath))->result();
            echo $query[0]->description;
            
        }
        
        function singleNumber($num){
            
            while($num>9){
                $sum = 0;
                do {
                    $sum += $num % 10;
                }
                while ($num = (int) $num / 10);
                $num=$sum;
            }
            
            
            return $sum;
        }
        
        
        public function img() {
      
            $img = $_POST['img']; // Your data 'data:image/png;base64,AAAFBfj42Pj4';
            $ID= $_POST['ID']; 
          
            $img = str_replace('data:image/png;base64,', '', $img);
            $img = str_replace(' ', '+', $img);
            $data = base64_decode($img);
            $target=$ID.time().'img.png';//making file name
            file_put_contents('uploads/appimage/'.$target, $data);
            
        }
        
}